<?php
	session_start();
	require_once("Utilities.php");

	if(isset($_SESSION['session_id'])) {
		$url = "http://asmapp_api.com/validate_session";
		$response = Utilities::curlConnection($url, 'POST', array('session_id' => $_SESSION['session_id']));
		Utilities::log("session_check");;
		Utilities::log($response);
		if($response === FALSE) {
			//require_once("Process_logout.php");
			header('Location: /Process_logout.php');
		}
	} else {
		require_once("Access_denied.php");
	}

