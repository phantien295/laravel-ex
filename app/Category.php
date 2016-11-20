<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

	public $incrementing = false;
    protected $fillable = [
        'cat_id', 'name'
    ];

    public $timestamps = false;
    //Một thể loại có nhiều sách
  //   public function books(){
		// return $this->hasMany('App\Book', 'cat_id');
  //   }
}
