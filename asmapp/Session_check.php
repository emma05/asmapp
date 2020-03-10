<?php
	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	}
	if(!isset($_SESSION['session_id'])) { 
		header('Location: /Login.php');
		exit;
	}