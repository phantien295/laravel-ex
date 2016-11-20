<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
	protected $table = 'books';

	public $incrementing = false;
    protected $fillable = [
        'book_id', 'name', 'author', 'publisher', 'cat_id', 'pages', 'description', 'price', 'image', 'quantity', 'status'
    ];

    public $timestamps = true;

    public function category(){
    	return $this->belongsTo('App\Category', 'cat_id', 'cat_id');
    }

    public function comments(){
    	return $this->hasMany('App\Comment', 'book_id', 'book_id');
    }

    public function promotion(){
        return $this->belongsTo('App\Promotion', 'book_id', 'book_id');
    }

    public function orderdetails(){
        return $this->hasMany('App\OrderDetail', 'book_id', 'book_id');
    }
}
