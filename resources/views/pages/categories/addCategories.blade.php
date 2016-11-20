@extends('pages.admin.layout')
@section('title', 'Thêm thể loại sách')
@section('header', 'Thêm thể loại')

@section('content')	
			{{-- @if(count($errors)>0)

			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif --}}

			@if(session('result'))

			<div class="alert alert-success">
				<ul>
					<li>{{ session('result') }}</li>
				</ul>
			</div>
			@endif
		
		<div class="col-sm-offset-1 col-sm-10">
			<form class="form-horizontal" action="{{ route('postCat') }}" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
				<div class="form-group">
					<label class="control-label col-sm-3">Mã thể loại</label>
					<div class="col-sm-3"><input type="text" name="cat_id" value="{{ old('cat_id') }}" placeholder="Nhập mã thể loại" />	
					</div>
					<div class="col-sm-6 error">
						@if($errors->has('cat_id'))
							<span class="glyphicon glyphicon-warning-sign"></span>{{ $errors->first('cat_id')}}
						@endif
					</div>
				</div>
				
				

				<div class="form-group">
					<label class="control-label col-sm-3">Tên thể loại</label>
					<div class="col-sm-3"><input type="text" name="name" value="{{ old('name') }}" placeholder="Nhập tên thể loại" /></div>
					<div class="col-sm-6 error">
						@if($errors->has('name'))
							<span class="glyphicon glyphicon-warning-sign"></span>{{ $errors->first('name') }}
						@endif
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-9"><button class="btn btn-success" type="submit" name="addcat">Thêm thể loại</button></div>
				</div>
			</form>
		</div>
	
@stop