<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Order;
use App\OrderDetail;
use App\Book;

class OrderController extends Controller
{
    public function listOrder(){
    	$orderlist = Order::where('status', true)->paginate(10); //Danh sách hóa đơn đã vận chuyển
        $newOrderlist = Order::where('status', false)->get();//->paginate(10); //Danh sách hóa đơn chưa vận chuyển
    	return view('pages.admin.order', ['orderlist' => $orderlist, 'newOrderlist' => $newOrderlist]);
    }
    //Chi tiết hóa đơn
    public function orderDetail($id){
    	$orderdetail = OrderDetail::where('orderid', $id)->get();
    	return view('pages.admin.orderdetail', ['orderdetail' => $orderdetail]);
    }
    //Danh sách hóa đơn của một cuốn sách
    public function bookorder($id){
    	$orderlist = OrderDetail::where('book_id', $id)->get();
    	return view('pages.admin.bookorder', ['orderlist' => $orderlist]);
    }

    public function check($id){
        $order = Order::where('orderid', $id)->get()->first();
        $order->status = true;
        Order::where('orderid', $id)->update($order->toArray());
        return redirect()->back();
    }
}
