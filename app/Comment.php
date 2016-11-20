<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    // public $incrementing = true;
    protected $fillable = [
        'id', 'username', 'book_id', 'rating', 'comment'
    ];

    
    // protected $hidden = [
    //     'remember_token',
    // ];
// 
    public $timestamps = true;

    public function user(){
    	return $this->belongsTo('App\User', 'username', 'username');
    }

    public function book(){
        return $this->belongsTo('App\Book', 'book_id', 'book_id');
    }
}
