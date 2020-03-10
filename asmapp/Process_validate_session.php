<?php
	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	}
	require_once("Utilities.php");
	if(isset($_SESSION['session_id'])) {
		$url = "http://asmapp_api.com/validate_session";
		$response = Utilities::curlConnection($url, 'POST', array('session_id' => $_SESSION['session_id']));
		if($response === FALSE) {
			$_SESSION['status'] = 'timeout';
		} else if(isset($response['errors'])) {
			$_SESSION['status'] = 'unauthorized';
		}
	}

