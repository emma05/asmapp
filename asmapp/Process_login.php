<?php

include_once("Utilities.php");
if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['app'])) {
	$username = filter_var($_POST['username'], FILTER_VALIDATE_EMAIL);
	$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
	$app = filter_var($_POST['app'], FILTER_SANITIZE_STRING);

	$url = "http://asmapp_api.com/login";
	//'username' => $username, 'password' => $password,
	$headers = array(
		'Authorization: Basic ' . base64_encode($username . ":" . $password),
	);
	$response = Utilities::curlConnection($url, 'POST', array('app' => $app), $headers);


	/* if login is successful user rights & session id are returned, 
			else errors are returned */
	if(!isset($response['errors'])) {
		session_id($response['session_id']);
		session_start();
		Utilities::log($response);
		$_SESSION['user_id'] = $response['user_id'];
		$_SESSION['session_id'] = $response['session_id'];
		$_SESSION['user_rights'] = isset($response['user_rights'])?$response['user_rights']:array();
		$data['redirect'] = '/Home.php'; 
	} else {
		$data['error'] = implode('\n', $response['errors']);

	}
	echo json_encode($data);
} else {
	require_once("Access_denied.php");
}
