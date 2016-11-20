<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\User;
use App\Order;

class UserController extends Controller
{
    public function getUser($id){
    	$user = User::where('username', $id)->get()->first();
    	return view('pages.main.user', ['user' => $user]);
    }
    //Cập nhật thông tin người dùng
    public function postUserInfo(Request $rs){
        $this->validate($rs, [
                'phone' => 'required|phone',
                'address' => 'required'
            ]);
    		$user = User::find($rs->id);
    		$user->address = $rs->address;
    		$user->phone = $rs->phone;
    		$user->save();	
    	return back()->with('success', 'success');
    }
    public function postUserPass(UserRequest $rs){
        $user = User::find($rs->id);
        $user->password = bcrypt($rs->password);
        $user->save();
        return back()->with('success', 'success');
    }
    //Quản lý người dùng
    public function user(){
        $users = User::where('level', 2)->paginate(10);
        return view('pages.admin.user', ['users' => $users]);
    }
    //Tìm kiếm người dùng
    public function finduser(Request $rs){
        $users = User::where('username', 'like', '%'.$rs->keyword.'%')->where('level', 2)->get();
        return view('pages.admin.finduser', ['users' => $users]);
    }
    //Khóa người dùng
    public function lock($id){
        $user = User::find($id);
        $user->status = false;
        $user->update();
        return redirect()->back();
    }
    //Mở khóa người dùng
    public function unlock($id){
        $user = User::find($id);
        $user->status = true;
        $user->update();
        return redirect()->back();
    }

    //Liệt kê hóa đơn theo người dùng
    public function userOrder($id){
        $list = Order::where('username', $id)->get();
        return view('pages.admin.userorder', ['list' => $list]);
    }
}