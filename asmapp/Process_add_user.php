<?php
require_once("Validate_session.php");
require_once("Utilities.php");
if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['app']) && isset($_POST['role'])) {

	$username = filter_var(trim($_POST['username']), FILTER_VALIDATE_EMAIL);
	$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
	$app = filter_var($_POST['app'], FILTER_VALIDATE_INT);
	$role = filter_var($_POST['role'], FILTER_VALIDATE_INT);

	$url = "http://asmapp_api.com/add_user";
	$parameters = array(
		'username' => $username, 
		'password' => password_hash($password, PASSWORD_DEFAULT), 
		'app' => $app, 
		'role' => $role
	);
	$response = Utilities::curlConnection($url, 'POST', $parameters);
	
	Utilities::log($response);
	if($response === TRUE) {
		$data['message'] = "User added."; 
	} else {
		if(is_array($response)) {
			$data['error'] = implode('\n', $response);
		} else {
			$data['error'] = "Something went wrong!";
		}
	}
} else {
	$data['error'] = "Fields must not be empty!";
}
echo json_encode($data);
