<?php

include_once("Utilities.php");
if(isset($_POST['app_name'])) {
	$app = filter_var($_POST['app_name'], FILTER_SANITIZE_STRING);

	$url = "http://asmapp_api.com/add_app";
	$response = Utilities::curlConnection($url, 'POST', array('app' => $app));


	Utilities::log($response);
	if($response === TRUE) {
		$data['message'] = "App added."; 
	} else {
		if(is_array($response)) {
			$data['error'] = implode('\n', $response);
		}
	}
	echo json_encode($data);
} else {
	require_once("Access_denied.php");
}
