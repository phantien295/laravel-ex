* Laravel 5.2
* Hạn chế:
+ Quay lại trang đứng trước đó khi đăng nhập


Chặn theo thông tin người dùng

* Code sản phẩm bán chạy (version 1)
{{-- <?php
				$books = App\OrderDetail::all()->groupBy('book_id');
    			$mang = collect();
    			foreach ($books as $bk=>$book){
        			$mang[] = ['id' => $bk, 'quantity' => $book->sum('quantity')];
    			}
    			$count = 0;
    		?>
    		<div class="table-responsive">
    			<table class="table">
    				<tr>
    				@foreach($mang->sortByDesc('quantity') as $bk)
    				<?php $count++; ?>
    				<?php $tam = App\Book::where('book_id', $bk['id'])->get()->first(); ?>
    					@if($tam->status)
						<td >
						<div class="one-picture">
							<a href="{{ url('books') }}/{{ $tam->book_id }}"><img src="{{ url('public/uploads/images') }}/{{ $tam->image }}" height="250px"/>
								@if(App\Promotion::where('book_id', $tam->book_id)->count() > 0)
									<div class="saleoff">-{{ App\Promotion::where('book_id', $tam->book_id)->get()->first()->percent }}%</div>
								@endif
							</a>
								<br/><br/>
								{{ $tam->name }}
								<br/>
								Giá:
								@if(App\Promotion::where('book_id', $tam->book_id)->count() > 0)
									<strike>{{ number_format($tam->price) }}đ</strike>
									{{ number_format($tam->price - $tam->promotion->percent*$tam->price/100) }}đ
								@else
									{{ number_format($tam->price) }}đ
								@endif
								<br/>
								
								<?php $kt = false;  ?>
								@foreach(Cart::content() as $bk)
									@if($bk->id == $tam->book_id)
										<?php $kt = true; ?>
										@break
									@endif
								@endforeach
								@if($tam->quantity == 0)
									<div class="btn btn-warning disabled">Hết hàng
								</div>
								@else
								@if(!$kt)
								<a class="btn btn-info" href="{{ url('shoppingcart/cart') }}/{{ $tam->book_id }}">
									<span class="glyphicon glyphicon-shopping-cart"></span> Thêm vào giỏ hàng
								</a>
								@else
									<div class="btn btn-warning disabled">Đã thêm vào giỏ hàng
								</div>
								@endif
								@endif
						</td>
						@endif
					@if($count==4)
						@break
					@endif
				
        		@endforeach
        		</tr>
				</table>
			</div> --}}