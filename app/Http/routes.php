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
Route::get('TasksByCategoryForTimePeriod/{id}/TimePeriodID/{time_period_id}', 
  function ($id, $time_period_id ) {
    return view('TasksByCategoryTypeForTimePeriod', [
        "active_task_category_type_id"=>$id,
        "time_period_id"=>$time_period_id,
        "task_categories"=>TaskCategory::where('task_category_type_id', $id)->get(),
        "task_category_types" => TaskCategoryType::orderBy("name", "asc")->get(),
        "task_types"=>TaskType::join('task_categories', 'task_type_id', '=', 
          'task_types.id')->where('task_categories.task_category_type_id', $id)
          ->orderBy('task_types.name', 'asc')->get(),
        "selected_task_category_type"=>TaskCategoryType::where('id', $id)->first(),
    ]);
});

Route::resource("time", "TimePeriodController");
Route::resource("TimePeriodNote", "TimePeriodNoteController");
Route::resource("task", "TaskController");
Route::resource("TaskNote", "TaskNoteController");
Route::resource("TaskType", "TaskTypeController");
Route::resource('TaskCategory', 'TaskCategoryController');
Route::resource('TaskCategoryType', 'TaskCategoryTypeController');
