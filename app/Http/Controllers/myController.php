<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;

class myController extends Controller
{
    public function getContact(){
    	return view('demo.myview');
    }

    public function postContact(Request $rs){
    	$data = ['name' => 'pmtien'];
    	Mail::raw('Good night and have a nice day!!!', function ($message) {
    		$message->from('tintac295@gmail.com', 'pmtien');
    	    $message->to('tienb1304915@gmail.com', 'John Doe')->subject('SUCCESS');
    	    
    	});

    }

    public function getUpload(){
        return view('upload');
    }

    public function postUpload(Request $rs){
        if ($rs->file('image')->isValid()){
            $rs->file('image')->move('public/uploads', $rs->file('image')->getClientOriginalName());
        }else{
            echo 'Error!!!';
        }
        
    }
}
