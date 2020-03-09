<?php
require_once("Session_check.php");

include_once("Utilities.php");
if(isset($_POST['password'])) {
	$user_id = filter_var($_POST['user_id'], FILTER_VALIDATE_INT);
	$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

	$url = "http://asmapp_api.com/edit_user";
	$response = Utilities::curlConnection($url, 'POST', array('user_id' => $user_id, 'password' => $password));

	Utilities::log($response);
	if($response === TRUE) {
		$data['message'] = "Password changed."; 
	} else {
		if(is_array($response)) {
			$data['error'] = implode('\n', $response);
		}
	}
	echo json_encode($data);
} else {
	require_once("Access_denied.php");
}