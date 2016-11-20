@extends('pages.main.homelayout')
@section('title', 'Tìm kiếm')

@section('body')
	<div class="container margin">
		@if($result->count() == 0)
			<div class="alert alert-danger">{{ "Không tìm thấy kết quả" }}</div>
		@else
			<div class="main">
			<div class="subject">
				<div class="arrow-one"></div><div class="subject-title">Kết quả tìm kiếm</div><div class="arrow-two"></div>
			</div>
			<div class="table-responsive">
					<table class="table">
					<?php $row = 0; ?>
					<tr>
						@foreach($result as $book)
							<?php $row++; ?>
							<td class="photo">
								<div class="one-picture">
								<a href="{{ url('books') }}/{{ $book->book_id }}"><img src="{{ url('public/uploads/images') }}/{{ $book->image }}" height="210px"/>
								@if(App\Promotion::where('book_id', $book->book_id)->count() > 0)
									<div class="saleoff">-{{ App\Promotion::where('book_id', $book->book_id)->get()->first()->percent }}%</div>
								@endif
								</a>
								<br/>
								<b>{{ $book->name }}</b>
								<br/>
								Giá: {{-- {{ number_format($book->price) }}đ --}}
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
								<a class="btn btn-info" href="{{ url("shoppingcart/cart/$book->book_id") }}">
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
							@if($row%4==0)
								</tr><tr>
							@endif
						@endforeach
					</tr>
					</table>	
				</div>
			{{ $result->links() }}
		</div>
		@endif
	</div>
@endsection