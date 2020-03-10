<?php

function checkUserRight($session, $check_right) {
	if(!isset($session['user_rights'])  || !$session['user_rights'] || !in_array($check_right, $session['user_rights'])) {
		header('Location: /Access_denied.php');
		exit;
	}
}

?>