<?php
use \App\Log;
use \App\TagType;
use \App\TaskType;
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
Route::get('time/', ["as"=>"time", function () {
    return view('time', [
        "time_periods" => TimePeriod::orderBy("start", "desc")->get(),
        "task_types" => TaskType::orderBy("name", "asc")->get(),
    ]);
}]);

Route::resource("log", "LogController");
Route::resource("TagType", "TagTypeController");
Route::resource("tag", "TagController");
Route::resource("TimePeriod", "TimePeriodController");
Route::resource("task", "TaskController");
Route::resource("TaskNote", "TaskNoteController");
Route::resource("TaskType", "TaskTypeController");
