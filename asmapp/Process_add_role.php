<?php

include_once("Utilities.php");
if(isset($_POST['role_name']) && isset($_POST['app'])) {
	$role = filter_var($_POST['role_name'], FILTER_SANITIZE_STRING);
	$app_id = filter_var($_POST['app'], FILTER_VALIDATE_INT);
	Utilities::log($role);
	Utilities::log($app_id);
	$url = "http://asmapp_api.com/add_role";
	$response = Utilities::curlConnection($url, 'POST', array('role' => $role, 'app_id' => $app_id));


	Utilities::log($response);
	if($response === TRUE) {
		$data['message'] = "Role added."; 
	} else {
		if(is_array($response)) {
			$data['error'] = implode('\n', $response);
		}
	}
	echo json_encode($data);
} else {
	require_once("Access_denied.php");
}
