@extends('pages.admin.layout')
@section('title', 'Hóa đơn người dùng')
@section('header', 'Hóa đơn người dùng')

@section('content')
	{!! Breadcrumbs::render('userorder') !!}
	@if($list->count() == 0)
		<div class="alert alert-info"><ul><li>Không có hóa đơn</li></ul></div>
	@else
	<table class="table table-bordered">
		<tr class="success">
			<th>Số hóa đơn</th>
			<th>Ngày hóa đơn</th>
			<th>Địa chỉ giao hàng</th>
			<th>Số điện thoại</th>
			<th>Tổng hóa đơn</th>
		</tr>
	@foreach($list as $order)
		<tr>
			<td>{{ $order->orderid }}</td>
			<td>{{ $order->created_at }}</td>
			<td>{{ $order->address }}</td>
			<td>{{ $order->phone }}</td>
			<td>{{ number_format($order->total) }}đ</td>
		</tr>
	@endforeach
	</table>
	@endif
@endsection