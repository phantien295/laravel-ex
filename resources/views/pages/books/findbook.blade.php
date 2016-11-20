@extends('pages.admin.layout')
@section('title', 'Tìm kiếm')
@section('header', 'Tìm kiếm')

@section('content')
	{{-- @if(Session::has('result'))
		<div class="alert alert-danger">
			<ul>
				<li>{{ session::get('result') }}</li>
			</ul>
		</div>
	@endif --}}
	{{-- @if(session('list')) --}}
		<div class="container">
			<form action="{{ url('admin/getfindbook') }}" method="get">
				{{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
				<select name="cat">
					<option value="book_id">Mã sách</option>
					<option value="name">Tên sách</option>
					<option value="author">Tác giả</option>
					<option value="publisher">Nhà xuất bản</option>
				</select>
				<input type="text" name="find"/>
				<button class="btn btn-success btn-sm" type="submit" value="findbook">Tìm kiếm</button>
			</form>
		</div>
		<br/>
		@if($result->count() == 0)
		<div class="alert alert-info">Không tìm thấy kết quả</div>
		@else
		<div class="table-responsive">
			<table class="table">
				<tr class="success">
					<th>Mã sách</th>
					<th>Tên sách</th>
					<th>Tác giả</th>
					<th>Nhà xuất bản</th>
					<th>Giá</th>
					<th>Thao tác</th>
				</tr>
				
					@foreach($result as $book)
					<tr>
						<td>{{ $book['book_id'] }}</td>
						<td>{{ $book['name'] }}</td>
						<td>{{ $book['author'] }}</td>
						<td>{{ $book['publisher'] }}</td>
						<td>{{ $book['price'] }}đ</td>
						<td><a class="btn btn-default btn-xs" href="{{ url("admin/editbook") }}/{{ $book['book_id'] }}"><span class="glyphicon glyphicon-edit"></span> Edit</a>
						@if($book->status)
							<a class="btn btn-default btn-xs" href="{{ url("admin/hide/$book->book_id") }}"><span class="glyphicon glyphicon-ok-sign"></span></a>
						@else
							<a class="btn btn-default btn-xs" href="{{ url("admin/unhide/$book->book_id") }}"><span class="glyphicon glyphicon-remove-sign"></span></a>
						@endif
						</td>
					</tr>
					@endforeach
				
			</table>
		</div>
		@endif
	{{-- @else --}}
		{{-- <div class="alert alert-danger">
			<ul>
				<li>Không tìm thấy kết quả</li>
			</ul>
		</div> --}}
	{{-- @endif --}}
@endsection