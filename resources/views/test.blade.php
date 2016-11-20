<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Document</title>
		<style type="text/css">
			img:hover{
				cursor: pointer;
			}
		</style>
	</head>
	<body>
		<?php
			echo "<pre>";
			var_dump(Cart::content());
			echo "</pre>";
		?>

		

		<button type="button" id="getRequest">Get Request</button>
		<script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#getRequest').click(function(){
					$.get('getRequest', function(data){
						alert(data);
					});
				});
			});
		</script>
	</body>
</html>