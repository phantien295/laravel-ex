@extends('pages.admin.layout')
@section('title', 'Sách giảm giá')
@section('header', 'Sách giảm giá')

@section('content')
	<div class="container">
		<form action="{{ route('addSaleoff') }}" method="post" class="form">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<div class="col col-sm-4 col-sm-offset-4 form-group">
				<div><label>Nhập mã sách</label></div>
				<input class="form-control" type="text" name="book_id" />
				@if($errors->has('book_id'))
					<div class="error">
						{{ $errors->first('book_id') }}
					</div>
				@endif
				{{-- <select class="form-control" name="id">
					@foreach($books as $book)
						<option value="{{ $book->book_id }}">{{ $book->name }}</option>
					@endforeach
				</select> --}}
			</div>
			<div class="col col-sm-12"></div>
			<div class="col col-sm-4 col-sm-offset-4 form-group">
				<div><label>Phần trăm giảm giá</label></div>
				<input class="form-control" type="text" name="percent"/>	
			</div>
			<div class="col col-sm-4 col-sm-offset-4">
				<button class="btn btn-success btn-block" type="submit">Thêm</button>
			</div>
		</form>
	</div>
	<br/>
	<table class="table">
		<tr class="success">
			<th>Mã sách</th>
			<th>Tên sách</th>
			<th>Giảm giá</th>
			<th></th>
		</tr>
		@foreach($promotion as $book)
			</tr>
				<td>{{$book->book_id}}</td>
				<td>
					<?php
						$bk = App\Book::where('book_id', $book->book_id)->get()->first();
						echo $bk->name;
					?>
				</td>
				<td>{{ $book->percent }}%</td>
				<td>
					<a class="btn btn-default btn-xs" href="{{ url("admin/delsaleoff/$book->book_id") }}">
						<span class="glyphicon glyphicon-trash"></span> Xóa
					</a>
				</td>
			<tr>
		@endforeach
	</table>
	<div>{{ $promotion->links() }}</div>
@endsection