@extends('pages.main.homelayout')
@section('title', 'Đặt hàng')

@section('body')
	@if($errors->count() > 0)
		<script>
			bootbox.alert('Vui lòng điền đầy đủ thông tin!');
		</script>
	@endif
	<div class="container cartdetail">
		<form action="{{ route('postCheckout') }}" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}" />
		<h3>Địa chỉ giao hàng</h3>
		Tên: {{ $customer->fullname }}
		<br/>
		Địa chỉ:
		<br/>
		<input class="form-group" type="text" value="{{ $customer->address }}" name="address" />
		<br/>
		Số điện thoại:
		<br/>
		<input class="form-group" type="text" value="{{ $customer->phone }}" name="phone" />
		<br/>
		<i>Khách hàng có thể thay đổi địa chỉ và số điện thoại nhận hàng</i>
		<h3>Hình thức thanh toán</h3>
		Thanh toán trực tiếp cho người giao hàng
		<h3>Hình thức vận chuyển</h3>
		Vận chuyển tận nhà
		<br/>
		<br/>
		<button class="btn btn-success" type="submit">Tiến hành đặt hàng</button>
		</form>
	</div>
@endsection