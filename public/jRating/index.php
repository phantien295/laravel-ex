<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="src/css/star-rating-svg.css"/>
		<script type="text/javascript" src="src/jquery-3.1.0.min.js"></script>
		<script type="text/javascript" src="src/jquery.star-rating-svg.js"></script>
	</head>
	<body>
		<div class="my-rating-6">
			
		</div>
		<div class="star"></div>
		<form action="result.php" method="post">
			<input type="text" name="star" class="star" value="0" />
			<input type="submit" name="submit" value="submit"/>
		</form>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".my-rating").starRating({
					totalStars: 5,
					starSize: 25,
					emptyColor: 'lightgray',
					hoverColor: 'orange',
  activeColor: 'cornflowerblue',
					

					disableAfterRate: false,

					
  
					// hoverColor: 'orange',
					// activeColor: 'green',
					starShape: 'rounded',
					useFullStars: true,
					callback: function(currentRating, $el){
						
					}
				});

				$(".my-rating-6").starRating({
  totalStars: 5,
  starSize: 25,
  emptyColor: 'lightgray',
  hoverColor: 'cornflowerblue',
  activeColor: 'cornflowerblue',
  initialRating: 0,
  strokeWidth: 0,
  useGradient: false,
  starShape: 'rounded',
  useFullStars: true,
  disableAfterRate: false,
  callback: function(currentRating, $el){
    $(".star").val(currentRating);
  }
});

			});
		</script>
	</body>
</html>