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
}
