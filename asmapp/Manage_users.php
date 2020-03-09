<?php
	require_once("Utilities.php");
	require_once("Session_check.php");
	require_once("User_rights_check.php");
	checkUserRight($_SESSION, "manageUsers");
?>

<!DOCTYPE html>
<head>
	<title>
		Manage users
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
			<h2>Manage users</h2>
			<span> <a href="http://asmapp.com/Process_logout.php">Logout?</a></span>
		</nav>
		<sidebar>
			<span><a href="Change_password.php">Change password</a></span> <br/>
			<span><a href="Manage_users.php">Manage users</a></span>
		</sidebar>
		<main>
			<h3>Users - Change password and user access rights</h3>
			<?php
				$url = "http://asmapp_api.com/get_users";
				$users = Utilities::curlConnection($url, 'GET');
				if($users) {
					//var_dump($users);
					foreach($users as $data) {
					?> 
					<div class="error" id="error_<?=$data['user_id']?>"> </div>
					<div class="message" id="message_<?=$data['user_id']?>"> </div>
					 <form action="Process_change_password.php" method=POST onsubmit="submit_form(this);">
						<div class="form-group">
							<b><?=$data['username']?> </b><br/>
							<label for="password">New Password:</label>
							<input type="password" name="password" class="form-control">
							<input type="hidden" name="user_id" value="<?=$data['user_id']?>">
							<input type="hidden" id="type" value="multiple">
						</div>
						<input type="submit" name="submit" value="Submit" class="btn btn-default">
					</form>
					<form action="Process_manage_user.php" method=POST onsubmit="submit_form(this);">
						<div class="form-group">
							<label for="role_access_rights">Role access rights:</label>
							<select class="role_access_rights form-control" id=role_access_rights_<?=$data['user_id']?> multiple>
							<?php
								if(isset($data['role_access_rights'])) {
							?>
								<?php
									foreach($data['role_access_rights'] as $key => $value) {
										?>
										  <option value="<?=$key?>"><?=$value?></option>
										<?php
									}
								?>
							<?php
								}
							?>
							</select>
							<label for="user_access_rights">User access rights:</label>
							<select class="user_access_rights form-control" name="user_access_rights[]" id="user_access_rights_<?=$data['user_id']?>" multiple>
							<?php
								if(isset($data['user_access_rights'])) {
							?>
								<?php
									foreach($data['user_access_rights'] as $key => $value) {
										?>
										  <option value="<?=$key?>"><?=$value?></option>
										<?php
									}
								?>
							<?php
								}
							?>
							</select>
							<input type="hidden" name="user_id" value="<?=$data['user_id']?>">
							<input type="hidden" id="type" value="multiple">
						</div>
						<input type="submit" name="submit" value="Submit" class="btn btn-default">
					</form>
					
					<?php
					}	
				} else {
					echo "No users found!";
				}
				?>
		</main>
		<footer>
			<p>Copyright © Emanuela Rus</p>
		</footer>
	</div>
</body>

</html>

