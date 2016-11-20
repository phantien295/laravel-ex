@extends('pages.main.homelayout')
@section('title', 'Giỏ hàng')

@section('body')
	<div class="container cartdetail">
		@if(Cart::count()==0)
				<div class="alert alert-info">{{ "Không có sản phẩm trong giỏ hàng" }}</div>
			@else
		<div class="table-responsive">
		<table class="table">
			<tr>
				<th></th>
				<th>Tên sách</th>
				<th>Số lượng</th>
				<th>Giảm giá</th>
				<th>Thành tiền</th>
				<th></th>
			</tr>
			<?php
				$id = 0;
				$promotion = 0; //Biến dùng để đếm tổng giảm giá
			?>
			@foreach(Cart::content() as $book)
				<?php $id++; ?>
				<tr>
					{{-- Lưu rowId và quantity để gửi đi --}}
					<input type="hidden" class="row{{ $id }}" value="{{ $book->rowId }}"/>
					<input type="hidden" class="price{{ $id }}" value=""/>
					<td>
						<a href="{{ url('books') }}/{{ $book->id }}"><div class="one-picture"><img src="{{ url('public/uploads/images') }}/{{ $book->options->img }}" height="120px" /></div></a>
					</td>
					<td><p>{{ $book->name }}</p></td>
					<td>
						<p style="padding-top: 40px; width: 100px;">
							<input name="{{ $id }}" id="qty" class="form-control" value="{{ $book->qty }}" />
						{{-- <select class="form" name="{{ $id }}" id="qty">
							@for($i=1; $i<=App\Book::where('book_id', $book->id)->get()->first()->quantity; $i++)
								@if($i == $book->qty)
									<option class="qty" value="{{ $i }}" selected="true">{{ $i }}</option>
								@else
									<option class="qty" value="{{ $i }}">{{ $i }}</option>
								@endif
							@endfor
						</select> --}}
						</p>
					</td>
					{{-- Giảm giá --}}
					<td>
						<p>{{ $book->options->percent }}%</p>
						{{-- Đếm tổng giảm giá --}}
						<?php
							$promotion += $book->price*$book->qty - $book->price*$book->qty*$book->options->percent/100;
						?>
					</td>
					<td><p>{{ number_format($book->price*$book->qty - $book->price*$book->qty*$book->options->percent/100) }}đ</p></td>
					<td><p><button class="btn btn-info removeCart{{ $id }}">Xóa khỏi giỏ hàng</button></p></td>
				</tr>
			@endforeach
			
			</table>
			</div>
		<div>Tổng hóa đơn: <?php echo number_format($promotion); /*Cart::total(0) -*/  ?>đ</div>
		<br/>
		<div>
		@if(Cart::count() == 0)
			<div class="btn-group">
				<a href="#" class="btn btn-success disabled">Đặt hàng</a>
				<a href="{{ url('shoppingcart/destroy') }}" class="btn btn-danger disabled">Xóa giỏ hàng</a>
			</div>
		@else
			<div class="btn-group">
				<a href="{{ url('shoppingcart/checkout') }}" class="btn btn-success">Đặt hàng</a>
				<a href="{{ url('shoppingcart/destroy') }}" class="btn btn-danger">Xóa giỏ hàng</a>
			</div>
		@endif
		</div>

			@endif

		
	</div>
	{{-- <script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script> --}}
	<script type="text/javascript">
		$(document).ready(function(){
			$('input').change(function(){
				id = $(this).attr('name');
				value = $(this).val();
				$(".price"+id).val(value);

				$.ajax({url: "getRequest",
					data: {
						row: $(".row"+id).val(),
						price: $(".price"+id).val()
						// id: $('#qty').val(),
					}, 
					success: function(result){
						if(result == "success"){
							$(location).attr('href', '{{ url('shoppingcart/cartdetail') }}');
							// bootbox.alert(result);
							
						}else{
							bootbox.alert('Bạn đã nhập quá số lượng<br/>Số lượng sách chỉ còn: '+result);
							// $(location).attr('href', result);
						}
    				}
    			});
			});

			$("[class*='removeCart']").click(function(){
				classattr = $(this).attr('class');
				id = classattr.substr(-1, 1);
				// alert(id);
				$.ajax({url: "remove",
					data: {
						row: $(".row"+id).val(),
						// id: $('#qty').val(),
					}, 
					success: function(result){
        				$(location).attr('href', result);
    				}
    			});

			});

			$("[class*='addCart']").click(function(){
				classattr = $(this).attr('class');
				id = classattr.substr(-1, 1);

				
				// alert($(".row"+id).val());
				// $.ajax({url: "remove",
				// 	data: {
				// 		row: $(".row"+id).val(),
				// 		// id: $('#qty').val(),
				// 	}, 
				// 	success: function(result){
    //     				$(location).attr('href', result);
    // 				}
    // 			});				
			});
		});
	</script>
@endsection
