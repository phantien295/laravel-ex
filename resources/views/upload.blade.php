<form action="{{ route('getUpload') }}" method="post" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
	<input type="file" name="image"/>
	<input type="submit" name="submit" value="Upload"/>
</form>