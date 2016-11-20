@extends('pages.admin.layout')
@section('title', 'Chi tiết hóa đơn')
@section('header', 'Chi tiết hóa đơn')

@section('content')
	{!! Breadcrumbs::render('orderdetail') !!}
	<div class="table-responsive">
		<table class="table table-bordered">
			<tr class="success">
				<th>Số hóa đơn</th>
				<th>Tên sách</th>
				<th>Số lượng</th>
				<th>Giảm giá</th>
				<th>Tổng</th>
			</tr>
				@foreach($orderdetail as $order)
				<tr>
					<td>{{ $order->orderid }}</td>
					<td>{{ $order->book->name }}</td>
					<td>{{ $order->quantity }}</td>
					<td>{{ $order->percent }}%</td>
					<td>{{ number_format($order->price) }}đ</td>
				</tr>
				@endforeach
		</table>
	</div>
@endsection