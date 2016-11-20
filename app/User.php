<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    // public $incrementing = true;
    protected $fillable = [
        'username', 'password', 'level', 'avatar', 'fullname', 'gender', 'address', 'email', 'phone', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];
// 
    public $timestamps = true;
}
