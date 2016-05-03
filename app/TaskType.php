<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskType extends Model
{
    use SoftDeletes;
    protected $dates =["deleted_at"];
    public function categories (){
        return $this->hasMany('App\TaskCategory');
    }
}
