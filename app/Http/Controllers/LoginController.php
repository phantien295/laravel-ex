<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\User;

class LoginController extends Controller
{
    public function getLogin(){
    	return view('pages.main.login');
    }
    // Kiểm tra đăng nhập
    public function postLogin(Request $rs){
    	if(Auth::attempt(['username'=>$rs->username,  'password'=>$rs->password, 'level' => 1, 'status' => 1], true)){
    		return redirect('dashboard');
            // echo Auth::check();
            // echo Auth::user();
            // share()
            Auth::guard('web')->login(Auth::user());
    	}else if(Auth::attempt(['password'=>$rs->password, 'username'=>$rs->username,  'level' => 2, 'status' => 1], true)){
    		return redirect()->intended('/');
            // return URL::previous();
            // echo Auth::check();
            // echo Auth::user();
            // Auth::guard('web')->login(Auth::user());
    	}else{
    		return redirect()->back();
    	}
    }
}
