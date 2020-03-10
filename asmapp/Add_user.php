<?php
	require_once("Validate_session.php");
	require_once("Utilities.php");
	require_once("User_rights_check.php");
	checkUserRight($_SESSION, "addUser");
?>
<!DOCTYPE html>
<head>
	<title>
		Add user
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
			<h2>Add user</h2>
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
			   <form action="Process_add_user.php" method=POST onsubmit="submit_form(this);">
			   	<div class="error"> </div>
			   	<div class="message"> </div>
				<div class="form-group">
					<label for="username">Username:</label>
					<input type="text" name="username" class="form-control">
					<label for="password">Password:</label>
					<input type="password" name="password" class="form-control">
					<label for="apps">App:</label>
					<select id="apps" name=app class="form-control" onchange="update_select_data(this)">
						<option disabled selected value=""> -- select an option -- </option>
					<?php
						$url = "http://asmapp_api.com/get";
						$parameters = array(
							'type' => 'apps',
						); 
						$apps = Utilities::curlConnection($url, 'POST', $parameters);
						$parameters = array(
							'type' => 'roles_app'
						);
						$roles = Utilities::curlConnection($url, 'POST', $parameters);
						if($apps) {
							foreach($apps as $app) {
								?>
								<option id="<?=$app['app_id']?>" value="<?=$app['app_id']?>"><?=$app['app_name']?></option>
								<?php
							}
						}
					?>
					</select>
					<div id="roles_container" style="display:none">
						<label for="roles">Role:</label>
						<select id="roles" name="role" class="form-control">
						<option disabled selected value=""> -- select an option -- </option>
						<?php
							if($roles) {
								foreach($roles as $role) {
									?>
									<option id="<?=$role['role_id']?>" app_id="<?=$role['app_id']?>" value="<?=$role['role_id']?>"><?=$role['role_name']?></option>
									<?php
								}
							}
						?>
						</select>
					</div>
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

