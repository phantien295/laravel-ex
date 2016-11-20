@extends('pages.admin.layout')
@section('title', 'Sách theo thể loại')
@section('header', 'Sách theo thể loại')

@section('content')
	{!! Breadcrumbs::render('bookcat') !!}
	<div class="row table-responsive">
		<div class="col col-xs-12 col-sm-8 col-sm-offset-2">
			<table class="table table-bordered">
				<tr class="success">
					<th>Mã sách</th>
					<th>Tên sách</th>
					<th>Tác giả</th>
					<th>NXB</th>
					<th>Số lượng</th>
				</tr>
				@foreach($books as $book)
				<tr>
					<td>{{ $book->book_id }}</td>
					<td>{{ $book->name }}</td>
					<td>{{ $book->author }}</td>
					<td>{{ $book->publisher }}</td>
					<td>{{ $book->quantity }}</td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
@endsection