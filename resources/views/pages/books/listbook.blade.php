@extends('pages.admin.layout')
@section('title', 'Danh sách books')
@section('header', 'Danh sách')

@section('content')
	{!! Breadcrumbs::render('listbook') !!}
	<div class="container">
		<form action="{{ url('admin/getfindbook') }}" method="get">
			{{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
			<select name="cat">
				<option value="book_id">Mã sách</option>
				<option value="name">Tên sách</option>
				<option value="author">Tác giả</option>
				<option value="publisher">Nhà xuất bản</option>
			</select>
			<input type="text" name="find"/>
			<button class="btn btn-success btn-sm" type="submit" value="findbook">Tìm kiếm</button>
		</form>
	</div>
	<br/>
	{{-- <div class="table-responsive">
		<table class="table">
			<tr class="success">
				<th>Mã sách</th>
				<th>Tên sách</th>
				<th>Tác giả</th>
				<th>Thể loại</th>
				<th>NXB</th>
				<th>Giá</th>
				<th>Số lượng</th>
				<th>Thao tác</th>
			</tr>
		@foreach($list as $book)
			<tr>
				<td><a href="{{ url("admin/bookorder/$book->book_id") }}">{{ $book['book_id'] }}</a></td>
				<td>{{ $book['name'] }}</td>
				<td>{{ $book['author'] }}</td>
				<td>{{ $book->category->name }}</td>
				<td>{{ $book['publisher'] }}</td>
				<td>{{ $book['price'] }}đ</td>
				<td>{{ $book->quantity }}</td>
				<td><a class="btn btn-default btn-xs" href="{{ url("admin/editbook") }}/{{ $book['book_id'] }}"><span class="glyphicon glyphicon-edit"></span> Edit</a>
					@if($book->status)
						<a class="btn btn-default btn-xs" href="{{ url("admin/hide/$book->book_id") }}"><span class="glyphicon glyphicon-ok-sign"></span></a>
					@else
						<a class="btn btn-default btn-xs" href="{{ url("admin/unhide/$book->book_id") }}"><span class="glyphicon glyphicon-remove-sign"></span></a>
					@endif
				</td>
			</tr>
		@endforeach
		</table>
	</div> --}}

	<div class="table-responsive">
	   		<div id="OrderTableContainer"></div>
    	</div>
	<br/>
	<div><i>"Click vào mã sách để xem những hóa đơn của sách"</i></div>



	<script type="text/javascript">
			// Danh sách hóa đơn jtable
			$('#OrderTableContainer').jtable({
	            title: 'Danh sách tất cả sách',
	            paging: true, //Enable paging
	            sorting: true, //Enable sorting
	            defaultSorting: 'book_id asc', //Set default sorting
	            // openChildAsAccordion: true,
	            actions: {
					listAction: function (postData, jtParams) {
		            	return $.Deferred(function ($dfd) {
							$.ajax({
					            url: 'listBook',
					            dataType: 'json',
					            data: {
					            	size: jtParams.jtPageSize,
				            		skip: jtParams.jtStartIndex,
				            		sort: jtParams.jtSorting
				            	},
					            success: function (data) {
					                $dfd.resolve(data);
					            },
					            error: function () {
									$dfd.reject();
					            }
					        });
   						});
					}
	            },
	            fields: {
	            	book_id: {
	                    key: true,
	                    // title: 'Mã sách',
	                    create: false,
	                    edit: false,
	                    list: false,
	                },
	                code: {
	                    title: 'Mã sách',
	                    sorting: false,
	                    // width: '23%'
	                },
	                name: {
	                    title: 'Tên sách',
	                    sorting: true,
	                    // width: '23%'
	                },
	                cat_id: {
	                    title: 'Thể loại',
	                    // width: '23%'
	                },
	                author: {
	                    title: 'Tác giả',
	                    // width: '23%'
	                },
	                publisher: {
	                    title: 'NXB',
	                    // width: '23%'
	                },
	                price: {
	                    title: 'Giá',
	                    // width: '23%'
	                },
	                quantity: {
	                    title: 'Số lượng',
	                    width: '7%'
	                },
	                edit:{
	                	title: 'Thao tác',
	                	sorting: false,
	                	width: '15%'
	                }
	            }
	            //Event handlers...
	        }); 
	        $('#OrderTableContainer').jtable('load');

		</script>
@endsection