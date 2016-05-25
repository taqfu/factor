<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskCategory extends Model
{
    use SoftDeletes;
    protected $dates =["deleted_at"];

    public function type(){
        return $this->belongsTo("App\TaskCategoryType", "task_category_type_id");
    }   
    public function task_type(){
        return $this->belongsTo("App\TaskType", "task_type_id");
    }
}
