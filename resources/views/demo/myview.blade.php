<form method="post" action="{{ route('postContact') }}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
	<input type="text" name="name"/>
	<input type="text" name="pass"/>
	<input type="submit" value="Send"/>
</form>