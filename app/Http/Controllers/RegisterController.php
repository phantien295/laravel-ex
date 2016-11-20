<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\RegisterRequest;
use App\User;


class RegisterController extends Controller
{
    public function getRegister(){
    	return view('pages.main.register');
    }

    public function postRegister(RegisterRequest $rs){
    	$user = new User;
        //Tạo id để xác thực 
        if(User::count() == 0){
            $user->id = 1;  
        }else{
            $user->id = User::all()->max('id') + 1;
        }
    	$user->username = $rs->username;
    	$user->password = bcrypt($rs->password);
    	$user->level = 2;
        $user->remember_token = $rs->_token;
        $user->avatar = $rs->avatar;
        $user->fullname = $rs->fullname;
        $user->gender = $rs->gender;
        $user->address = $rs->address;
        $user->email = $rs->email;
        $user->phone = $rs->phone;
        $user->status = true;
        $user->save();
        return redirect('register')->with('result', 'Đăng ký thành công');
    }
}
