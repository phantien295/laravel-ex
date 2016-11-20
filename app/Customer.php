<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

	public $incrementing = false;
    protected $fillable = [
        'cust_acc', 'avatar', 'firstname', 'lastname', 'gender', 'address', 'email', 'phone'
    ];

    public $timestamps = false;

    public function comments(){
    	return $this->hasMany('App\Comment', 'cust_acc', 'cust_acc');
    }
}
