<form action="{{ route('getLogin') }}" method="post">
	<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
	username:
	<input type="text" name="username"/>
	email:
	<input type="text" name="email"/>
	password:
	<input type="password" name="password"/>
	<input type="submit" name="login" value="Login"/>
</form>