<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'orderdetails';

	// public $incrementing = false;
    protected $fillable = [
        'orderid', 'book_id', 'quantity', 'percent', 'price'
    ];

    public $timestamps = false;
    //Quan hệ giữa orderdetail - book
    public function book(){
    	return $this->belongsTo('App\Book', 'book_id', 'book_id');
    }

    public function order(){
    	return $this->belongsTo('App\Order', 'orderid', 'orderid');
    }
}