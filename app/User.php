<?php

namespace App;
use Auth;
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
        if ($timezone == Config::get('app.timezone')){
            return $timestamp;
        }
      $original_timezone = date("Z");
      date_default_timezone_set($timezone);
      $timezone = date("Z");
      date_default_timezone_set(Config::get('app.timezone'));
      return $timestamp - ($original_timezone-$timezone);
    }
    public static function local_now($date_format){
        if (Auth::user()->timezone == Config::get('app.timezone')){
            return date($date_format);
        }
        $original_timezone = date("Z");
        date_default_timezone_set(Auth::user()->timezone);
        $timezone = date("Z");
        date_default_timezone_set(Config::get('app.timezone'));
        return date($date_format, time() - ($original_timezone-$timezone));
            
    }
}
