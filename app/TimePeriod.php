<?php

namespace App;
use Auth;
use DateTime;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimePeriod extends Model
{
    use SoftDeletes;
    protected $dates =["deleted_at"];
    public static function fetch_period($period){
        $period_data=["name"=>$period, "begin"=>"", "end"=>""];

        switch($period){
            case "all":
                $period_data['begin'] = TimePeriod::orderBy('created_at', 'asc')
                  ->first()->created_at;
                $period_data['end'] = date("Y-m-d") . " 23:59:59";
                break;
            case "yesterday":
                $period_data['begin'] = date("Y-m-d", strtotime("-1 days")) . " 00:00:00";
                $period_data['end'] = date("Y-m-d", strtotime("-1 days")) . " 23:59:59";
                break;
            case "week":
                $period_data['begin'] = date("Y-m-d", strtotime("-1 weeks")) . " 00:00:00";
                $period_data['end'] = date("Y-m-d") . " 23:59:59";
                break;
            default:
                $period_data['name']="today";
                $period_data['begin'] = date("Y-m-d") . " 00:00:00";
                $period_data['end'] = date("Y-m-d") . " 23:59:59";
                break;
        }
        return $period_data;

    }
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
    public static function is_there_one_already(){
        $date = new DateTime;
        $date->modify('-10 seconds');
        $formatted_date = $date->format('Y-m-d H:i:s');
        return count(DB::table('time_periods')->where('user_id', Auth::user()->id)
          ->where('created_at','>=',$formatted_date)->get())>0; 
    }
    public static function new_now(){
        $time_period = new TimePeriod;
        $time_period->start = date('Y-m-d H:i:s');
        $time_period->startGuess = false;
        $time_period->end = 0; 
        $time_period->endGuess = false;
        $time_period->user_id = Auth::user()->id;
        $time_period->save();
    }
    public function notes(){
        return $this->hasMany("App\Note");
    }
    public function tasks(){
        return $this->hasMany("App\Task");
    }
}
