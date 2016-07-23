<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimePeriod extends Model
{
    use SoftDeletes;
    protected $dates =["deleted_at"];

    public function tasks(){
        return $this->hasMany("App\Task");
    }
    public function notes(){
        return $this->hasMany("App\TimePeriodNote");
    }
    public static function new_now(){
            $time_period = new TimePeriod;
            $time_period->start = date('Y-m-d H:i:s');
            $time_period->startGuess = false;
            $time_period->end = 0; 
            $time_period->endGuess = false;
            $time_period->save();
    }
}
