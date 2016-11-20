<!DOCTYPE html>
<html>
	<head>
		<title>@yield('title')</title>
	
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		{{-- icon --}}
		<link rel="icon" type="image/gif" href="{{ asset('public/icon.gif') }}"/>

		<link rel="stylesheet" type="text/css" href="{{ asset('public/css/bootstrap.min.css') }}"/>
		<script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('public/js/bootstrap.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('public/js/jquery-ui/jquery-ui.js') }}"></script>
		<script type="text/javascript" src="{{ asset('public/js/jquery-ui/jquery-ui.min.js') }}"></script>

		{{-- jtable --}}
		
		{{-- <link href="{{ asset('public/jtable/themes/redmond/jquery-ui-1.8.16.custom.css') }}" rel="stylesheet" type="text/css" /> --}}
	{{-- <link href="{{ asset('public/jtable/scripts/jtable/themes/lightcolor/blue/jtable.css') }}" rel="stylesheet" type="text/css" /> --}}
	
	{{-- <script src="{{ asset('public/jtable/scripts/jquery-1.6.4.min.js') }}" type="text/javascript"></script> --}}
    {{-- <script src="{{ asset('public/jtable/scripts/jquery-ui-1.8.16.custom.min.js') }}" type="text/javascript"></script> --}}
    {{-- <script src="{{ asset('public/jtable/scripts/jtable/jquery.jtable.js') }}" type="text/javascript"></script> --}}
		{{-- <script type="text/javascript" src="{{ asset('public/js/jquery.jtable.js') }}"></script> --}}
		<script type="text/javascript" src="{{ asset('public/js/jquery.jtable.min.js') }}"></script>
		<link href="{{ asset('public/js/themes/lightcolor/green/jtable.css') }}" rel="stylesheet" type="text/css" />
		{{-- <link href="{{ asset('public/js/themes/lightcolor/blue/jtable.css') }}" rel="stylesheet" type="text/css" /> --}}
		{{-- //// --}}
		<link rel="stylesheet" type="text/css" href="{{ asset('public/js/jquery-ui/jquery-ui.css') }}"/>
		<link rel="stylesheet" type="text/css" href="{{ asset('public/js/jquery-ui/jquery-ui.theme.css') }}"/>
		<link rel="stylesheet" type="text/css" href="{{ asset('public/js/jquery-ui/jquery-ui.min.css') }}"/>
		<link rel="stylesheet" type="text/css" href="{{ asset('public/css/admin.css') }}"/>

		{{-- jcarousel --}}
		<script type="text/javascript" src="{{ asset('public/jcarousel/dist/jquery.jcarousel.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('public/jcarousel.responsive.js') }}"></script>
		<link rel="stylesheet" type="text/css" href="{{ asset('public/jcarousel.responsive.css') }}" />
		<link rel="stylesheet" type="{{ asset('public/jcarousel/examples/_shared/css/style.css') }}" />
		{{-- //// --}}
	</head>
	<body>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
		    	<div class="navbar-header">
					<button type ="button" class ="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
         				<span class = "sr-only">Toggle navigation</span>
         				<span class = "icon-bar"></span>
         				<span class = "icon-bar"></span>
         				<span class = "icon-bar"></span>
      				</button>
					<a class="navbar-brand" href="{{ url('/') }}"><span class="glyphicon glyphicon-home"></span><b>Trang chủ</b></a>
				</div>
		    	<div class="container-fluid">
					<div class="collapse navbar-collapse" id="app-navbar-collapse">
						<ul class="nav navbar-nav">
	      					<li class="cellnavbar"><a href="{{ url('dashboard') }}"><span class="glyphicon glyphicon-stats"></span>  Thống kê</a></li>
	      					<li class="cellnavbar"><a href="{{ url('logout') }}"><span class="glyphicon glyphicon-log-out"></span>  Đăng xuất</a></li>
	      					<li class="cellnavbar"><a href="#"></a></li>
	    				</ul>
	    			</div>
				</div>
		  	</div>
		</nav>
		{{-- Menu trái --}}
		<div class="body">
			<div class="leftmenu">
				<ul>
					<li id="dashboard">Dashboard</li>
					{{-- Quản lý sách --}}
					<li>
						<div class="menu" data-toggle="collapse" data-target="#menu1"><span class="glyphicon glyphicon-book"></span>Quản lý sách</div>
					</li>
					<div id="menu1" class="collapse">
						<li><a href="{{ url('admin/listbook') }}"><span class="glyphicon glyphicon-plus-sign"></span>Xem danh sách</a></li>
						<li><a href="{{ url('admin/addbook') }}"><span class="glyphicon glyphicon-plus-sign"></span>Thêm sách</a></li>
						<li><a href="{{ url('admin/saleoff') }}"><span class="glyphicon glyphicon-plus-sign"></span>Sách giảm giá</a></li>
  					</div>
					{{-- Quản lý thể loại --}}
					<li>
						<div class="menu" data-toggle="collapse" data-target="#menu2"><span class="glyphicon glyphicon-list"></span>Quản lý thể loại sách</div>
					</li>
					<div id="menu2" class="collapse">
						<li><a href="{{ url('admin/addcat') }}"><span class="glyphicon glyphicon-plus-sign"></span>Thêm thể loại</a></li>
						<li><a href="{{ url('admin/listcat') }}"><span class="glyphicon glyphicon-plus-sign"></span>Danh sách thể loại</a></li>
  					</div>
					{{-- Quản lý người dùng --}}
					<li>
						<div class="menu" data-toggle="collapse" data-target="#menu3"><span class="glyphicon glyphicon-user"></span>Quản lý người dùng</div>
					</li>
					<div id="menu3" class="collapse">
						<li><a href="{{ url('admin/user') }}"><span class="glyphicon glyphicon-plus-sign"></span>Danh sách người dùng</a></li>
						{{-- <li><a href="#">Hhah</a></li> --}}
  					</div>
  					<li>
						<div class="menu" data-toggle="collapse" data-target="#menu4"><span class="glyphicon glyphicon-list-alt"></span>Quản lý hóa đơn</div>
					</li>
					<div id="menu4" class="collapse">
						<li><a href="{{ url('admin/order') }}"><span class="glyphicon glyphicon-plus-sign"></span>Danh sách hóa đơn</a></li>
  					</div>
					<li></li>
				</ul>
			</div>
		
			{{-- Phần nội dung --}}
			<div id="content">
				<div class="container">
					<div class="header">@yield('header')</div>
					@yield('content')
				</div>
			</div>
		</div>
	</body>
</html>