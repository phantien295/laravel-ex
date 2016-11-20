@extends('pages.main.homelayout')
@section('title', 'Phản hồi - Đóng góp ý kiến')

@section('body')
	<div class="container ">
		<div class="well">
			<h3>Góp ý</h3>
			<form action="{{ route('postContact') }}" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				<div class="form-group">
					<label style="color: #222;">Email</label>
					<input type="text" name="email" class="form-control" />	
					@if($errors->has('email'))
						<div class="error">{{ $errors->first('email')}}</div>
					@endif
				</div>
				<div class="form-group">
					<label style="color: #222;">Nội dung</label>
					<textarea class="form-control" rows="5" name="message"></textarea>	
					@if($errors->has('message'))
						<div class="error">{{ $errors->first('message')}}</div>
					@endif
				</div>
				<button class="btn btn-info btn-block" type="submit">Gửi</button>
			</form>
		</div>
	</div>
@endsection