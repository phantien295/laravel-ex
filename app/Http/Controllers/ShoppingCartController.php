<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Book;
use App\Order;
use App\OrderDetail;
use Cart;
use App\Promotion;
use App\User;

class ShoppingCartController extends Controller
{
	public function cart($id){
		$book = Book::where('book_id', $id)->get()->first();
		return view('pages.main.cart', ['book' => $book]);
	}
	// Thêm sách vào giỏ hàng
    public function addCart($id){
    	$book = Book::where('book_id', $id)->get()->first();
        $percent = Promotion::where('book_id', $book->book_id)->get()->first();
        // Kiểm tra giảm giá trước khi thêm vào giỏ hàng
        if($percent){
            Cart::add($id, $book->name, 1, $book->price, ['img' => $book->image, 'percent' => $percent->percent])->tax(0);
        } else {
    	   Cart::add($id, $book->name, 1, $book->price, ['img' => $book->image, 'percent' => 0])->tax(0);
        }


    	return redirect('shoppingcart/cartdetail');
    }
    // Xóa sách ra khỏi giỏ hàng
    public function removeCart(){
    	Cart::remove('0803747a597fe01cc1f8722619bd8389');

    }
    // Cập nhật giỏ hàng
    public function updateCart($id){
    }
    // Xóa giỏ hàng
    public function destroyCart(){
    	Cart::destroy();
    	return redirect()->back();
    }
    // Chi tiết giỏ hàng
    public function cartDetail(){
    	return view('pages.main.cartdetail');
    }

    public function ajax(){
	    if(Request::ajax()){
	    	// Request::get('');
            // $book = Book::where('book_id', Request::get('id'))->get()->first();

        }
    }

    // Thanh toán
    public function checkout(){
        $customer = User::where('username', Auth::user()->username)->get()->first();
    	// $order = new Order;
    	// $order->order;
    	return view('pages.main.checkout', ['customer' => $customer]);
    }

    public function postCheckout(Request $rs){
        $remove = 0; //Đếm sản phẩm bị hết hàng trong giỏ
        foreach (Cart::content() as $book) {
            if(Book::where('book_id', $book->id)->get()->first()->quantity == 0){
                $remove++;
                Cart::remove($book->rowId);
            }
        }
        if($remove > 0){
            echo "<script>
            alert('Có sản phẩm trong giỏ hàng của bạn đã hết số lượng!');
            window.location = '".url('shoppingcart/cartdetail')."';</script>";
        }else{

            $this->validate($rs, [
                    'address' => 'required',
                    'phone' => 'required|phone'
                ]);
            $total = 0; // Lưu tổng hóa đơn
            $order = new Order;
            $orderid = null;
            // Tạo orderid
            $count = Order::count();
            if($count == 0) $orderid = 1;
            else{
                $lastorder = Order::all()->max('orderid');
                $orderid = $lastorder + 1;
            }
            foreach(Cart::content() as $book){
                $total += $book->price*$book->qty - $book->price*$book->qty*$book->options->percent/100;    
            }
            
            $order->orderid = $orderid;
            $order->username = Auth::user()->username;
            $order->total = $total;
            $order->address = $rs->address;
            $order->phone = $rs->phone;
            $order->save();

            // Lưu chi tiết hóa đơn
            foreach(Cart::content() as $book){
                $orderdetail = new OrderDetail;
                $orderdetail->orderid = $orderid;
                $orderdetail->book_id = $book->id;
                $orderdetail->quantity = $book->qty;
                $orderdetail->percent = $book->options->percent;
                $orderdetail->price = $book->price*$book->qty - $book->price*$book->qty*$book->options->percent/100;
                $orderdetail->save();
                // Cập nhật lại số lượng sách
                $bk = Book::where('book_id', $book->id)->get()->first();
                $bk->quantity = $bk->quantity - $book->qty;
                Book::where('book_id', $book->id)->update($bk->toArray());
            }

            Cart::destroy();

            echo "<script>
                alert('Bạn đã đặt hàng thành công!');
                window.location = '".url('/')."';</script>";
        }
    }
}
