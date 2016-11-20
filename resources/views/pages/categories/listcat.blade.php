@extends('pages.admin.layout')
@section('title', 'Danh sách thể loại')
@section('header', 'Danh sách thể loại')

@section('content')
	{!! Breadcrumbs::render('listcat') !!}
	<div class="row table-responsive">
		<div class="col col-xs-12 col-sm-4 col-sm-offset-4">
			<table class="table table-bordered">
				<tr class="success">
					<th>Mã thể loại</th>
					<th>Tên thể loại</th>
				</tr>
				@foreach($cats as $cat)
				<tr>
					<td><a href="{{ url("admin/bookcat/$cat->cat_id") }}">{{ $cat->cat_id }}</a></td>
					<td>{{ $cat->name }}</td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
	<br/>
	<div>
		<i>"Click vào mã thể loại để xem những cuốn sách có trong thể loại"</i>
	</div>
@endsection