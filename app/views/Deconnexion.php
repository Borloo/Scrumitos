<?php
	session_start();
	unset($_SESSION['USER']);
	header('location: http://88.208.226.189/index.php');
	die();
?>
