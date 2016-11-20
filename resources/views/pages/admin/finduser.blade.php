@extends('pages.admin.layout')
@section('title', 'Tìm kiếm người dùng')
@section('header', 'Tìm kiếm người dùng')

@section('content')
	<div class="container">
		<form action="{{ url('admin/finduser') }}" method="get">
			<div class="row">
				<div class="col col-xs-4"><input class="form-control" type="text" name="keyword" placeholder="Nhập username" /></div>
				<button class="btn btn-success">Tìm kiếm</button>
			</div>
		</form>
	</div>
	<br/>
	@if($users->count() == 0)
		<div class="alert alert-info">Không tìm thấy kết quả</div>
	@else
	<div class="container table-responsive">
		<table class="table">
			<tr class="success">
				<th>Username</th>
				<th>Họ tên</th>
				<th>Giới tính</th>
				<th>Địa chỉ</th>
				<th>Email</th>
				<th>Số điện thoại</th>
				<th>Tình trạng</th>
				<th></th>
			</tr>
			@foreach($users as $user)
			<tr>
				<td><a href="{{ url("admin/userorder/$user->username") }}">{{ $user->username }}</a></td>
				<td>{{ $user->fullname }}</td>
				<td>{{ $user->gender }}</td>
				<td>{{ $user->address }}</td>
				<td>{{ $user->email }}</td>
				<td>{{ $user->phone }}</td>
				<td>
					@if($user->status)
						<span class="glyphicon glyphicon-time"></span> Hoạt động
					@else
						<span class="glyphicon glyphicon-lock"></span> Khóa
					@endif
				</td>
				<td>
					@if($user->status)
					<a href="{{ url("admin/lock/$user->id") }}"><span class="glyphicon glyphicon-ban-circle"></span></a></td>
					@else
					<a href="{{ url("admin/unlock/$user->id") }}"><span class="glyphicon glyphicon-ok-circle"></span></a></td>
					@endif
			</tr>
			@endforeach
		</table>
	</div>
	@endif
@endsection