<?php

	$uri = 'http://' . $_SERVER['HTTP_HOST'];
	header('Location: '.$uri.'/Login.php');
	exit;
?>