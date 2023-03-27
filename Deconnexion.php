<?php
	session_start();
	unset($_SESSION['AdminConnecte']);
	// on aurait pu faire aussi : 	session_destroy();
	// on redirige vers la page index.php
	header('location:index.php');
?>
