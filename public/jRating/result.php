<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="src/css/star-rating-svg.css"/>
		<script type="text/javascript" src="src/jquery-3.1.0.min.js"></script>
		<script type="text/javascript" src="dist/jquery.star-rating-svg.js"></script>
	</head>
	<body>
		<div class="star">
			
		</div>
		
		<script type="text/javascript">
			$(document).ready(function(){
				
				$(".star").starRating({
					totalStars: 5,initialRating: <?php
	if(isset($_POST['star'])){
		echo $_POST['star'];
	}
?>,
  					readOnly: true,
  					activeColor: 'cornflowerblue',
  					starShape: 'rounded'
				});
			});
		</script>
	</body>
</html>



