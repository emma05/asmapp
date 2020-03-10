<?php
require_once("Process_validate_session.php");
require_once("Utilities.php");

if(!isset($_SESSION['status'])) {
	if(isset($_POST['user_id']) && isset($_POST['user_access_rights']) && $_POST['user_id'] && $_POST['user_access_rights']) {
		$parameters = array();
		$parameters['user_id'] = filter_var($_POST['user_id'], FILTER_VALIDATE_INT);
		$parameters['user_access_rights'] = serialize($_POST['user_access_rights']);	

		$url = "http://asmapp_api.com/manage_user";
		$response = Utilities::curlConnection($url, 'POST', $parameters);

		Utilities::log($response);
		if($response === TRUE) {
			$data['message'] = "User access rights changed."; 
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