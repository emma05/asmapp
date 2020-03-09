<?php

function checkUserRight($session, $check_right) {
	//var_dump($session);
	//var_dump($check_right);
	if(!isset($session['user_rights'])  || !$session['user_rights'] || !in_array($check_right, $session['user_rights'])) {
		require_once("Access_denied.php");
	}
}

?>