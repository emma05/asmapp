<?php
	require_once("Utilities.php");
?>

<!DOCTYPE html>
<head>
	<title>
		Login
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
		<header>
			<h2> Authentication and session management application</h2>
		</header>
		<nav>
			<h1>Login </h1>
		</nav>
		<sidebar>
		</sidebar>
		<main>
			<?php 
				if(isset($_SESSION['session_id'])) {
					echo "You are already logged in! <br/> Go to <a href='http://asmapp.com/Home.php'>Home</a>";
				} else {
			?>
			   <form action="Process_login.php" method=POST onsubmit="submit_form(this);">
			   	<div class="error"> </div>
			   	<div class="message"> </div>
				<div class="form-group">
					<label for="username">Username:</label>
					<input type="text" name="username" class="form-control">
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" name="password" class="form-control">
				</div>
				<?php
					$app = Utilities::getParams('app');
					$app = isset($app)?$app:"";
				?>
				<input type=hidden name="app" value="<?=$app?>">
				<input type="submit" name="submit" value="Submit" class="btn btn-default">
			</form>
			<?php } ?>
		</main>
		<footer>
			<p>Copyright © Emanuela Rus</p>
		</footer>
	</div>
</body>

</html>

