<!DOCTYPE html>
	<html>
	<head>
		<title>
			@yield('title')
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		{{-- icon --}}
		<link rel="icon" type="image/gif" href="{{ asset('public/icon.gif') }}"/>
		<link rel="stylesheet" type="text/css" href="{{ asset('public/css/bootstrap.min.css') }}"/>
		<link rel="stylesheet" type="text/css" href="{{ asset('public/jRating/css/star-rating-svg.css') }}"/>
		<script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('public/js/bootstrap.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('public/jRating/jquery.star-rating-svg.js') }}"></script>
		{{-- <link rel="stylesheet" type="text/css" href="{{ asset('public/css/main.css') }}"/> --}}
		@yield('css')
		<link rel="stylesheet" type="text/css" href="{{ url('public/css/homestyle.css') }}"/>
		<script type="text/javascript" src="{{ asset('public/js/bootbox.min.js') }}"></script>
		{{-- jcarousel --}}
		<script type="text/javascript" src="{{ asset('public/jcarousel/dist/jquery.jcarousel.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('public/jcarousel.responsive.js') }}"></script>
		<link rel="stylesheet" type="text/css" href="{{ asset('public/jcarousel.responsive.css') }}" />
		<link rel="stylesheet" type="{{ asset('public/jcarousel/examples/_shared/css/style.css') }}" />
		{{-- //// --}}

		<script type="text/javascript" src="{{ asset('public/jRating2/jquery/jRating.jquery.js') }}"></script>
		<link rel="stylesheet" type="text/css" href="{{ asset('public/jRating2/jquery/jRating.jquery.css') }}" />

		{{-- animsition --}}
		<script type="text/javascript" src="{{ asset('public/animsition/dist/js/animsition.min.js') }}"></script>
		<link rel="stylesheet" type="text/css" href="{{ asset('public/animsition/dist/css/animsition.min.css') }}"/>
		{{-- jquery.particleground.js --}}
		<script type="text/javascript" src="{{ asset('public/js/jquery.particleground.js') }}"></script>

	</head>
	<body>
		
		<div class="animsition" style="height: 100%; width: 100%;">
			
		
		{{-- Làm mờ nền --}}
		<div class="blur"></div>
		<div id="cover">
			{{-- Phần header --}}
			<div id="header">
				<img class="" src="{{ url('public/logo2.png') }}" height="90%" />
			</div>
			
			<nav class="navbar navbar-inverse">
			  	<div class="container-fluid">
			  	  	<div class="navbar-header">
			  	    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				  	   	  	<span class="icon-bar"></span>
				  	   	  	<span class="icon-bar"></span>
				  	   		<span class="icon-bar"></span>
				  	   	</button>
					</div>
		  	  		<div class="collapse navbar-collapse" id="myNavbar">
		  	   			<ul class="nav navbar-nav">
		      				<li><a href="{{ url('/') }}"><span class="glyphicon glyphicon-home"></span><b>  Trang chủ</b></a></li>
		     				<li class="dropdown">
		          				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list"></span><b>  Thể loại</b><span class="caret"></span></a>
		          			<ul class="dropdown-menu">
			           			@foreach($catlist as $cat)
			           				<li><a href="{{ url("cat/$cat->cat_id") }}">{{ $cat->name }}</a></li>
			           				<li role="separator" class="divider"></li>
								@endforeach
			      			</ul>
			       		</li>
		  	      {{-- <li><a href="#">Page 2</a></li>
		  	      <li><a href="#">Page 3</a></li> --}}
		  	   			</ul>

		  	   			<div class="col-lg-3">	
		       					<!--<form class="navbar-form" action="{{ url('findbook') }}"  method="get">
        							<div class="input-group">
        								<span class = "input-group-btn">
        									<div class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span></div>
        								</span>
 								        <input type="text" name="keyword" class="form-control" {{-- placeholder="Tìm kiếm" --}}/>
 								        <span class="input-group-btn">
	        								<select class="form-control" name="cat">
	        									<option value="name">Tên sách</option>
	        									<option value="author">Tác giả</option>
	        									{{-- <option value="publisher">Nhà xuất bản</option> --}}
	        								</select>
        								</span>
        								<span class = "input-group-btn">
        									<button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
        								</span>
        							</div>
      							</form> -->
      							</div>	
		       			<ul class="nav navbar-nav navbar-right">
		       				@if(!Auth::check())
								<li><a href="{{ url('register') }}"><span class="glyphicon glyphicon-user"></span> Đăng ký</a></li>
							@else
								<li><a href="{{ url("users/".Auth::user()->username) }}">{{-- <img class="thumbnail" src="{{ asset('public/img/avatars') }}/{{ Auth::user()->avatar }}" height="20" /> --}}<span class="glyphicon glyphicon-user"></span> <b>{{ Auth::user()->username }}</b></a></li>
								@if(Auth::user()->level == 1)
									<li><a href="{{ url('dashboard') }}"><span class="glyphicon glyphicon-list"></span> Dashboard</a></li>
								@endif
							@endif
				        	@if(!Auth::check())
				        		<li><a href="{{ url('login') }}"><span class="glyphicon glyphicon-log-in"></span> Đăng nhập</a></li>
				        	@else
				        		<li><a href="{{ url('logout') }}"><span class="glyphicon glyphicon-log-out"></span> Đăng xuất</a></li>
				        	@endif
				        	<li><a href="{{ url('shoppingcart/cartdetail') }}"><span class="glyphicon glyphicon-shopping-cart"></span>  Giỏ hàng ({{ Cart::count() }})</a></li>
				        	<li><a href="{{ url('contact') }}"><span class="glyphicon glyphicon-comment"></span>  Góp ý</a></li>
		       			</ul>
		   			</div>
				</div>
			</nav>
			{{-- </div> --}}
			{{-- Phần body --}}
			<div id="body">
				@yield('body')
				
			</div>
			{{-- Phần footer --}}
			<div id="footer">
				<div class="container">
					<div class="col col-xs-12 col-sm-4">
						<h3>About Me</h3>
						&copy; Copyright 2016, pmtien
					</div>
					<div class="col col-xs-12 col-sm-8">
						<h3>Contact</h3>
						Hotline: 0962446402
						<br/>
						Email: phantien295@gmail.com
					</div>
				</div>
			</div>
		</div>
		<div class="find">
			<br/>
			{{-- <br/> --}}
			<br/>
			<div class="container">
				<form class="form-horizontal col-sm-4 col-sm-offset-4" action="{{ url('findbook') }}"  method="get">
       				<div class="col-xs-12 form-group">
       					{{-- <label>Từ khóa</label> --}}
        				<input class="form-control" type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm" />
        			</div>
 			        <div class="col-xs-12 form-group">
	        			<select class="form-control" name="cat">
							<option value="name">Tên sách</option>
  							<option value="author">Tác giả</option>
	       					<option value="publisher">Nhà xuất bản</option>
	       				</select>
   					</div>
					<div class="col-xs-12 form-group">
        				<button type="submit" class="btn btn-info btn-block"><span class="glyphicon glyphicon-search"></span></button>		
       				</div>
      			</form>
      		</div>
		</div>
		<div class="btn-find down">
			<span style="color: white;"><b>Tìm Kiếm</b></span>
			<img src="{{ asset('public/conan.png') }}" width="70px" />
			{{-- <button id="find" class="down">Click me!!!</button> --}}
		</div>
		<script type="text/javascript">
			$('.find').css('height', '0px');
			$('.btn-find').css('bottom', '0px');

			$(document).ready(function(){
				var count = 1;

				
				$('.down').click(function(){
					if(count == 0){
						$('.find').animate({
							opacity: '0.5',
							height: '0px'
						}, "slow");
						$('.btn-find').animate({
							bottom: '0px',
							// width: '170px',
						}, "slow");
						count = 1;
					}else{
						$('.find').animate({
							opacity: '1',
							height: '235px',
							width: '100%'
						}, "slow");
						$('.btn-find').animate({
							bottom: '200px',
							// width: '20%',
						}, "slow");
						count = 0;
					}
				});
				// $('.btn-find').hover(function(){
				// 	$('.btn-find').animate({
				// 			left: '0px'
				// 			// width: '200px',
				// 		}, "slow");
				// });
			});
		</script>

		<script type="text/javascript">
			// $(document).ready(function(){
				$(".animsition").animsition({
					inClass: 'fade-in-up',
					outClass: 'fade-out-up',
					inDuration: 1500,
					outDuration: 800,
					// linkElement: '.animsition-link',
					linkElement: 'a:not([target="_blank"]):not([href^="#"])',

					loading: false,
					loadingParentElement: 'body',
					loadingClass: 'animsition-loading',
					loadingInner: '',
					timeout: false,
					timeoutCountdown: 5000,
					onLoadEvent: true,
					browser: ['animation-duration', '-webkit-animation-duration'],

					overlay: false,
					overlayClass: 'animation-overlay-slide',
					overlayParentElement: 'body',
					transition: function(url){
						window.location.href = url;
					}
				// });
			});
		</script>
		@yield('script')



		</div>
	</body>
</html>