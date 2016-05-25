<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    use SoftDeletes;
    protected $dates =["deleted_at"];

    public function tags () {
        return $this->hasMany("\App\Tag");
    }
}
