@extends('pages.admin.layout')
@section('title', 'Hóa đơn')
@section('header', 'Hóa đơn')

@section('content')
	<div class="table-responsive">
		<table class="table">
			<tr>
				<th>Số hóa đơn</th>
				<th>Ngày hóa đơn</th>
				<th>Tên người dùng</th>
				<th>Địa chỉ gửi hàng</th>
				<th>Số điện thoại</th>
				<th>Số lượng</th>
				<th>Giảm giá</th>
				<th>Giá</th>
			</tr>
				@foreach($orderlist as $order)
				<tr>
					<td><a href="{{ url("admin/orderdetail/$order->orderid") }}"><span class="glyphicon glyphicon-list-alt"></span>  {{ $order->orderid }}</a></td>
					<td>{{ $order->order->created_at }}</td>
					<td>{{ $order->order->username }}</td>
					<td>{{ $order->order->address }}</td>
					<td>{{ $order->order->phone }}</td>
					<td>{{ $order->quantity }}</td>
					<td>{{ $order->percent }}%</td>
					<td>{{ number_format($order->price) }}đ</td>
				</tr>
				


				{{-- <tr id="{{ $order->orderid }}"  class="collapse success">
					
					<td></td>
					<td>{{ $order->orderid }}</td>
					<td>{{ $order->orderid }}</td>
					<td>{{ $order->orderid }}</td>
					<td>{{ $order->orderid }}</td>
					<td>{{ $order->orderid }}</td>
					<td>{{ $order->orderid }}</td>
				</tr> --}}
				@endforeach
		</table>
	</div>
@endsection