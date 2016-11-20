@if(Auth::user()->username != $user->username)
	<script type="text/javascript">
		window.location = '{{ url('/') }}';
	</script>
@endif

@extends('pages.main.homelayout')
@section('title', 'Books Town')

@section('body')
	@if($errors->count() > 0)
		<script>
			bootbox.alert('Vui lòng điền đầy đủ và chính xác thông tin');
		</script>
	{{-- @else
		<script>
			bootbox.alert('Cập nhật thông tin thành công');
		</script> --}}
	@endif
	@if(session('success'))
		<script>
			bootbox.alert('Cập nhật thông tin thành công');
		</script>
	@endif
	<div class="container">
		<div class="well">
			<h3>Thông tin người dùng</h3>
			<div class="col col-sm-3">
				<img class="img-thumbnail" src="{{ asset('public/img/avatars') }}/{{ $user->avatar }}" height="50%" />
			</div>
			<div class="col col-sm-9">
				Họ và tên: {{ $user->fullname }}
				<br/>
				Địa chỉ: {{ $user->address }}
				<br/>
				Số điện thoại: {{ $user->phone }}
				<br/>
				Email: {{ $user->email }}
			</div>
			<br/>
			<br/>
			<button class="btn-block" data-toggle="collapse" data-target="#form"><span class="glyphicon glyphicon-edit symbol"></span></button>
			<br/>
			<div class="container">
			<div id="form" class="collapse">
				<form action="{{ route('postUserInfo') }}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					<input type="hidden" name="id" value="{{ Auth::user()->id }}" />
					<div class="form-group">
						<label style="color: #222;">Số điện thoại:</label>
						<input class="form-control" type="text" name="phone" value="{{ $user->phone }}" />
						@if($errors->has('phone'))
							<div class="error">{{ $errors->first('phone')}}</div>
						@endif
					</div>
					<div class="form-group">
						<label style="color: #222;">Địa chỉ</label>
						<input class="form-control" type="text" name="address" value="{{ $user->address }}" />
						@if($errors->has('address'))
							<div class="error">{{ $errors->first('address')}}</div>
						@endif
					</div>
					<button class="btn btn-success" type="submit" name="submit" value="info">Cập nhật thông tin</button>
				</form>
				<form action="{{ route('postUserPass') }}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					<input type="hidden" name="id" value="{{ Auth::user()->id }}" />
					<div class="form-group">
						<label style="color: #222;">Mật khầu</label>
						<input class="form-control" type="password" name="password" />
						@if($errors->has('password'))
							<div class="error">{{ $errors->first('password')}}</div>
						@endif
					</div>
					<div class="form-group">
						<label style="color: #222;">Nhập lại mật khẩu</label>
						<input class="form-control" type="password" name="repassword" />
						@if($errors->has('repassword'))
							<div class="error">{{ $errors->first('repassword')}}</div>
						@endif
					</div>
					<button class="btn btn-success" type="submit" name="submit" value="changepwd">Thay đổi mật khẩu</button>
				</form>
			</div>
			</div>
		</div>
	</div>
@endsection