<?php
require_once("Process_validate_session.php");
require_once("Utilities.php");

if(!isset($_SESSION['status'])) {
	if(isset($_POST['app_name']) && $_POST['app_name']) {
		$app = filter_var($_POST['app_name'], FILTER_SANITIZE_STRING);
		$url = "http://asmapp_api.com/add_app";
		$parameters = array(
			'app' => $app,
		);
		$response = Utilities::curlConnection($url, 'POST', $parameters);
		Utilities::log($response);
		if($response === TRUE) {
			$data['message'] = "App added."; 
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
