<?php
	require_once("Session_check.php");
?>
<!DOCTYPE html>
<head>
	<title>
		Access denied
	</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="js/script.js"></script>
</head>

<body>
	<div class="container">
			<h3> Access denied! 
			<?php
				if(!isset($_SESSION['session_id'])) {
			?>
				Go to <a href="/Login.php">Login</a> </h3>
			<?php	
			} else {
			?>
				Go to <a href="/Home.php">Home</a> </h3>
			<?php
			}
			?>
			
	</div>
</body>

</html>

