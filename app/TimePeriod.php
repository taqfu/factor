<?php

namespace App;
use DateTime;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimePeriod extends Model
{
    use SoftDeletes;
    protected $dates =["deleted_at"];
    public static function format_interval($begin, $end){
        $begin = new DateTime($begin);
        if ($end == "now"){
            $end = new DateTime(date('y-m-d H:i:s'));
        } else {
            $end = new DateTime($end);
        }
        $interval = $end->diff($begin);
        $string="";
        $string = $interval->y>0 ? $string . $interval->y . "Y" : $string;
        $string = $interval->m>0 ? $string . $interval->m . "M" : $string;
        $string = $interval->d>0 ? $string . $interval->d . "D" : $string;
        $string = $interval->h>0 ? $string . $interval->h . "h" : $string;
        $string = $interval->i>0 ? $string . $interval->i . "m" : $string;
        $string = $interval->s>0 ? $string . $interval->s . "s" : $string;
        return $string;

    }
    public static function interval($start, $end){
         return (int) DB::select("select unix_timestamp(?) - unix_timestamp(?)
          as output", [$end, $start])[0]->output;

    }
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
