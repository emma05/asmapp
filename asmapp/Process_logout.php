<?php

//$is_session_active = (session_status() == PHP_SESSION_ACTIVE);
//if(!$is_session_active) {
	session_start();
//}

if(isset($_SESSION['session_id'])) { 
	session_destroy();
	header('Location: /Login.php');
}
