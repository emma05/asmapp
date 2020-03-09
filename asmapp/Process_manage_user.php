<?php

include_once("Utilities.php");
if(isset($_POST['user_id'])) {
	$data = array();
	$data['user_id'] = filter_var($_POST['user_id'], FILTER_VALIDATE_INT);
	if(isset($_POST['user_access_rights'])) {
		$data['user_access_rights'] = serialize($_POST['user_access_rights']);	
	}


	$url = "http://asmapp_api.com/manage_user";
	$response = Utilities::curlConnection($url, 'POST', $data);

	Utilities::log($response);
	if($response === TRUE) {
		$data['message'] = "User access rights changed."; 
	} else {
		if(is_array($response)) {
			$data['error'] = implode('\n', $response);
		}
	}
	echo json_encode($data);
} else {
	require_once("Access_denied.php");
}