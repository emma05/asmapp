<?php

include_once("Utilities.php");
if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['app']) && isset($_POST['role'])) {
	$username = filter_var($_POST['username'], FILTER_VALIDATE_EMAIL);
	$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
	$app = filter_var($_POST['app'], FILTER_SANITIZE_STRING);
	$role = filter_var($_POST['role'], FILTER_SANITIZE_STRING);

	$url = "http://asmapp_api.com/add_user";
	$response = Utilities::curlConnection($url, 'POST', array('username' => $username, 'password' => $password, 'app' => $app, 'role' => $role));


	Utilities::log($response);
	if($response === TRUE) {
		$data['message'] = "User added."; 
	} else {
		if(is_array($response)) {
			$data['error'] = implode('\n', $response);
		}
	}
	echo json_encode($data);
} else {
	require_once("Access_denied.php");
}
