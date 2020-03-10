<?php
require_once("Process_validate_session.php");
require_once("Utilities.php");

if(!isset($_SESSION['status'])) {
	if(isset($_POST['access_right_name']) && $_POST['access_right_name'] && isset($_POST['role']) && $_POST['role']) {
		$access_right = filter_var($_POST['access_right_name'], FILTER_SANITIZE_STRING);
		$role_id = filter_var($_POST['role'], FILTER_VALIDATE_INT);
		$url = "http://asmapp_api.com/add_access_right";
		$parameters = array(
			'access_right' => $access_right,
			'role_id' => $role_id,
		);
		$response = Utilities::curlConnection($url, 'POST', $parameters);
		Utilities::log($response);
		if($response === TRUE) {
			$data['message'] = "Access right added."; 
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
