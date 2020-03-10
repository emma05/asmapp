<?php

if (session_status() == PHP_SESSION_NONE) {
	    session_start();
}

if(isset($_SESSION['session_id'])) { 
	session_destroy();
	header('Location: /Login.php');
}
