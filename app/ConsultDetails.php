<?php
	session_start();
	// si l'internaute accède à cette page sans être l'admin connecté alors
	// on le renvoie vers la page indexphp
	if (!isset($_SESSION['USER'])) {
		header('location: index.php');
		die();	
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="./include/styles.css" />
	<title>Mon site !</title>
</head>
<body>
	<?php 
		include("./include/header.php"); 
		include("./include/connect.inc.php");
	?>
	<div class="wrapper">
		<?php include("./include/menus.php"); ?>
		<section id="content">
		<form method="get" action="rechercheDetails.php">
  			<input type="text" name="search" placeholder="Rechercher...">
  			<button type="submit">Rechercher</button>
		</form>
		</section>
	</div>
	<?php include("./include/footer.php"); ?>
</body>
</html>