<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskCategoryType extends Model
{
    use SoftDeletes;
    protected $dates =["deleted_at"];

    public function categories (){
        return $this->hasMany('App\TaskCategory', "task_category_type_id");
    }
}
