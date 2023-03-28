<?php
	session_start();
	require_once("./base/Functions.php");
	unset($_SESSION['USER']);
	// on aurait pu faire aussi : 	session_destroy();
	// on redirige vers la page index.php
	header('location: http://88.208.226.189/index.php');
	die();
?>
