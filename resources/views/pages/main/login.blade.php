@extends('pages.main.homelayout')
@section('title', 'Đăng nhập')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/custom.css') }}"/>
@endsection

@section('body')
	{{-- @if($errors->count() > 0)
		<script>
			bootbox.alert('Error');
		</script>
	@endif --}}
	<div class="container register">
		<div class="col-sm-offset-2 col-sm-8">
			<div class="title-form">Đăng nhập</div>
			<form class="form-horizontal" action="{{ route('postLogin') }}" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
				<input type="hidden" name="book_id" value=""/>
				<div class="form-group">
					<label class="control-label col-sm-3">Tên người dùng</label>
					<div class="col-sm-6"><input class="form-control" type="text" name="username" value="{{ old('username') }}"/>
					<div class=""></div>
					@if($errors->has('username'))
						<span class="glyphicon glyphicon-warning-sign"></span>{{ $errors->first('username')}}
					@endif
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3">Mật khẩu</label>
					<div class="col-sm-6"><input class="form-control" type="password" name="password" value=""/>
					@if($errors->has('password'))
						<span class="glyphicon glyphicon-warning-sign"></span>{{ $errors->first('password')}}
					@endif
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-6"><button class="btn btn-success" type="submit" name="login">Đăng Nhập</button></div>
				</div>
			</form>
		</div>
		<div class="col col-xs-12">
			<div class="col col-xs-12 col-sm-offset-4 col-sm-4">
				Chưa có tài khoản? <a href="{{ url('register') }}">Đăng ký</a>
			</div>
		</div>
	</div>
@endsection