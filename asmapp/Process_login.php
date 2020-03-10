<?php

require_once("Utilities.php");
if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['app']) && $_POST['username'] && $_POST['password'] && $_POST['app']) {
	$username = filter_var($_POST['username'], FILTER_VALIDATE_EMAIL);
	$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
	$app = filter_var($_POST['app'], FILTER_SANITIZE_STRING);

	$url = "http://asmapp_api.com/login";
	$parameters = array(
		'username' => $username,
		'password' => $password,
		'app' => $app
	);
	$response = Utilities::curlConnection($url, 'POST', $parameters);


	/* if login is successful user rights & session id are returned, 
			else errors are returned */
	Utilities::log($response);
	if(!isset($response['errors'])) {
		session_id($response['session_id']);
		session_start();
		$_SESSION['session_id'] = $response['session_id'];
		$_SESSION['session_name'] = uniqid('asmapp_');
		$_SESSION['user_rights'] = isset($response['user_rights'])?$response['user_rights']:array();
		$data['redirect'] = '/Home.php'; 
	} else {
		$data['error'] = implode('\n', $response['errors']);
	}
} else {
	$data['error'] = "Fields must not be empty!";
}
echo json_encode($data);
