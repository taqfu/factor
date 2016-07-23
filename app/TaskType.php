<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;
use \PDO;
use Route;
class TaskType extends Model
{
    use SoftDeletes;
    protected $dates =["deleted_at"];
    public function categories(){
        return $this->hasMany('App\TaskCategory', 'task_type_id', 'task_type_id');
    }
/*
    public static function categories ($id){
        return TaskCategoryType::join("task_categories", 'task_category_type_id', 
          '=', "task_category_types.id")->where('task_categories.task_type_id', $id)
          ->orderBy('task_category_types.name', 'asc')->get();
    }
*/
    public static function total_time($id){
            $date = date("Y-m-d") . " 00:00:00";
            $query="select sum(time_to_sec(timediff(time_periods.end, 
              time_periods.start))) from time_periods inner join tasks 
              on tasks.time_period_id=time_periods.id where 
              time_periods.end>'$date' and tasks.type_id=$id 
              and time_periods.deleted_at is null and tasks.deleted_at is null";
        $dbh = new PDO 
          ('mysql:host=localhost;dbname=factor', 'root',  env('DB_PASSWORD') );
        $statement = $dbh->query($query);
        return $statement->fetchColumn();
    }
}
