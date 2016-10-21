<?php
use \App\Log;
use \App\TagType;
use \App\Task;
use \App\TaskType;
use \App\TaskCategory;
use \App\TaskCategoryType;

use \App\TimePeriod;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/redirect/{provider}', 'SocialAuthController@redirect');
Route::get('/callback/{provider}', 'SocialAuthController@callback');

Route::get('TasksByTaskCategoryType/{id}', function ($id){
    if (Auth::guest()){
        return back()->withErrors("You must be logged in to do this.");
    }
    if ($id=="all"){
        $task_types = TaskType::where('user_id', Auth::user()->id)
          ->orderBy('name', 'asc')->get();
        $task_category_type = new stdClass();
        $task_category_type->name = "All";
        $task_category_type->id = 1;
    } else {
        $task_category_type = TaskCategoryType::find($id);
        if (Auth::user()->id!=TaskCategoryType::find($id)->user_id){
            return back()->withErrors("You are not authorized to do this.");
        }
        $task_types = TaskType::join('task_categories', 'task_type_id', '=',
          'task_types.id')->where('task_categories.task_category_type_id', $id)
          ->where('task_categories.user_id', Auth::user()->id)
          ->where('task_types.user_id', Auth::user()->id)
          ->whereNull('task_categories.deleted_at')
          ->orderBy('task_types.name', 'asc')->get();
        $task_category_type = TaskCategoryType::find($id);
    }

    return View::make('TasksByTaskCategoryType', [
        "task_types"=>$task_types,
        "task_category_type"=>$task_category_type,
        "task_category_types" => TaskCategoryType::where("id", ">", 1)
          ->where('user_id', Auth::user()->id)->orderBy("name", "asc")->get(),

    ]);

});
Route::get('TasksByCategoryForTimePeriod/{id}/TimePeriodID/{time_period_id}',
  function ($id, $time_period_id ) {
    if ($id =="all"){
        $task_categories = TaskCategory::where('user_id', Auth::user()->id)->get();
        $task_category_types  =  TaskCategoryType::where('user_id', Auth::user()->id)
          ->orderBy("name", "asc")->get();
        $task_types = TaskType::where('user_id', Auth::user()->id)
          ->orderBy('name', 'asc')->get();
    } else {
        $task_categories = TaskCategory::where('task_category_type_id', $id)
          ->where('user_id', Auth::user()->id)->get();
        $task_category_types = TaskCategoryType::where('user_id', Auth::user()->id)
          ->orderBy("name", "asc")->get();
        $task_types = TaskType::join('task_categories', 'task_type_id', '=',
          'task_types.id')->where('task_categories.task_category_type_id', $id)
          ->where('task_categories.user_id', Auth::user()->id)
          ->where('task_types.user_id', Auth::user()->id)
          ->orderBy('task_types.name', 'asc')->get();

    }
    $tasks_for_time_period = Task::where('user_id', Auth::user()->id)
      ->where('time_period_id', $time_period_id)->get();
    $active_task_types=[];
    foreach ($tasks_for_time_period as $task_for_time_period){
        $active_task_types[] = $task_for_time_period->type_id;
    }
    return view('TasksByCategoryTypeForTimePeriod', [
        "active_task_category_type_id"=>$id,
        "active_task_types"=>$active_task_types,
        "time_period_id"=>$time_period_id,
        "task_categories"=>$task_categories,
        "task_category_types" => $task_category_types,
        "task_types"=>$task_types,
    ]);
});


Route::get('/note/task/{task_id}/timePeriod/{time_period_id}', ['uses'=>'NoteController@create']);
Route::get('/person/task/{task_id}/timePeriod/{time_period_id}', ['uses'=>'PersonController@create']);
Route::get("/time/month/{month}/day/{day}/year/{year}", ['as'=> 'indexDate', 'uses'=>'TimePeriodController@indexDate']);
Route::get("/timezone", ['as'=>'timezone', function(){
    return view('timezones');
}]);
Route::post('/time/resume/{id}', ['as'=>'time.resume', 'uses'=>'TimePeriodController@resume']);
Route::put("/timezone-change", ['as'=>'timezone-change', 'uses'=>'UserController@updateTimeZone']);

Route::resource('note', 'NoteController');
Route::resource('person', 'PersonController');
Route::resource('PersonType', 'PersonTypeController');
Route::resource("time", "TimePeriodController");
Route::resource("TimePeriodNote", "TimePeriodNoteController");
Route::resource("task", "TaskController");
Route::resource("TaskNote", "TaskNoteController");
Route::resource("TaskType", "TaskTypeController");
Route::resource('TaskCategory', 'TaskCategoryController');
Route::resource('TaskCategoryType', 'TaskCategoryTypeController');
Route::resource('user', 'UserController');

Route::auth();

Route::get('/{period?}', ['as'=>'root', function($period=null){
    if (Auth::guest()){
        return View('public');
    } else if (Auth::user()){
        return redirect (route('time.index'));
    }
}]);
