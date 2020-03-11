<?php
require_once("Process_validate_session.php");
require_once("Utilities.php");

if(!isset($_SESSION['status'])) {
	if(isset($_POST['role_name']) && isset($_POST['app']) && $_POST['role_name'] && $_POST['app']) {
		$role = filter_var(trim($_POST['role_name']), FILTER_SANITIZE_STRING);
		$app_id = filter_var($_POST['app'], FILTER_VALIDATE_INT);
		$url = "http://asmapp_api.com/add_role";
		$parameters = array(
			'role' => $role, 
			'app_id' => $app_id,
		);
		$response = Utilities::curlConnection($url, 'POST', $parameters);

		Utilities::log($response);
		if($response === TRUE) {
			$data['message'] = "Role added."; 
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
