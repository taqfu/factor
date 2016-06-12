<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;
use \PDO;
class TaskType extends Model
{
    use SoftDeletes;
    protected $dates =["deleted_at"];

    public function categories (){
        return $this->hasMany('App\TaskCategory');
    }
    public static function total_time($id){
        $date = date("Y-m-d") . " 00:00:00";
        $dbh = new PDO ('mysql:host=localhost;dbname=factor', 'root', '');
        $statement = $dbh->query("select sum(time_to_sec(timediff(time_periods.end, time_periods.start))) from time_periods inner join tasks on tasks.time_period_id=time_periods.id where time_periods.end>'$date' and tasks.type_id=$id and time_periods.deleted_at is null and tasks.deleted_at is null");
        return $statement->fetchColumn();
    }
}
