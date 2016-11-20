<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CommentRequest;
use App\Comment;

class CommentController extends Controller
{
    public function getComment(){

    }
    // Thêm bình luận
    public function postComment(CommentRequest $rs){
    	$comment = new Comment;
    	$comment->username = $rs->account;
    	$comment->book_id = $rs->book_id;
    	$comment->rating = $rs->rating;
    	$comment->comment = $rs->comment;
    	$comment->save();
    	return redirect()->back();
    }
    // Cập nhật bình luận, đánh giá
    public function postEditComment(CommentRequest $rs){
        $comment = Comment::where('book_id', $rs->book_id)->where('username', $rs->account)->get()->first();
        $comment->username = $rs->account;
        $comment->book_id = $rs->book_id;
        $comment->rating = $rs->rating;
        $comment->comment = $rs->comment;
        Comment::where('book_id', $rs->book_id)->where('username', $rs->account)->update($comment->toArray());
        return redirect()->back();
    }
    // Xóa bình luận
    public function delComment($id){
        $comment = Comment::find($id)->delete();
        return redirect()->back();
    }
}
