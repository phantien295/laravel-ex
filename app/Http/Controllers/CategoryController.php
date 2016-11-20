<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CategoryRequest;

use App\Category;
use App\Book;
use Validator;

class CategoryController extends Controller
{
    public function getCat(){
    	return view('pages.categories.addCategories');
    }

    public function postCat(CategoryRequest $rs){
        $cat = new Category;
        $cat->cat_id = $rs->cat_id;
        $cat->name = $rs->name;
        $cat->save();
        return redirect('admin/addcat')->with('result', 'Thêm mới thể loại sách thành công');
    }
    //Danh sách thể loại
    public function listCat(){
        $cats = Category::all();
        return view('pages.categories.listcat', ['cats' => $cats]);
    }
    //Sách theo thể loại
    public function bookCat($id){
        $books = Book::where('cat_id', $id)->get();
        return view('pages.categories.bookcat', ['books' => $books]);
    }

    public function editCat(){

    }

    public function deleteCat(){

    }
}
