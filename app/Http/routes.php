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

Route::get('/log/all', ["as"=>"log.all", function ($period=null) {
    return view('log', [
        "log_entries" => Log::orderBy("created_at", "desc")->get(),
        "tag_types" => TagType::orderBy("name", "asc")->get(),
    ]);
}]);
Route::get('/log/{period?}', ["as"=>"log", function ($period=null) {
    if ($period=="yesterday"){
        $yesterday = date("Y-m-d", strtotime("-1 days"));
        $begin = $yesterday . " 00:00:00";
        $end = $yesterday . " 23:59:59";
    } else if ($period=="week"){
        $week = date("Y-m-d", strtotime("-1 weeks"));
        $today = date("Y-m-d");
        $begin = $week . " 00:00:00";
        $end = $today . " 23:59:59";
    } else {
        $today = date("Y-m-d");
        $begin = $today . " 00:00:00";
        $end = $today . " 23:59:59";
     }    
    return view('log', [
        "log_entries" => Log::where("created_at", ">", $begin)->where("created_at", "<", $end)->orderBy("created_at", "desc")->get(),
        "tag_types" => TagType::orderBy("name", "asc")->get(),
    ]);
}]);
Route::get('/time/all', ["as"=>"time.all", function ($period=null) {
    return view('time.index', [
        "time_periods" => TimePeriod::orderBy("start", "desc")->get(),
        "task_types" => TaskType::orderBy("name", "asc")->get(),
        "task_category_types" => TaskCategoryType::where("id", ">", 1)->orderBy("name", "asc")->get(),
    ]);
}]);
Route::get('time/today/active', ["as"=>"time.today", function () {

        $today = date("Y-m-d");
        $begin = $today . " 00:00:00";
        $end = $today . " 23:59:59";
    return view('time.index', [
        "time_periods" => TimePeriod::where("created_at", ">", $begin)->where("created_at", "<", $end)
          ->where("end", 0)->orderBy("start", "desc")->get(),
        "task_types" => TaskType::orderBy("name", "asc")->get(),
        "task_category_types" => TaskCategoryType::where("id", ">", 1)->orderBy("name", "asc")->get(),
    ]);

}]);

Route::get('/', ["as"=>"time.today.all", 'uses'=>'TimePeriodController@index']);

Route::get('time/period/{period}', ["as"=>"time", function ($period=null) {
    if ($period=="yesterday"){
        $yesterday = date("Y-m-d", strtotime("-1 days"));
        $begin = $yesterday . " 00:00:00";
        $end = $yesterday . " 23:59:59";
    } else if ($period=="week"){
        $week = date("Y-m-d", strtotime("-1 weeks"));
        $today = date("Y-m-d");
        $begin = $week . " 00:00:00";
        $end = $today . " 23:59:59";
    } else {
        $today = date("Y-m-d");
        $begin = $today . " 00:00:00";
        $end = $today . " 23:59:59";
     }    
    return view('time.index', [
        "time_periods" => TimePeriod::where("created_at", ">", $begin)->where("created_at", "<", $end)->
          orderBy("start", "desc")->get(),
        "task_types" => TaskType::orderBy("name", "asc")->get(),
        "task_category_types" => TaskCategoryType::where("id", ">", 1)->orderBy("name", "asc")->get(),
    ]);
}]);
Route::get('TasksByCategoryForTimePeriod/{id}/TimePeriodID/{time_period_id}', function ($id, $time_period_id ) {
    return view('TasksByCategoryTypeForTimePeriod', [
        "active_task_category_type_id"=>$id,
        "time_period_id"=>$time_period_id,
        "task_categories"=>TaskCategory::where('task_category_type_id', $id)->get(),
        "task_category_types" => TaskCategoryType::orderBy("name", "asc")->get(),
        "selected_task_category_type"=>TaskCategoryType::where('id', $id)->first(),

    ]);
});

Route::resource("log", "LogController");
Route::resource("TagType", "TagTypeController");
Route::resource("tag", "TagController");
Route::resource("TimePeriod", "TimePeriodController");
Route::resource("TimePeriodNote", "TimePeriodNoteController");
Route::resource("task", "TaskController");
Route::resource("TaskNote", "TaskNoteController");
Route::resource("TaskType", "TaskTypeController");
Route::resource('TaskCategory', 'TaskCategoryController');
Route::resource('TaskCategoryType', 'TaskCategoryTypeController');
