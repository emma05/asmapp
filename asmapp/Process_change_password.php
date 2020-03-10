<?php
require_once("Process_validate_session.php");
require_once("Utilities.php");

if(!isset($_SESSION['status'])) {
	if(isset($_POST['password']) && $_POST['password']) {
		$parameters = array();
		if(isset($_POST['user_id'])) {
			$parameters['user_id'] = filter_var($_POST['user_id'], FILTER_VALIDATE_INT);
		} else {
			$parameters['session_id'] = filter_var($_POST['session_id'], FILTER_SANITIZE_STRING);
		}
		$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
		$parameters['password'] = password_hash($password, PASSWORD_DEFAULT);
		$url = "http://asmapp_api.com/edit_user";
		$response = Utilities::curlConnection($url, 'POST', $parameters);

		if($response === TRUE) {
			$data['message'] = "Password changed."; 
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
} else {
	if($_SESSION['status'] == "timeout") {
		$data['redirect'] = '/Process_logout.php';
	} 
	if($_SESSION['status'] == "unauthorized") {
		$data['redirect'] = '/Unauthorized.php';
	} 
}
echo json_encode($data);