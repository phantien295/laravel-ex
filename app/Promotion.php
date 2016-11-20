<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
	protected $table = 'promotions';
	protected $fillable = ['book_id', 'percent'];

	public $timestamps = false;
    
    public function book(){
    	return $this->belongsTo('App\Book', 'book_id', 'book_id');
    }
}
