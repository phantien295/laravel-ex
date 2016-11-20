@extends('pages.admin.layout')
@section('title', 'Danh sách hóa đơn')
@section('header', 'Danh sách hóa đơn')

@section('content')
	{{-- {!! Breadcrumbs::render('order') !!} --}}
	<div class="header">Hóa đơn mới</div>
	<div class="table-responsive">
		<table class="table table-bordered table-striped table-hover">
			<tr class="success">
				<th>Số hóa đơn</th>
				<th>Ngày hóa đơn</th>
				<th>Tên người dùng</th>
				<th>Địa chỉ gửi hàng</th>
				<th>Số điện thoại</th>
				<th>Tổng hóa đơn</th>
				<th></th>
			</tr>
				@foreach($newOrderlist as $order)
				<tr>
					<td>{{ $order->orderid }}</td>
					<td>{{ date("d/m/Y", strtotime($order->created_at)) }}</td>
					<td>{{ $order->username }}</td>
					<td>{{ $order->address }}</td>
					<td>{{ $order->phone }}</td>
					<td>{{ number_format($order->total) }}đ</td>
					<td>
					<div class="btn-group btn-group-xs">
						<a class="btn btn-default" href="{{ url("admin/orderdetail/$order->orderid") }}"><span class="glyphicon glyphicon-list-alt"></span>Chi tiết</a>
						<a class="btn btn-default" href="{{ url("admin/check/$order->orderid") }}"><span class="glyphicon glyphicon-check"></span>Check</a>
					</div>
					</td>
				</tr>
				@endforeach
		</table>
	</div>
		{{-- {{ $newOrderlist->links() }} --}}
		<div class="header">Hóa đơn đã lưu</div>
		{{-- Lịch --}}
		<div class="row">
			<div class="col col-xs-offset-8 col-xs-2">
				<button class="btn-block" data-toggle="collapse" data-target="#calendar"><span class="glyphicon glyphicon-calendar symbol"></span></button>
			</div>
			<div class="col col-xs-2">
				<button class="btn-block" data-toggle="collapse" data-target="#calendar2"><span class="glyphicon glyphicon-calendar symbol"></span><span class="glyphicon glyphicon-calendar symbol"></span></button>
			</div>
		</div>
		<br/>
		<div id="calendar" class="collapse container">
			<form >
				<div class="col col-sm-offset-4" id="datepicker"></div>
				<input id="date" type="hidden" />
			</form>
			<br/>
			<div class="table-responsive">
				<div class="neworder"></div>
			</div>
		</div>
		
		<div id="calendar2" class="collapse container">
			<label>Ngày bắt đầu:</label>
			<input type="text" id="datepicker1" />
			<label>Ngày kết thúc:</label>
			<input type="text" name="" id="datepicker2" />
			<button class="btn btn-default btn-sm" id="view">Xem</button>

			<br/>
			<div class="table-responsive">
				<div class="neworder2"></div>
			</div>
		</div>
		{{-- <div class="table-responsive">
			<table class="table table-bordered table-striped table-hover">
				<tr class="success">
					<th>Số hóa đơn</th>
					<th>Ngày hóa đơn</th>
					<th>Tên người dùng</th>
					<th>Địa chỉ gửi hàng</th>
					<th>Số điện thoại</th>
					<th>Tổng hóa đơn</th>
					<th></th>
				</tr>
					@foreach($orderlist as $order)
					<tr>
						<td>{{ $order->orderid }}</td>
						<td>{{ date("d/m/Y", strtotime($order->created_at)) }}</td>
						<td>{{ $order->username }}</td>
						<td>{{ $order->address }}</td>
						<td>{{ $order->phone }}</td>
						<td>{{ number_format($order->total) }}đ</td>
						<td>
						<div class="btn-group btn-group-xs">
							<a class="btn btn-default btn-xs" href="{{ url("admin/orderdetail/$order->orderid") }}"><span class="glyphicon glyphicon-list-alt"></span>Chi tiết</a>
						</div>
						</td>
					</tr>
					@endforeach
			</table>
		</div>
		{{ $orderlist->links() }} --}}
		{{-- Danh sách hóa đơn jtable --}}
		<div class="table-responsive">
	   		<div id="OrderTableContainer"></div>
    	</div>

		<script type="text/javascript">
			// Danh sách hóa đơn jtable
			$('#OrderTableContainer').jtable({
	            title: 'Danh sách hóa đơn',
	            paging: true, //Enable paging
	            pageSize: 10, //Set page size (default: 10)
	            sorting: true, //Enable sorting
	            defaultSorting: 'orderid asc', //Set default sorting
	            openChildAsAccordion: true,
	            actions: {
	    //             listAction: function (postData, jtParams) {
	    // 				return {
					//         "Result": "OK",
					{{-- //         "TotalRecordCount": {{ App\Order::all()->count() }}, --}}
					{{-- //         "Records": {!! App\Order::all()->toJson() !!} --}}
	    // 				};
					// }

					listAction: function (postData, jtParams) {
                                        	return $.Deferred(function ($dfd) {
                                        		// alert(jtParams.jtStartIndex);
										        $.ajax({
										            url: 'orderJtable',
										            dataType: 'json',
										            data: { postData: jtParams.jtPageSize,
										            	skip: jtParams.jtStartIndex,
										            	sort: jtParams.jtSorting},
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
	            	orderid: {
	                    key: true,
	                    // title: 'Mã sách',
	                    create: false,

	                    edit: false,
	                    list: true,
	                    display: function (studentData) {
                        	var $btn = $('<button class="btn btn-default btn-sm"><span class="glyphicon glyphicon-list-alt"></span> Chi tiết</button>');
                        	$btn.click(function () {
                        	    var data = studentData.record.orderid;
                        	    $('#OrderTableContainer').jtable('openChildTable',
                                    $btn.closest('tr'), //Parent row
                                    {
                             	       	title: 'Chi tiết hóa đơn',
                             	       	// sorting: true,
										actions: {
										listAction: function (postData, jtParams) {
                                        	return $.Deferred(function ($dfd) {
										        $.ajax({
										            url: 'postJtable',
										            dataType: 'json',
										            data: { postData: data },
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
                                   	        title: 'Mã sách',
                                            create: false,
                                            edit: false,
                                            list: true
                                        },
                                        quantity: {
                                            title: 'Số lượng',
                                            // width: '23%'
                                        },
                                        percent: {
                                            title: 'Giảm giá',
                                            // width: '23%'
                                        },
                                        price: {
                                            title: 'Tổng',
                                            // width: '23%'
                                        }
                                    }
                                }, function (data) { //opened handler
                                    data.childTable.jtable('load');
                                });
                       		});
                        	//Return image to show on the person row
                        	return $btn;
                    	}
	                },
	                created_at: {
	                    title: 'Ngày hóa đơn',
	                    sorting: true,
	                    type: 'date',
                    	displayFormat: 'dd-mm-yy'
	                    // width: '23%'
	                },
	                username: {
	                    title: 'Tên người dùng',
	                    // width: '23%'
	                },
	                address: {
	                    title: 'Địa chỉ gửi hàng',
	                    // width: '23%'
	                },
	                phone: {
	                    title: 'Số điện thoại',
	                    // width: '23%'
	                },
	                total: {
	                    title: 'Tổng hóa đơn',
	                    // width: '23%'
	                }
	            }
	            //Event handlers...
	        }); 
	        $('#OrderTableContainer').jtable('load');


			$('#datepicker').datepicker({
				altField: "#date",
				altFormat: "yy-mm-dd",
			});
			$('#datepicker').change(function(){
				ngay = $("#date").val();
				$.ajax({
					url: "orderRequest",
					data: {
						date: ngay
					},
					success: function(result){
						count = 0; //Đếm số hóa đơn tìm thấy
						table = '<table class="table neworder"><tr><th>Số hóa đơn</th><th>Ngày hóa đơn</th><th>Tên người dùng</th><th>Địa chỉ gửi hàng</th><th>Số điện thoại</th><th>Tổng hóa đơn</th><th></th></tr>';
						result.forEach(function(value){
							count++;
							table+="<tr><td>"+value.orderid+"</td><td>"+value.created_at+"</td>";
							table+="<td>"+value.username+"</td><td>"+value.address+"</td>";
							table+="<td>"+value.phone+"</td><td>"+value.total+"đ</td>";
							url = "orderdetail/"+value.orderid;
							table+='<td><div class="btn-group btn-group-xs"><a class="btn btn-default" href="'+url+'"><span class="glyphicon glyphicon-list-alt"></span>Chi tiết</a></div></td></tr>';
						});
						table+="</table>";
						if(count == 0){
							$('.neworder').html('<div class="alert alert-info">Không có hóa đơn</div>');
						}else{
							$('.neworder').html(table);
						}
					}
				});
			});

			$('#datepicker1').datepicker({
				altField: "#datepicker1",
				altFormat: "yy-mm-dd",
			});

			$('#datepicker2').datepicker({
				altField: "#datepicker2",
				altFormat: "yy-mm-dd",
			});

			$('#view').click(function(){
				// alert($('#datepicker1').val() + $('#datepicker2').val());
				date1 = $('#datepicker1').val();
				date2 = $('#datepicker2').val();
				$.ajax({
					url: "orderRequest2",
					data: {
						date1: date1,
						date2: date2
					},
					success: function(result){
						count = 0; //Đếm số hóa đơn tìm thấy
						table = '<table class="table neworder"><tr><th>Số hóa đơn</th><th>Ngày hóa đơn</th><th>Tên người dùng</th><th>Địa chỉ gửi hàng</th><th>Số điện thoại</th><th>Tổng hóa đơn</th><th></th></tr>';
						result.forEach(function(value){
							count++;
							table+="<tr><td>"+value.orderid+"</td><td>"+value.created_at+"</td>";
							table+="<td>"+value.username+"</td><td>"+value.address+"</td>";
							table+="<td>"+value.phone+"</td><td>"+value.total+"đ</td>";
							url = "orderdetail/"+value.orderid;
							table+='<td><div class="btn-group btn-group-xs"><a class="btn btn-default" href="'+url+'"><span class="glyphicon glyphicon-list-alt"></span>Chi tiết</a></div></td></tr>';
						});
						table+="</table>";
						if(count == 0){
							$('.neworder2').html('<div class="alert alert-info">Không có hóa đơn</div>');
						}else{
							$('.neworder2').html(table);
						}
					}
				});
			});

		</script>
	</div>
@endsection