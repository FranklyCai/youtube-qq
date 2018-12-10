<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'avatar','updated_at', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
//    protected $hidden = [
//        'password', 'remember_token','email','updated_at','created_at'
//    ];

    // public function roles(){
    //     return $this->belongsToMany(Role::class);
    // }

    public function videos(){
        return $this->hasMany('App\Video');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }
}
