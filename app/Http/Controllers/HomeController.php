<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Book;
use App\Comment;
use App\Category;
use Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listbook = Book::where('status', true)->paginate(8);
        $last = Book::where('status', true)->get()->last();
        $catlist = Category::all();
        return view('pages.main.home', ['listbook' => $listbook, 'catlist' => $catlist, 'last' => $last]);
    }

    public function bookDetail($id){
        $book = Book::where('book_id', $id)->get()->first();
        $comment = Comment::where('book_id', $id)->get();
        return view('pages.main.bookdetail', ['book' => $book, 'comment' => $comment]);
    }
    //Danh theo từng thể loại
    public function catList($id){
        $title = Category::where('cat_id', $id)->get()->first();
        $listbook = Book::where('cat_id', $id)->where('status', true)->paginate(12);
        return view('pages.main.category', ['title' => $title, 'listbook' => $listbook]);
    }
    // Chức năng tìm kiếm
    public function postFind(Request $rs){
        return redirect("findbook/$rs->cat/$rs->keyword");
    }
    public function getFind(Request $rs){
        $keyword = $rs->keyword;
        $cat = $rs->cat;
        if($cat == "author"){
            $result = Book::where('author', 'like', '%'.$keyword.'%')->where('status', true)->paginate(9);
        }else if($cat == "publisher"){
            $result = Book::where('publisher', 'like', '%'.$keyword.'%')->where('status', true)->paginate(9);
        }else{
            $result = Book::where('name', 'like', '%'.$keyword.'%')->where('status', true)->paginate(9);
        }
        return view('pages.main.findbook', ['result' => $result]);
    }
    //Phản hồi - Đóng góp ý kiến
    public function contact(){
        return view('pages.main.contact');
    }
    //Góp ý
    public function postContact(ContactRequest $rs){
        $message = $rs->message;
        $GLOBALS['email'] = $rs->email;
        Mail::raw($message, function ($message) {
            $message->from('tintac295@gmail.com', $GLOBALS['email']);
            $message->sender($GLOBALS['email']);
            $message->replyTo($GLOBALS['email']);
            $message->to('tienb1304915@gmail.com', 'tienb1304915');
            $message->subject('Góp ý');
        });
        echo "<script>
            alert('Cảm ơn bạn đã góp ý cho website của chúng tôi!');
            window.location = '".url('/')."';</script>";
    }
}
