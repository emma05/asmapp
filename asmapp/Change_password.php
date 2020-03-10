<?php
	require_once("Session_check.php");
	require_once("User_rights_check.php");
	checkUserRight($_SESSION, "changePassword");	
?>
<!DOCTYPE html>
<head>
	<title>
		Change password
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
			<h2>Change password</h2>
			<span><a href="http://asmapp.com/Process_logout.php">Logout?</a></span>
		</nav>
		<sidebar>
			<span><a href="Change_password.php">Change password</a></span> <br/>
			<span><a href="Manage_users.php">Manage users</a></span> <br/>
			<span><a href="Add_user.php">Add user</a></span> <br/>
			<span><a href="Add_app.php">Add app</a></span> <br/>
			<span><a href="Add_role.php">Add role</a></span> <br/>
			<span><a href="Add_right.php">Add access right</a></span> <br/>
		</sidebar>
		<main>
			   <form action="Process_change_password.php" method=POST onsubmit="submit_form(this);">
			   	<div class="error"> </div>
			   	<div class="message"> </div>
				<div class="form-group">
					<label for="password">New Password:</label>
					<input type="password" name="password" class="form-control">
					<input type="hidden" name="session_id" value="<?=$_SESSION['session_id']?>">
				</div>
				<input type="submit" name="submit" value="Submit" class="btn btn-default">
			</form>
		</main>
		<footer>
			<p>Copyright © Emanuela Rus</p>
		</footer>
	</div>
</body>

</html>

