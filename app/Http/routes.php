<?php
use \App\Log;
use \App\TagType;
use \App\TaskType;
use \App\TimePeriod;
use \App\TaskCategory;
use \App\TaskCategoryType;

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

Route::get('/', ['as'=>'root', function(Request $request){
    if (Auth::guest()){
        return View('public');
    } else if (Auth::user()){
        $period = isset($request->period)
          ? TimePeriod::fetch_period($request->period)
          : TimePeriod::fetch_period(null);
        
        return View('time', [
            "period"=>$period['name'],
            "task_category_types" => TaskCategoryType::where("id", ">", 1)
              ->where('user_id', Auth::user()->id)->orderBy("name", "asc")->get(),
        ]);
    }
}]);
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
    return view('TasksByCategoryTypeForTimePeriod', [
        "active_task_category_type_id"=>$id,
        "time_period_id"=>$time_period_id,
        "task_categories"=>$task_categories,
        "task_category_types" => $task_category_types,
        "task_types"=>$task_types,
    ]);
});

Route::get('/note/task/{task_id}/timePeriod/{time_period_id}', ['uses'=>'NoteController@create']);

Route::resource('note', 'NoteController');
Route::resource("time", "TimePeriodController");
Route::resource("TimePeriodNote", "TimePeriodNoteController");
Route::resource("task", "TaskController");
Route::resource("TaskNote", "TaskNoteController");
Route::resource("TaskType", "TaskTypeController");
Route::resource('TaskCategory', 'TaskCategoryController');
Route::resource('TaskCategoryType', 'TaskCategoryTypeController');
Route::resource('user', 'UserController');

Route::auth();

