@extends('pages.admin.layout')
@section('title', 'Chỉnh sửa sách')
@section('header', 'Chỉnh sửa sách')

@section('content')
	@if(session('result'))
		<div class="alert alert-success">
			<ul>
				<li>{{ session('result') }}</li>
			</ul>
		</div>
	@endif
	<div class="col-sm-offset-2 col-sm-9">
		<form class="form-horizontal" action="{{ route('postEditBook') }}" method="post" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
			<div class="col-sm-9"><input type="hidden" name="book_id" value="{{ $book['book_id'] }}"/>
			<div class="form-group">
				<label class="control-label col-sm-3">Tên sách</label>
				<div class="col-sm-9"><input class="form-control" type="text" name="name" value="{{ $book['name'] }}"/></div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Tác giả</label>
				<div class="col-sm-9"><input class="form-control" type="text" name="author" value="{{ $book['author'] }}"/></div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Nhà xuất bản</label>
				<div class="col-sm-9"><input class="form-control" type="text" name="publisher" value="{{ $book['publisher'] }}"/></div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Thể loại</label>
				<div class="col-sm-4"><select class="form-control" name="cat_id">
					@foreach($cat as $a)
						@if($a['cat_id'] == $book['cat_id'])
							<option value="{{ $a['cat_id'] }}" selected="true">{{ $a['name'] }}</option>
						@else
							<option value="{{ $a['cat_id'] }}">{{ $a['name'] }}</option>
						@endif
					@endforeach
				</select>
				</div>
			</div>
			<div class="form-group"><img class="col col-xs-offset-4" src="{{ asset('public/uploads/images') }}/{{ $book['image'] }}" width="25%" height="25%" /></div>
			{{-- Hình ảnh hiện tại --}}
			<input type="hidden" name="current_image" value="{{ $book['image'] }}"/>
			{{-- Hình ảnh mới --}}
			<div class="form-group">
				<label class="control-label col-sm-3">Ảnh mới</label>
				<div class="col-sm-9"><input type="file" name="new_image"/></div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Số trang</label>
				<div class="col-sm-9"><input class="form-control" type="text" name="pages" value="{{ $book['pages'] }}"/></div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Mô tả</label>
				<div class="col-sm-9"><textarea rows="10" class="form-control" name="description">{{ $book['description'] }}</textarea></div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Giá</label>
				<div class="col-sm-9"><input class="form-control" type="text" name="price" value="{{ $book['price'] }}"/></div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Số lượng</label>
				<div class="col-sm-9"><input class="form-control" type="text" name="quantity" value="{{ $book['quantity'] }}"/></div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9"><button class="btn btn-success" type="submit" name="editbook">Cập nhật</button></div>
			</div>
		</form>
	</div>
@endsection