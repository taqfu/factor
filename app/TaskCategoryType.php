<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskCategoryType extends Model
{
    use SoftDeletes;
    protected $dates =["deleted_at"];

    public function categories (){
        return $this->hasMany('App\TaskCategory', "task_category_type_id");
    }
    public static function total_hours($id){
        if (Auth::guest() || Auth::user()->id != TaskCategoryType::find($id)->user_id){
            return false;
        }
        $sum=0;
        $task_types = TaskType::join('task_categories', 'task_types.id', '=', 'task_categories.task_type_id')->where('task_categories.task_category_type_id', $id)->get();
        foreach($task_types as $task_type){
            $sum += TaskType::total_hours($task_type->id);
        }
        return $sum;
    }
}

