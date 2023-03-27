<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="./include/styles.css" />
	<title>Mon site !</title>
</head>
<body>
	<?php 
		// Index.php
		session_start();
		include("./include/header.php"); 
	?>
	<div class="wrapper">
		<?php include("./include/menus.php"); ?>
		<section id="content">
		<?php
			echo "<p>Bienvenue sur le site !</p>";
		?>
		</section>
	</div>
	<?php include("./include/footer.php"); ?>
</body>
</html>
