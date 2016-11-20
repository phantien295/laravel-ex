@extends('pages.admin.layout')
@section('title', 'Dashboard')
@section('header', 'Thống kê trang')

@section('content')
	{{-- <div class=" col-xs-10 col-sm-3"> --}}
		{{-- <div class="alert alert-info">ad</div> --}}
		<div class="container">
			{{-- {!! Breadcrumbs::render('dashboard') !!} --}}
			<div class="well">
				Tổng số sách: 
				<?php
						echo App\Book::all()->count();
					?>
			</div>
			<div class="well">
				Tổng số người dùng:
				<?php
						echo App\User::where('level', 2)->count();
					?>
			</div>
			<div class="well">
				Tổng số hóa đơn:
				<?php
						echo App\Order::all()->count();
					?>
			</div>
		</div>
@endsection

		