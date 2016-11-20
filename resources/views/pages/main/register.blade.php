@extends('pages.main.homelayout')
@section('title', 'Đăng ký')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/custom.css') }}"/>
@endsection

@section('body')
	<div class="container register">
		{{-- @if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif --}}
		<div class="col-sm-offset-2 col-sm-8">
			<div class="title-form">Đăng ký</div>
			@if(session('result'))
				<div class="alert alert-success">
					<ul>
						<li>{{ session('result') }}</li>
					</ul>
				</div>
			@endif
			<form class="form-horizontal" action="{{ route('postRegister') }}" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-6" style="text-align: center;">
						<img  id="current" src="{{ asset('public/img/avatars/boy-3.png') }}" height="64px" />
					</div>
				</div>
				{{-- avatar --}}
				<input type="hidden" name="avatar" id="avatar" value="boy-3.png" />
				<input type="hidden" name="book_id" value=""/>
				<div class="form-group">
					<label class="control-label col-sm-3">Tên người dùng</label>
					<div class="col-sm-6"><input class="form-control" type="text" name="username" value="{{ old('username') }}"/>
					<div class=""></div>
					@if($errors->has('username'))
						<div class="error">{{ $errors->first('username')}}</div>
					@endif
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3">Chọn avatar</label>
					<div class="col-sm-offset-3">
						<span><img src="{{ asset('public/img/avatars/boy-3.png') }}" height="64px" name="boy-3.png" /></span>
						<span><img src="{{ asset('public/img/avatars/man-1.png') }}" height="64px" name="man-1.png" /></span>
						<span><img src="{{ asset('public/img/avatars/girl-1.png') }}" height="64px" name="girl-1.png" /></span>
						<span><img src="{{ asset('public/img/avatars/girl-2.png') }}" height="64px" name="girl-2.png" /></span>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3">Email</label>
					<div class="col-sm-6"><input class="form-control" type="text" name="email" value="{{ old('email') }}"/>
					@if($errors->has('email'))
						<div class="error">{{ $errors->first('email')}}</div>
					@endif
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3">Mật khẩu</label>
					<div class="col-sm-6"><input class="form-control" type="password" name="password" value=""/>
					@if($errors->has('password'))
						<div class="error">{{ $errors->first('password')}}</div>
					@endif
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3">Xác nhận mật khẩu</label>
					<div class="col-sm-6"><input class="form-control" type="password" name="repassword" value=""/>
					@if($errors->has('repassword'))
						<div class="error">{{ $errors->first('repassword')}}</div>
					@endif
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3">Họ tên</label>
					<div class="col-sm-6"><input class="form-control" type="text" name="fullname" value="{{ old('fullname') }}"/>
					@if($errors->has('fullname'))
						<div class="error">{{ $errors->first('fullname')}}</div>
					@endif
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3">Giới tính</label>
					<div class="col-sm-6">
						<select name="gender">
							<option value="nam">Nam</option>
							<option value="nữ">Nữ</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3">Địa chỉ</label>
					<div class="col-sm-6"><input class="form-control" type="text" name="address" value="{{ old('address') }}"/>
					@if($errors->has('address'))
						<div class="error">{{ $errors->first('address')}}</div>
					@endif
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3">Số điện thoại</label>
					<div class="col-sm-6"><input class="form-control" type="text" name="phone" value="{{ old('phone') }}"/>
					@if($errors->has('phone'))
						<div class="error">{{ $errors->first('phone')}}</div>
					@endif
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-6"><button class="btn btn-success" type="submit" name="register">Đăng ký</button></div>
				</div>
			</form>
		</div>
	</div>
	
	{{-- <script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script> --}}
	<script type="text/javascript">
		$(document).ready(function(){
			// Chức năng chọn avatar
			$('img').click(function(){
				$('#current').attr('src', $(this).attr('src'));
				$('#avatar').val($(this).attr('name'));
			});
		});
	</script>
@endsection