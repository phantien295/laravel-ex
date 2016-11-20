<form action="{{ route('addcart') }}" method="post">
	<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
	<input type="hidden" name="book_id" value="{{ $book->book_id }}">
	<select name="quantity">
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
	</select>
	<button type="submit" name="addcart" class="btn btn-success">Thêm vào giỏ hàng</button>
</form>