<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public function task(){
        return $this->belongsTo('App\Task');
    }
    public function time_period(){
        return $this->belongsTo('App\TimePeriod');
    }
    public function type(){
        return $this->belongsTo("App\PersonType", 'person_type_id');
    }
}
