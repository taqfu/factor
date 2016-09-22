<?php

namespace App;
use Config;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public static function local_time($timezone, $timestamp){
      date_default_timezone_set($timezone);
      $timezone = date("Z");
      date_default_timezone_set(Config::get('app.timezone'));
      return $timestamp + $timezone;
    }
}
