@extends('pages.admin.layout')
@section('title', 'Thêm sách')
@section('header', 'Thêm sách')

@section('content')
	{{-- Thông báo khi thêm sách thành công --}}
	@if(session('result'))
		<div class="alert alert-success">
			<ul>
				<li>{{ session('result') }}</li>
			</ul>
		</div>
	@endif
	<div class="col-sm-offset-1 col-sm-10">
		{{-- @if(count($errors)>0)

			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif --}}
		<form class="form-horizontal" action="{{ route('postBook') }}" method="post" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
			<div class="form-group">
				<label class="control-label col-sm-2">Mã sách</label>
				<div class="col-sm-6"><input class="form-control" type="text" name="book_id" value="{{ old('book_id') }}"/></div>
				<div class="col-sm-4 error">
					@if($errors->has('book_id'))
						<span class="glyphicon glyphicon-warning-sign"></span>{{ $errors->first('book_id')}}
					@endif
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Tên sách</label>
				<div class="col-sm-6"><input class="form-control" type="text" name="name" value="{{ old('name') }}"/></div>
				<div class="col-sm-4 error">
					@if($errors->has('name'))
						<span class="glyphicon glyphicon-warning-sign"></span>{{ $errors->first('name')}}
					@endif
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Tác giả</label>
				<div class="col-sm-6"><input class="form-control" type="text" name="author" value="{{ old('author') }}"/></div>
				<div class="col-sm-4 error">
					@if($errors->has('author'))
						<span class="glyphicon glyphicon-warning-sign"></span>{{ $errors->first('author')}}
					@endif
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Nhà xuất bản</label>
				<div class="col-sm-6"><input class="form-control" type="text" name="publisher" value="{{ old('publisher') }}"/></div>
				<div class="col-sm-4 error">
					@if($errors->has('publisher'))
						<span class="glyphicon glyphicon-warning-sign"></span>{{ $errors->first('publisher')}}
					@endif
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Thể loại</label>
				<div class="col-sm-4"><select class="form-control" name="cat_id">
					@foreach($cat as $a)
						<option value="{{ $a['cat_id'] }}">{{ $a['name'] }}</option>
					@endforeach
				</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Ảnh</label>
				<div class="col-sm-6"><input type="file" name="image"/></div>
				<div class="col-sm-4 error">
					@if($errors->has('image'))
						<span class="glyphicon glyphicon-warning-sign"></span>{{ $errors->first('image')}}
					@endif
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Số trang</label>
				<div class="col-sm-6"><input class="form-control" type="text" name="pages" value="{{ old('pages') }}"/></div>
				<div class="col-sm-4 error">
					@if($errors->has('pages'))
						<span class="glyphicon glyphicon-warning-sign"></span>{{ $errors->first('pages')}}
					@endif
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Mô tả</label>
				<div class="col-sm-6"><textarea class="form-control" rows="10" name="description"></textarea></div>
				<div class="col-sm-4 error">
					@if($errors->has('description'))
						<span class="glyphicon glyphicon-warning-sign"></span>{{ $errors->first('description')}}
					@endif
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Giá</label>
				<div class="col-sm-6"><input class="form-control" type="text" name="price" value="{{ old('price') }}"/></div>
				<div class="col-sm-4 error">
					@if($errors->has('price'))
						<span class="glyphicon glyphicon-warning-sign"></span>{{ $errors->first('price')}}
					@endif
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Số lượng</label>
				<div class="col-sm-6"><input class="form-control" type="text" name="quantity" value="{{ old('quantity') }}"/></div>
				<div class="col-sm-4 error">
					@if($errors->has('price'))
						<span class="glyphicon glyphicon-warning-sign"></span>{{ $errors->first('price')}}
					@endif
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-9"><button class="btn btn-success" type="submit" name="addbook">Thêm sách</button></div>
			</div>
		</form>
	</div>
@stop