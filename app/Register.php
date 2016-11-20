<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    protected $table = 'users';

	public $incrementing = true;
    protected $fillable = [
        'username', 'password', 'email', 'level'
    ];

    public $timestamps = true;
}
