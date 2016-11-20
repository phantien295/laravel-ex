@extends('pages.main.homelayout')
@section('title', 'Books Town')

@section('body')
	<div class="container main">	
		<div class="subject">
			<div class="arrow-one"></div><div class="subject-title">Sách bán chạy</div><div class="arrow-two"></div>
		</div>
		<div class="field">
			<div class="wrapper">
			<div class="jcarousel-wrapper">
				<div class="jcarousel">
            	<ul>
					<?php
						$books = App\OrderDetail::all()->groupBy('book_id');
		    			$mang = collect();
		    			foreach ($books as $bk=>$book){
		        			$mang[] = ['id' => $bk, 'quantity' => $book->sum('quantity')];
		    			}
		    			$count = 0;
		    		?>
    			
    				@foreach($mang->sortByDesc('quantity') as $bk)
    				<?php $count++; ?>
    				<?php $tam = App\Book::where('book_id', $bk['id'])->get()->first(); ?>

    					@if($tam->status)
						<li>
						{{-- <div class="one-picture"> --}}
						<div class="row card">
							<div class="col-xs-12">
							<a href="{{ url('books') }}/{{ $tam->book_id }}"><img src="{{ url('public/uploads/images') }}/{{ $tam->image }}" height="210px"/>
								@if(App\Promotion::where('book_id', $tam->book_id)->count() > 0)
									<div class="saleoff">-{{ App\Promotion::where('book_id', $tam->book_id)->get()->first()->percent }}%</div>
								@endif
							</a>
							</div>
							<div class="col-xs-12">
								<b>{{ $tam->name }}</b>
								<br/>
								Giá:
								@if(App\Promotion::where('book_id', $tam->book_id)->count() > 0)
									<strike>{{ number_format($tam->price) }}đ</strike>
									{{ number_format($tam->price - $tam->promotion->percent*$tam->price/100) }}đ
								@else
									{{ number_format($tam->price) }}đ
								@endif
								<br/>
								{{-- Sao đánh giá --}}
								Đánh giá:
								@if(App\Comment::where('book_id', $tam->book_id)->get()->average('rating') == 0)
									{{ 0 }} <span style="color: #9bc53d" class="glyphicon glyphicon-star"></span>
								@else
									{{ number_format(App\Comment::where('book_id', $tam->book_id)->get()->average('rating'), 1) }} <span style="color: #9bc53d" class="glyphicon glyphicon-star"></span>
								@endif
								{{-- ///// --}}
								<?php $kt = false;  ?>
								@foreach(Cart::content() as $bk)
									@if($bk->id == $tam->book_id)
										<?php $kt = true; ?>
										@break
									@endif
								@endforeach
								@if($tam->quantity == 0)
									<br/>
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
								</div>
								</div>
						</li>
						@endif
					@if($count==8)
						@break
					@endif
					
        		@endforeach
        		


                </ul>
            </div>

            <a href="#" class="jcarousel-control-prev" style="text-decoration: none;">&lsaquo;</a>
            <a href="#" class="jcarousel-control-next" style="text-decoration: none">&rsaquo;</a>
        </div>
    </div>
			
		</div>
		{{-- Sách mới --}}
		<div class="subject">
			<div class="arrow-one"></div><div class="subject-title">Sách mới</div><div class="arrow-two"></div>
		</div>
		<div class="field row">
			<div class="col col-xs-12 col-sm-3 col-sm-offset-2">
			<div class="table-responsive">
				<table class="table">
					<tr>
						<td >
						<div class="one-picture">
							<a href="{{ url('books') }}/{{ $last->book_id }}"><img src="{{ url('public/uploads/images') }}/{{ $last->image }}" height="210px"/>
								@if(App\Promotion::where('book_id', $last->book_id)->count() > 0)
									<div class="saleoff">-{{ App\Promotion::where('book_id', $last->book_id)->get()->first()->percent }}%</div>
								@endif
							</a>
								<br/><br/>
								<b>{{ $last->name }}</b>
								<br/>
								Giá: 
								@if(App\Promotion::where('book_id', $last->book_id)->count() > 0)
									<strike>{{ number_format($last->price) }}đ</strike>
									{{ number_format($last->price - $last->promotion->percent*$last->price/100) }}đ
								@else
									{{ number_format($last->price) }}đ
								@endif
								<br/>
								{{-- Sao đánh giá --}}
								Đánh giá:
								@if(App\Comment::where('book_id', $last->book_id)->get()->average('rating') == 0)
									{{ 0 }} <span style="color: #9bc53d" class="glyphicon glyphicon-star"></span>
								@else
									{{ number_format(App\Comment::where('book_id', $last->book_id)->get()->average('rating'), 1) }} <span style="color: #9bc53d" class="glyphicon glyphicon-star"></span>
								@endif
								{{-- ///// --}}
								<?php $kt = false;  ?>
								@foreach(Cart::content() as $bk)
									@if($bk->id == $last->book_id)
										<?php $kt = true; ?>
										@break
									@endif
								@endforeach
								@if($last->quantity == 0)
									<div class="btn btn-warning disabled">Hết hàng
								</div>
								@else
								@if(!$kt)
								<a class="btn btn-info" href="{{ url('shoppingcart/cart') }}/{{ $last->book_id }}">
									<span class="glyphicon glyphicon-shopping-cart"></span> Thêm vào giỏ hàng
								</a>
								@else
									<div class="btn btn-warning disabled">Đã thêm vào giỏ hàng
								</div>
								@endif
								@endif
						</td>
					</tr>
				</table>
			</div>
			</div>
			<div class="col col-xs-12 col-sm-6">
				<br/>
				{{ $last->description }}
			</div>
		</div>
		{{-- Sách giảm giá --}}
		<div class="subject">
			<div class="arrow-one"></div><div class="subject-title">Sách giảm giá</div><div class="arrow-two"></div>
		</div>
		<div class="field">
			<div class="table-responsive">
					<table class="table">
					<?php $row = 0; ?>
					<tr>
						@foreach(App\Promotion::all() as $book)
							<?php $row++; ?>
							{{-- Ân sách status false --}}
							@if(!App\Book::where('book_id', $book->book_id)->get()->first()->status)
								@continue
							@endif
							<td >
								<div class="one-picture">
								<a href="{{ url('books') }}/{{ $book->book_id }}"><img src="{{ url('public/uploads/images') }}/{{ $book->book->image }}" height="210px"/>
									{{-- Giảm giá --}}
									<?php
										$percent = App\Promotion::where('book_id', $book->book_id)->get()->first();
										if($percent) echo '<div class="saleoff">'.-$percent->percent.'%</div>';
									?>
								</a>
								<br/><br/>
								<b>{{ $book->book->name }}</b>
								<br/>
								Giá: 
								@if(App\Promotion::where('book_id', $book->book_id)->count() > 0)
									<strike>{{ number_format($book->book->price) }}đ</strike>
									{{ number_format($book->book->price - $book->percent*$book->book->price/100) }}đ
								@else
									{{ number_format($book->book->price) }}đ
								@endif
								<br/>
								{{-- Sao đánh giá --}}
								Đánh giá:
								@if(App\Comment::where('book_id', $book->book_id)->get()->average('rating') == 0)
									{{ 0 }} <span style="color: #9bc53d" class="glyphicon glyphicon-star"></span>
								@else
									{{ number_format(App\Comment::where('book_id', $book->book_id)->get()->average('rating'), 1) }} <span style="color: #9bc53d" class="glyphicon glyphicon-star"></span>
								@endif
								{{-- ///// --}}
								<br/>
								<?php $kt = false;  ?>
								@foreach(Cart::content() as $bk)
									@if($bk->id == $book->book_id)
										<?php $kt = true; ?>
										@break
									@endif
								@endforeach
								@if($book->book->quantity == 0)
									<div class="btn btn-warning disabled">Hết hàng
								</div>
								@else
								@if(!$kt)
								<a class="btn btn-info" href="{{ url('shoppingcart/cart') }}/{{ $book->book_id }}">
									<span class="glyphicon glyphicon-shopping-cart"></span> Thêm vào giỏ hàng
								</a>
								@else
									<div class="btn btn-warning disabled">Đã thêm vào giỏ hàng
								</div>
								@endif
								@endif
								</div>
							</td>
							@if($row%4==0)
								</tr><tr>
							@endif
						@endforeach
					</tr>
					</table>	
				</div>
				{{-- <div>{{ $listbook->links() }}</div> --}}
		</div>
		</div>
		<br/>
		<br>
		
		<div class="container">
			<i>"Một cuốn sách thực sự hay nên đọc trong tuổi trẻ, rồi đọc lại khi đã trưởng thành, và một lần nữa lúc tuổi già, giống như một tòa nhà đẹp nên được chiêm ngưỡng trong ánh sáng bình minh, nắng trưa và ánh trăng."</i>
			<br/>
			<i>A truly great book should be read in youth, again in maturity and once more in old age, as a fine building should be seen by morning light, at noon and by moonlight.</i>
			<br/>
			<b style="float: right;">Robertson Davies</b>
		</div>
		<br>
		<br>
		<br>
		<br>
		<br>
		
		<div class="container main">
		<div class="subject">
			<div class="arrow-one"></div><div class="subject-title">Kho sách</div><div class="arrow-two"></div>
		</div>
		<div class="field">
			<div class="table-responsive">
					<table class="table">
					<?php $row = 0; ?>
					<tr>
						@foreach($listbook as $book)
							<?php $row++; ?>
			
							<td >
								<div class="row card">
									{{-- Phần hình ảnh --}}
									<div class="col-xs-12">
										<a href="{{ url('books') }}/{{ $book->book_id }}"><img src="{{ url('public/uploads/images') }}/{{ $book->image }}" height="210px"/>
											{{-- Giảm giá --}}
											<?php
												$percent = App\Promotion::where('book_id', $book->book_id)->get()->first();
												if($percent) echo '<div class="saleoff">'.-$percent->percent.'%</div>';
											?>
										</a>
									</div>
									{{-- Phần nội dung --}}
									<div class="col-xs-12">
										<b>{{ $book->name }}</b>
										<br/>
										Giá: 
										@if(App\Promotion::where('book_id', $book->book_id)->count() > 0)
											<strike>{{ number_format($book->price) }}đ</strike>
											{{ number_format($book->price - $book->promotion->percent*$book->price/100) }}đ
										@else
											{{ number_format($book->price) }}đ
										@endif
										<br/>
										{{-- Sao đánh giá --}}
										Đánh giá:
										@if(App\Comment::where('book_id', $book->book_id)->get()->average('rating') == 0)
											{{ 0 }} <span style="color: #9bc53d" class="glyphicon glyphicon-star"></span>
										@else
											{{ number_format(App\Comment::where('book_id', $book->book_id)->get()->average('rating'), 1) }} <span style="color: #9bc53d" class="glyphicon glyphicon-star"></span>
										@endif
										{{-- Button --}}
										<div>
										<?php $kt = false;  ?>
										@foreach(Cart::content() as $bk)
											@if($bk->id == $book->book_id)
												<?php $kt = true; ?>
												@break
											@endif
										@endforeach
										@if($book->quantity == 0)
											<div class="btn btn-warning disabled">Hết hàng
										</div>
										@else
										@if(!$kt)
										<a class="btn btn-info" href="{{ url('shoppingcart/cart') }}/{{ $book->book_id }}">
											<span class="glyphicon glyphicon-shopping-cart"></span> Thêm vào giỏ hàng
										</a>
										@else
											<div class="btn btn-warning disabled">Đã thêm vào giỏ hàng
										</div>
										@endif
										@endif
										</div>
									</div>
								</div>
							</td>
							@if($row%4==0)
								</tr><tr>
							@endif
						@endforeach
					</tr>
					</table>	
				</div>
				<div>{{ $listbook->links() }}</div>
		</div>
	</div>

	<script type="text/javascript">
		$(function() {
		    $('.jcarousel').jcarousel({
		        // Configuration goes here
		    });
		});

		$('.blur').particleground({
		    dotColor: '#fff',
		    lineColor: '#333'
		  });
	</script>
@endsection