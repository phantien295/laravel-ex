@extends('pages.main.homelayout')
@section('title')
	{{ $book->name }}
@endsection
@section('css')
	
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/custom.css') }}"/>
@endsection

@section('body')
	<div class="container">
		<div class="col col-xs-12 col-sm-4">
			<div class="image">
				<img src="{{ url('public/uploads/images')}}/{{ $book->image }}" height="100%" />
				<?php
					$percent = App\Promotion::where('book_id', $book->book_id)->get()->first();
					if($percent) echo '<div class="saleoff">'.-$percent->percent.'%</div>';
				?>
			</div>
			<div style="text-align: center; margin-bottom: 5px;">
				<?php $kt = false;  ?>
				@foreach(Cart::content() as $bk)
					@if($bk->id == $book->book_id)
						<?php $kt = true; ?>
						@break
					@endif
				@endforeach
				@if($book->quantity == 0)
					<div class="btn btn-warning disabled">Hết hàng</div>
				@else
				@if(!$kt)
					<a class="btn btn-info" href="{{ url('shoppingcart/cart') }}/{{ $book['book_id'] }}">
						<span class="glyphicon glyphicon-shopping-cart"></span> Thêm vào giỏ hàng
					</a>
					@else
					<div class="btn btn-warning disabled" >Đã thêm vào giỏ hàng</div>
				@endif
				@endif
			</div>
		</div>
		<div class="col col-xs-12 col-sm-8 detail">
			<div class="book-name">{{ $book->name }}</div>
			<ul>
				<li>Thể loại: {{ $book->category->name }}</li>
				<li>Tác giả: {{ $book->author }}</li>
				<li>Nhà xuất bản: {{ $book->publisher }}</li>
				<li>Số trang: {{ $book->pages }}</li>
				<li>Giá: {{-- {{ number_format($book->price) }}đ --}}
					@if(App\Promotion::where('book_id', $book->book_id)->count() > 0)
						<strike>{{ number_format($book->price) }}đ</strike>
						<b>{{ number_format($book->price - $book->promotion->percent*$book->price/100) }}đ</b>
					@else
						<b>{{ number_format($book->price) }}đ</b>
					@endif
				</li>
				<li>Số lượng: {{ $book->quantity }}</li>
				<li>Mô tả: {{ $book->description }}</li>
			</ul>
		</div>	
	</div>
	<div class="container"> {{-- class comment --}}
		@if(Auth::guest())
			<div class="col-xs-12">(Vui lòng đăng nhập để đánh giá và bình luận {{-- <a href="{ url('login') }">Đăng nhập</a> --}})
			</div>
		@endif
		{{-- Phần hiển thị bình luận và đánh giá --}}
		<?php $status = false; ?>
		<div class="col-xs-12 col-sm-7">
			<b>Đánh giá và bình luận</b>	
			@foreach($comment as $comment)
			<div class="row comment">
				<div class="col-xs-2">
					<img class="img-thumbnail" src="{{ asset('public/img/avatars') }}/{{ $comment->user->avatar }}" height="55px" />
				</div>

				<div div class="col-xs-9">
					<b>{{ $comment->username }}</b>
					<div>
						@for($i=0; $i<$comment->rating; $i++)
							<span class="glyphicon glyphicon-star"></span>
						@endfor
					</div>
					<div>{{ $comment->comment }}</div>
				</div>
				<div div class="col-xs-1">
					@if(Auth::check())
						@if(Auth::user()->level == 1)
							<a class="btn btn-default btn-sm" href="{{ url("delcomment/$comment->id") }}">Xóa</a>
						@endif
					@endif
				</div>
			</div>
				
				<?php
					if(isset(Auth::user()->username) && !Auth::guest())
						if($comment->username == Auth::user()->username) {
							$status = true;
						}
				?>
			@endforeach
		</div>
		{{-- Form đánh giá và bình luận --}}
		<div class="col-xs-12 col-sm-5">
			{{-- Số sao trung bình --}}
			<div class="rating-chart">
				<?php
					$avgRating = App\Comment::where('book_id', $book->book_id)->where('rating', '<>', 0)->get()->average('rating');
					// Định dạng lại số chữ số xuất hiện
					echo "<h3>Trung bình đánh giá: ".number_format($avgRating, 1)."</h3>";

				?>
				{{-- <div class="well">
					<div id="avg-rating"></div>
				</div> --}}
				<table class="table" cellspacing="0px" cellpadding="0px">
					<tr>
						<td width="70px"><b>1 <span class="glyphicon glyphicon-star"></span></b></td>
						<td><div class="rating1"></div></td>
					</tr>
					<tr>
						<td width="70px"><b>2 <span class="glyphicon glyphicon-star"></span></b></td>
						<td><div class="rating2"></td>
					</tr>
					<tr>
						<td width="70px"><b>3 <span class="glyphicon glyphicon-star"></span></b></td>
						<td><div class="rating3"></td>
					</tr>
					<tr>
						<td width="70px"><b>4 <span class="glyphicon glyphicon-star"></span></b></td>
						<td><div class="rating4"></td>
					</tr>
					<tr>
						<td width="70px"><b>5 <span class="glyphicon glyphicon-star"></span></b></td>
						<td><div class="rating5"></td>
					</tr>
				</table>
			</div>
			{{-- ///// --}}
			@if(Auth::check())
			{{-- @if(Auth::user()->level != 1) --}}
				{{-- @if($status == false) --}}
					<form class="form-horizontal" action="{{ route('postComment') }}" method="post">
						<div>
							<label>1. Đánh giá của bạn</label>
							<div id="my-rating"></div>
						</div>
						<input type="hidden" name="_token" value="{{ csrf_token() }}" />
						<input type="hidden" name="account" value="{{ Auth::user()->username }}" />
						<input type="hidden" name="book_id" value="{{ $book->book_id }}" />
						<input type="hidden" name="rating" id="rating" />
						<div class="form-group col-xs-12">
							<label>2. Nhận xét của bạn</label>
							<textarea name="comment" class="form-control" rows="3" placeholder="Nhận xét" /></textarea>
							@if($errors->has('comment'))
								<div class="error">
									<span class="glyphicon glyphicon-exclamation-sign"></span>  {{ $errors->first('comment')}}
								</div>
							@endif
						</div>
						<div class="form-group col-xs-12">
	    					<div>
								<button class="btn btn-success" type="submit">Đăng</button>
							</div>
						</div>
					</form>
				{{-- @else --}}
					{{-- <form class="form-horizontal" action="{{ route('postEditComment') }}" method="post">
						<div>
							<label>1. Đánh giá của bạn</label>
							<div id="my-rating"></div>
						</div>
						<input type="hidden" name="_token" value="{{ csrf_token() }}" />
						<input type="hidden" name="account" value="{{ Auth::user()->username }}" />
						<input type="hidden" name="book_id" value="{{ $book->book_id }}" />
						<input type="hidden" name="rating" id="rating" />
						<div class="form-group col-xs-12">
							<label>2. Nhận xét của bạn</label>
							<textarea name="comment" class="form-control" rows="3" placeholder="Nhận xét" ></textarea>
							@if($errors->has('comment'))
								<div class="error">
									<span class="glyphicon glyphicon-exclamation-sign"></span>  {{ $errors->first('comment')}}
								</div>
							@endif
						</div>
						<div class="form-group col-xs-12">
	    					<div>
								<button class="btn btn-success" type="submit">Chỉnh sửa</button>
							</div>
						</div>
					</form>
				@endif --}}
			{{-- @endif --}}
			@endif
		</div>
	</div>
	<div class="container">
		@if(App\Book::where('author', $book->author)->where('book_id', '<>',$book->book_id)->count() != 0)
		<div>
			<h3>Sách cùng tác giả</h3>
		</div>
		
		{{-- Kiểm tra không có sách liên quan --}}
		<div class="field">
			<div class="wrapper">
			<div class="jcarousel-wrapper">
				<div class="jcarousel" style="background: white; color: #222; opacity: 0.9;">
            	<ul>
					<?php
		    			$count = 0;
		    		?>
    				@foreach(App\Book::where('author', $book->author)->where('book_id', '<>',$book->book_id)->get() as $tam)
    				<?php $count++; ?>
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
					@if($count==10)
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
		@endif {{-- Kiểm tra không có sách liên quan --}}


	</div>
@endsection

		<?php
			$rating = collect();
			for($i=1; $i<=5; $i++){
				$rating[] = App\Comment::where('book_id', $book->book_id)->where('rating', $i)->count('rating');
			}
			if($rating->max() == 0){
				$maxChart = 1;
			}else{
				$maxChart = $rating->max();
			}
		?>

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			$("#my-rating").starRating({
				totalStars: 5,
				starSize: 25,
				emptyColor: 'lightgray',
				hoverColor: '#9bc53d',
				activeColor: '#9bc53d',
				initialRating: 0,
				strokeWidth: 0,
				useGradient: false,
				// starShape: 'rounded',
				useFullStars: true,
			  	disableAfterRate: false,
			  	callback: function(currentRating, $el){
			    	$("#rating").val(currentRating);
				}
			});
			// $("#avg-rating").jRating({
			// 	nbRates : 3
			// });
			// $("#avg-rating").click(function(){
			// 	alert();
			// });
		});

		// Xử lý rating-chart
		
		$('.rating1').css('width', '{{ App\Comment::where('book_id', $book->book_id)->where('rating', 1)->count('rating')*100/$maxChart }}'+'%');
		$('.rating2').css('width', '{{ App\Comment::where('book_id', $book->book_id)->where('rating', 2)->count('rating')*100/$maxChart }}'+'%');
		$('.rating3').css('width', '{{ App\Comment::where('book_id', $book->book_id)->where('rating', 3)->count('rating')*100/$maxChart }}'+'%');
		$('.rating4').css('width', '{{ App\Comment::where('book_id', $book->book_id)->where('rating', 4)->count('rating')*100/$maxChart }}'+'%');
		$('.rating5').css('width', '{{ App\Comment::where('book_id', $book->book_id)->where('rating', 5)->count('rating')*100/$maxChart }}'+'%');
	</script>
@endsection