<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\AddBookRequest;
use App\Http\Requests\SaleoffRequest;
use App\Http\Requests\EditBookRequest;
use App\Category;
use App\Book;
use App\Order;
use App\OrderDetail;
use App\Promotion;
use Cart;
use Validator;

class BookController extends Controller
{
 	public function getBook(){
 		$cat = Category::all()->toArray();
		return view('pages.books.addbook', ['cat' => $cat]); //Gửi danh sách thể loại đến view
 	}

 	public function postBook(AddBookRequest $rs){
 		$file = $rs->file('image');
 		$file->move('public/uploads/images', $file->getClientOriginalName());

 		$book = new Book;
 		$book->book_id = $rs->book_id;
 		$book->name = $rs->name;
 		$book->author = $rs->author;
 		$book->publisher = $rs->publisher;
 		$book->cat_id = $rs->cat_id;
 		$book->pages = $rs->pages;
 		$book->description = $rs->description;
 		$book->price = $rs->price;
 		$book->image = $file->getClientOriginalName();
 		$book->quantity = $rs->quantity;
 		$book->status = 1;
 		$book->save();
 		return redirect('admin/addbook')->with('result', 'Thêm mới sách thành công');
 	}

 	// Chỉnh sửa thông tin sách
	public function editBook($id){
		$cat = Category::all()->toArray();
 		$book = Book::where('book_id', $id)->get()->first()->toArray();
		// return view('pages.books.addbook', ['cat' => $cat]); //Gửi danh sách thể loại đến view
		return view('pages.books.editbook', ['book' => $book, 'cat' => $cat]);
 	}
 	// Chỉnh sửa thông tin sách
 	public function postEditBook(EditBookRequest $rs){
		$book = Book::where('book_id', $rs->book_id)->get()->first();//Thay thế cho find
 		$book->name = $rs->name;
 		$book->author = $rs->author;
 		$book->publisher = $rs->publisher;
 		$book->cat_id = $rs->cat_id;
 		$book->pages = $rs->pages;
 		$book->description = $rs->description;
 		//Đổi ảnh
 		if($rs->hasFile('new_image')){
 			unlink('public/uploads/images/'.$rs->current_image);//Xóa ảnh cũ
 			$file = $rs->file('new_image');
 			$file->move('public/uploads/images', $file->getClientOriginalName());
 			$book->image = $file->getClientOriginalName();
 		}else{
 			$book->image = $rs->current_image;
 		}
 		$book->price = $rs->price;
 		$book->quantity = $rs->quantity;
 		// $book->save();
 		Book::where('book_id', $rs->book_id)->update($book->toArray());
 		return redirect('admin/editbook/'.$rs->book_id)->with('result', 'Cập nhật sách thành công');
 	} 
 	//Danh sách book
	public function listBook(){
 		$list = Book::all();
		return view('pages.books.listbook', ['list' => $list]); //Gửi danh sách đến view
 	}
 	//Tìm kiếm sách
 	public function getFindBook(){
 		return view('pages.books.findbook');
 	}

 	public function findBook(Request $rs){

 		if($rs->cat == "book_id"){
 			if(Book::where('book_id', $rs->find)){
 				return view('pages.books.findbook', ['result' => Book::where('book_id', $rs->find)->get()]);
 			}else{
 				return redirect('admin/findbook');
 			}	
 		}
 		
		if($rs->cat == "name"){
 			if(Book::where('name', 'like', '%'.$rs->find.'%')){
 				return view('pages.books.findbook', ['result' => Book::where('name', 'like', '%'.$rs->find.'%')->get()]);
 			}else{
 				return redirect('admin/findbook');
 			}	
 		}

		if($rs->cat == "author"){
 			if(Book::where('author', 'like', '%'.$rs->find.'%')){
 				return view('pages.books.findbook', ['result' => Book::where('author', 'like', '%'.$rs->find.'%')->get()]);
 			}else{
 				return redirect('admin/findbook');
 			}	
 		} 		

 		if($rs->cat == "publisher"){
 			if(Book::where('publisher', 'like', '%'.$rs->find.'%')){
 				return view('pages.books.findbook', ['result' => Book::where('publisher', 'like', '%'.$rs->find.'%')->get()]);
 			}else{
 				return redirect('admin/findbook');
 			}	
 		}
 	}
 	//Sách giảm giá
 	public function saleoff(){
 		$promotion = Promotion::paginate(10);
 		$book = Book::all();
 		return view('pages.books.saleoff', ['promotion' => $promotion, 'books' => $book]);
 	}
 	//Xóa giảm giá
 	public function delSaleoff($id){
 		Promotion::where('book_id', $id)->delete();
 		foreach (Cart::content() as $book) {
 			if($book->id == $id){
 				Cart::update($book->rowId, ['options' => ['img' => $book->options->img,'percent' => 0]]);
 				break;
 			}
 		}
 		return redirect()->back();
 	}
 	//Thêm sách giảm giá
 	//Nếu để trống phần trăm thì mặc định sẽ là 0
 	public function addSaleoff(SaleoffRequest $rs){
 		//Nếu sách đã có giảm giá sẽ cập nhật lại mức giảm

 		$rs->id = $rs->book_id;
 		$count = Promotion::where('book_id', $rs->id)->count(); 
 		if($rs->percent == 0){
 			Promotion::where('book_id', $rs->id)->delete();

 			foreach (Cart::content() as $book) {
 				if($book->id == $rs->id){
 					Cart::update($book->rowId, ['options' => ['img' => $book->options->img,'percent' => 0]]);
 					break;
 				}
 			}		
 		}else{
	 		if($count > 0){
	 			$promotion = Promotion::where('book_id', $rs->id)->get()->first();
	 			$promotion->percent = $rs->percent;
	 			Promotion::where('book_id', $rs->id)->update($promotion->toArray());

	 			foreach (Cart::content() as $book) {
 					if($book->id == $rs->id){
 						Cart::update($book->rowId, ['options' => ['img' => $book->options->img,'percent' => $rs->percent]]);
 						break;
 					}
 				}		
	 		}else{
		 		$promotion = new Promotion;
		 		$promotion->book_id = $rs->id;
		 		$promotion->percent = $rs->percent;
		 		$promotion->save();

		 		foreach (Cart::content() as $book) {
 					if($book->id == $rs->id){
 						Cart::update($book->rowId, ['options' => ['img' => $book->options->img,'percent' => $rs->percent]]);
 						break;
 					}
 				}		
	 		}
	 	}
	 	return redirect()->back();
 	}

 	public function hide($id){
 		$book = Book::where('book_id', $id)->get()->first();
 		$book->status = false;
 		Book::where('book_id', $id)->update($book->toArray());
 		return redirect()->back();
 	}
 	public function unhide($id){
 		$book = Book::where('book_id', $id)->get()->first();
 		$book->status = true;
 		Book::where('book_id', $id)->update($book->toArray());
 		return redirect()->back();
 	}
}
