<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    protected $dates =["deleted_at"];

    public function type(){
        return $this->belongsTo("App\TaskType");
    }
    public function notes(){
        return $this->hasMany("App\Note");
    }
    public function people(){
        return $this->hasMany('App\Person');
    }
    public function time_period(){
        return $this->belongsTo('App\TimePeriod');
    }
}
