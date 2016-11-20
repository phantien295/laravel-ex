<?php
// Tim hoa don tu ngay den ngay
view()->share('catlist', App\Category::all());

Route::get('/', 'HomeController@index');

Route::get('/contact', ['as' => 'getContact', 'uses' => 'myController@getContact']);

Route::post('/contact', ['as' => 'postContact', 'uses' => 'myController@postContact']);

Route::get('logout', function(){
    Auth::logout();
    return redirect()->back();
});


//Trang quản trị
Route::group(['middleware' => ['auth', 'level']], function() {
    Route::get('/dashboard', ['middleware'=>'level' , function() {
        return view('pages.admin.dashboard');
    }]);    

    //Phần quản trị
    Route::group(['prefix' => 'admin'], function(){
        //Thêm sách
        Route::get('addbook', ['as' => 'getBook', 'uses' => 'BookController@getBook']);
        Route::post('addbook', ['as' => 'postBook', 'uses' => 'BookController@postBook']);
        //Chỉnh sửa thông tin sách
        Route::get('editbook/{id}', 'BookController@editBook');
        Route::post('editbook', ['as' => 'postEditBook', 'uses' => 'BookController@postEditBook']);
        //Danh sách book
        Route::get('listbook', 'BookController@listBook');
        Route::get('listBook', function() { // Ajax - jtable - Danh sách books
            if(Request::ajax()){
                $sort = explode(' ', Request::get('sort'));
                $book = DB::table('books')->orderBy($sort[0], $sort[1])->skip(Request::get('skip'))->take(Request::get('size'))->get();
                $books = array();
                foreach ($book as $key){
                    $key->price = number_format($key->price)."đ";
                    $key->cat_id = App\Category::where('cat_id', $key->cat_id)->get()->first()->name;
                    $key->edit = '<a class="btn btn-default btn-xs" href="'.url("admin/editbook/".
                        $key->book_id).'"><span class="glyphicon glyphicon-edit"></span> Edit</a>';
                    if($key->status){
                        $key->edit .= '<a class="btn btn-default btn-xs" href="'.url("admin/hide/".$key->book_id).'"><span class="glyphicon glyphicon-remove-sign"></span> Ngừng bán</a>';
                    } else {
                        $key->edit .= '<a class="btn btn-default btn-xs" href="'.url("admin/unhide/".$key->book_id).'"}}"><span class="glyphicon glyphicon-ok-sign"></span> Bán</a>';
                    }
                    // Mã sách
                    $key->code = '<a href="'.url("admin/bookorder/".$key->book_id).'">'.$key->book_id.'</a>';
                    
                    $books[] = $key;
                }

                $jTableResult = array();
                $jTableResult['Result'] = "OK";
                $jTableResult['TotalRecordCount'] = App\Book::all()->count();
                $jTableResult['Records'] = $books;
                return json_encode($jTableResult);
            }
        });
        //Thể loại
        Route::get('addcat', ['as' => 'getCat', 'uses' => 'CategoryController@getCat']);
        Route::post('addcat', ['as' => 'postCat', 'uses' => 'CategoryController@postCat']);
        Route::get('listcat', 'CategoryController@listCat'); //Danh sách thể loại
        Route::get('bookcat/{id}', 'CategoryController@bookCat'); //Sách theo thể loại
        //Tìm kiếm sách cho người quản trị
        Route::get('findbook', 'BookController@getFindBook');
        Route::get('getfindbook', 'BookController@findBook');
        //Sách giảm giá
        Route::get('saleoff', 'BookController@saleoff');
        Route::get('delsaleoff/{id}', 'BookController@delSaleoff'); //Xóa sách giảm giá
        Route::post('addSaleoff', ['as' => 'addSaleoff', 'uses' => 'BookController@addSaleoff']);
        //Quản lý hóa đơn
        // Route::get('order', 'OrderController@listOrder'); //Danh sách hóa đơn
        Route::get('order', 'OrderController@listOrder'); //Danh sách hóa đơn
        Route::get('orderdetail/{id}', 'OrderController@orderDetail'); //Chi tiết hóa đơn
        Route::get('check/{id}', 'OrderController@check');

        // Ajax - jtable - Tất cả hóa đơn
        Route::get('orderJtable', function() {
            if(Request::ajax()){
                $sort = explode(' ', Request::get('sort'));
                $book = DB::table('orders')->orderBy($sort[0], $sort[1])->skip(Request::get('skip'))->take(Request::get('postData'))->get();
                $books = array();
                foreach ($book as $key){
                    $key->total = number_format($key->total)."đ";
                    $books[] = $key;
                }
                $jTableResult = array();
                $jTableResult['Result'] = "OK";
                $jTableResult['TotalRecordCount'] = App\Order::all()->count();
                $jTableResult['Records'] = $books;
                return json_encode($jTableResult);
            }
        });

        Route::get('postJtable', function() {
            if(Request::ajax()){
                $book = App\OrderDetail::where('orderid', Request::get('postData'))->get();
                $books = array();
                foreach ($book as $key) {
                    $key->book_id = App\Book::where('book_id', $key->book_id)->get()->first()->name;
                    $key->percent = $key->percent."%";
                    $key->price = number_format($key->price)."đ";
                    $books[] = $key;
                }
                $jTableResult = array();
                $jTableResult['Result'] = "OK";
                $jTableResult['TotalRecordCount'] = App\OrderDetail::where('orderid', Request::get('postData'))->count();
                $jTableResult['Records'] = $books;
                return json_encode($jTableResult);
            }
        });

        Route::get('orderRequest', function() {
            if(Request::ajax()){
                // $count = App\Order::whereDate('created_at', '=', Request::get('date'))->get()->first();
                // date('Y-m-d', strtotime('created_at'))
                // $count2 = App\Order::all()->first();
                // $count = date('yy-mm-dd', $count2->created_at);
                // $count = App\Order::all()->first();
                //App\Order::whereDate('created_at', Request::get('date'))->count();
                $count = App\Order::whereDate('created_at', '=', Request::get('date'))->get();
                // $count = App\Order::paginate(1);
                return $count;
            }
        });
        Route::get('orderRequest2', function() {
            if(Request::ajax()){
                if(Request::get('date1') > Request::get('date2')){
                    $count = App\Order::whereDate('created_at', '>=', Request::get('date2'))->whereDate('created_at', '<=', Request::get('date1'))->get();
                    return $count;   
                }else{
                    $count = App\Order::whereDate('created_at', '>=', Request::get('date1'))->whereDate('created_at', '<=', Request::get('date2'))->get();
                    return $count;
                }
            }
        });
        //Danh sách hóa đơn của một sách
        Route::get('bookorder/{id}', 'OrderController@bookorder');
        //Thay đổi tình trạng của sách
        Route::get('hide/{id}', 'BookController@hide');
        Route::get('unhide/{id}', 'BookController@unhide');

        //Quản lý người dùng
        Route::get('user', 'UserController@user');
        Route::get('lock/{id}', 'UserController@lock'); //khóa người dùng
        Route::get('unlock/{id}', 'UserController@unlock'); //Mở khóa người dùng
        Route::get('finduser', 'UserController@finduser'); //Tìm kiếm người dùng
        Route::get('userorder/{id}', 'UserController@userOrder');
        Route::get('listUser', function() { // Ajax - jtable - Danh sách người dùng
            if(Request::ajax()){
                $sort = explode(' ', Request::get('sort'));
                $book = DB::table('users')->where('level', 2)->orderBy($sort[0], $sort[1])->skip(Request::get('skip'))->take(Request::get('size'))->get();
                $books = array();
                foreach ($book as $key){
                    // $key->edit = '<a class="btn btn-default btn-xs" href="'.url("admin/editbook/".
                    //     $key->book_id).'"><span class="glyphicon glyphicon-edit"></span> Edit</a>';
                    // if($key->status){
                    //     $key->edit .= '<a class="btn btn-default btn-xs" href="'.url("admin/hide/".$key->book_id).'"><span class="glyphicon glyphicon-ok-sign"></span></a>';
                    // } else {
                    //     $key->edit .= '<a class="btn btn-default btn-xs" href="'.url("admin/unhide/".$key->book_id).'"}}"><span class="glyphicon glyphicon-remove-sign"></span></a>';
                    // }
                    // // Mã sách

                    if($key->status)
                        $key->edit = '<a href="'.url("admin/lock/".$key->id).'"><span class="glyphicon glyphicon-ban-circle"></span> Khóa</a>';
                    else
                        $key->edit = '<a href="'.url("admin/unlock/".$key->id).'"><span class="glyphicon glyphicon-ok-circle"></span> Mở khóa</a>';

                    if($key->status)
                        $key->status = '<span class="glyphicon glyphicon-time"></span> Hoạt động';
                    else
                        $key->status = '<span class="glyphicon glyphicon-lock"></span> Khóa';

                    $key->username = '<a href="'.url("admin/userorder/".$key->username).'">'.$key->username.'</a>';
                    $books[] = $key;
                }

                $jTableResult = array();
                $jTableResult['Result'] = "OK";
                $jTableResult['TotalRecordCount'] = App\User::where('level', 2)->count();
                $jTableResult['Records'] = $books;
                return json_encode($jTableResult);
            }
        });
    });
});

//Route::auth();


Route::get('/book', function() {
    return view('pages.main.home');
});



Route::get('/demo', function(){
	return view('demo');
});


// Route::get('/home', 'HomeController@index');


Route::get('member', function() {
    return view('pages.main.home');
});

// Đăng ký
Route::get('register',['middleware' => 'login', 'uses' => 'RegisterController@getRegister']);
Route::post('register', ['as' => 'postRegister', 'uses' => 'RegisterController@postRegister']);
// Đăng nhập
Route::get('login', 'LoginController@getLogin');
Route::post('postlogin', ['as' => 'postLogin', 'uses' => 'LoginController@postLogin']);
// Chi tiết sách
Route::get('books/{id}', 'HomeController@bookDetail');


/*-- Cơ sở dữ liệu --*/
Route::group(['prefix' => 'database'], function() {
    Route::get('/orders', function() {
        Schema::create('orders', function($table){
            $table->string('orderid', 50)->primary();
            $table->string('cust_acc', 50);
            $table->date('orderdate');
        });
    });

	Route::get('/orderdetails', function() {
        Schema::create('orderdetails', function($table){
            $table->string('orderid', 50)->primary();
            $table->string('book_id', 20);
            $table->integer('amount');
        });
    });  

    Route::get('admin', function() {
          DB::table('users')->insert([
            'username' => 'admin',
            'password' => bcrypt('12345678'),
            'level' => 1,
            // 'remember_token' => csrf_field(),
        ]);
      });  
});
//Liệt kê sách theo từng thể loại
Route::get('cat/{id}', 'HomeController@catList');
// Thêm đánh giá
Route::post('comment', ['as' => 'postComment', 'uses' => 'CommentController@postComment']);
Route::get('delcomment/{id}', 'CommentController@delComment');
// Chỉnh sửa đánh giá
Route::post('editcomment', ['as' => 'postEditComment', 'uses' => 'CommentController@postEditComment']);
// Giỏ hàng
Route::group(['prefix' => 'shoppingcart'], function(){
    Route::get('cart/{id}', 'ShoppingCartController@addCart');
    Route::get('cartdetail', 'ShoppingCartController@cartDetail');
    Route::post('addcart', ['as' => 'addcart', 'uses' => 'ShoppingCartController@addCart']);
    Route::get('update/{id}/{name}', 'ShoppingCartController@updateCart');
    // Route::get('remove', 'ShoppingCartController@removeCart'); 
    Route::get('add', function() { //Thêm số lượng
        
    });
    Route::get('remove', function(){
        if(Request::ajax()){
            Cart::remove(Request::get('row'));
            return url('shoppingcart/cartdetail');
        }
    }); 

    Route::get('destroy', 'ShoppingCartController@destroyCart');

    Route::get('getRequest', function() {
        if(Request::ajax()){
            // $book = App\Book::where('book_id', Request::get('id'))->get()->first();
            // return $book->name;
            // $book = App\Book::where('book_id', $rs->$id)->get()->first();
            // Cart::add(Request::get('id'), $book->name, , $book->price)->tax(0);
            $book_id = Cart::get(Request::get('row'))->id;

            if(App\Book::where('book_id', $book_id)->get()->first()->quantity < Request::get('price')){
                return App\Book::where('book_id', $book_id)->get()->first()->quantity;
            }else{
                Cart::update(Request::get('row'), Request::get('price'));    
                return "success";
            }
        }
    });
    // Thanh toán
    Route::get('checkout', ['middleware' => "auth", 'uses' => 'ShoppingCartController@checkout']);
    Route::post('checkout', ['as' => "postCheckout", 'uses' => 'ShoppingCartController@postCheckout']);
});
// Chức năng tìm kiếm
Route::get('findbook', 'HomeController@getFind');
Route::post('findbook', ['as' => 'postFind', 'uses' => 'HomeController@postFind']);
/*-- Test route --*/
Route::get('test', function() {
	$order = App\Order::all()->first();
    // $date = Carbon\Carbon::createFromFormat('Y-m-d', "2016-09-23")->toDateTimeString();
    if ($order->created_at == "2016-09-23 19:49:20"){
        echo "S";
    }else{
        echo "F";
    }
    
});

// Trang thông tin người dùng
Route::get('users/{id}', ['middleware' => "auth", 'uses' => 'UserController@getUser']);
Route::post('userinfo', ['as' => 'postUserInfo', 'uses' => 'UserController@postUserInfo']);
Route::post('userpass', ['as' => 'postUserPass', 'uses' => 'UserController@postUserPass']);

Route::get('getRequest', function() {
    if(Request::ajax()){
        // return 'Success';
    }
});
// Route::auth();

Route::get('/session', function() {
    echo Auth::user()->username;
});


//Quay lại trang đăng nhập trước đó
//Route::get('back', ['middleware' => "auth", 'uses' => 'ShoppingCartController@checkout']);
Route::get('back', function() {
    
});

Route::get('test1', function() {
    echo "<pre>";
    var_dump(App\User::all());
    echo "</pre>";
});

Route::get('contact', 'HomeController@contact');
Route::post('contact', ['as' => 'postContact', 'uses' => 'HomeController@postContact']);

//Test PDF
Route::get('printOrder', function() {
    $data = ['name' => 'order'];
    $order = PDF::loadView('pdf.order', $data);
    return $order->stream(); 
});





Route::group(['middleware' => 'auth'], function() {
    Route::group(['prefix' => 'kiemtra'], function() {
        Route::get('/', function() {
            Session::put('default', 'hello');
            Session::put('default2', 'hello123');
            echo Session::get('default2')."<br>";
            echo Session::getId('default')."<br>";
            echo Session::getId('default2')."<br>";
            
        });
        Route::group(['prefix' => 'kt2'], function() {
            Route::get('aaa', function() {
                echo "string";
            });
        });
        Route::get('kt1', function() {
            echo "Day la kt1";
        });
    });
});

//Trang hiển thị lỗi
Route::get('404', function() {
    return view('pages.main.404');
});

Route::get('test_cart', function(){
    if(Session::has('test_cart')){
        Session::remove('test_cart');
        Session::put('test_cart', Cart::content());
    }else{
        Session::put('test_cart', Cart::content());
    }
    foreach (Session::get('test_cart') as $key => $value) {
        echo $key."<br/>";
    }
    // echo "<pre>";
    // var_dump(Session::get('cart'));
    // echo "</pre>";
});
Route::get('del_cart', function() {
    Session::flush();
});


Route::get('jtable', function() {
    return view('pages.main.jtable');
});

Route::get('postJtable', function() {
    // if(Request::ajax()){
        
    

    // $book = App\OrderDetail::where('book_id', Request::get('postData'))->get()->toArray();
    // $books = array();
    // foreach ($book as $key) {
    //     $books[] = $key;
    // }
    // $jTableResult = array();
    // $jTableResult['Result'] = "OK";
    // $jTableResult['TotalRecordCount'] = App\OrderDetail::where('book_id', Request::get('postData'))->count();
    // $jTableResult['Records'] = $books;
    // return json_encode($jTableResult);
    // }

    $book = App\Category::all()->toArray();
    $books = array();
    foreach ($book as $key) {
        $books[] = $key;
    }
    $jTableResult = array();
    $jTableResult['Result'] = "OK";
    $jTableResult['TotalRecordCount'] = App\Category::all()->count();
    $jTableResult['Records'] = $books;
    return json_encode($jTableResult);
});


Route::get('db', function() {
   $book = App\OrderDetail::all();
                $books = array();
                foreach ($book as $key) {
                    $books[] = $key;
                    var_dump($books);
                    echo "<br/>";
                    //echo $books->book_id;
                    echo "<br/>";
                } 
});

Route::get('caro', function() {
    return view('pages.main.caro');
});