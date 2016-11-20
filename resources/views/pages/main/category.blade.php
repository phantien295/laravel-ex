@extends('pages.main.homelayout')
@section('title')
	{{ $title->name }}
@endsection

@section('body')
	<div class="container margin main">
		<div class="subject">
			<div class="arrow-one"></div><div class="subject-title">{{ $title->name }}</div><div class="arrow-two"></div>
		</div>
		<div class="field">
			<div class="table-responsive">
				<table class="table">
					<tr>
						@foreach($listbook as $book)
							<td class="photo">
								<div class="one-picture">
								<a href="{{ url('books') }}/{{ $book['book_id'] }}"><img src="{{ url('public/uploads/images') }}/{{ $book['image'] }}" height="210px"/>
								{{-- Hiển thị giảm giá --}}
								@if(App\Promotion::where('book_id', $book->book_id)->count() > 0)
									<div class="saleoff">-{{ App\Promotion::where('book_id', $book->book_id)->get()->first()->percent }}%</div>
								@endif
								</a>
								<br/>
								<b>{{ $book['name'] }}</b>
								<br/>
								Giá: {{-- {{ number_format($book['price']) }}đ --}}
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
								{{-- ///// --}}
								<br/>
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
								<a class="btn btn-info" href="{{ url('shoppingcart/cart') }}/{{ $book['book_id'] }}">
									<span class="glyphicon glyphicon-shopping-cart"></span> Thêm vào giỏ hàng
								</a>
								@else
									<div class="btn btn-warning disabled" >Đã thêm vào giỏ hàng
								</div>
								@endif
								@endif
								{{-- <div class="saleoff">15%</div>	 --}}
								</div>
							</td>
						@endforeach
					</tr>
				</table>	
			</div>
			<div class="paginate">{{ $listbook->links() }}</div>
		</div>
	</div>
@endsection