<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="../include/styles.css" />
	<title>Mon site !</title>
</head>
<body>
	<?php 
		session_start();
		include("../include/header.php"); 
	?>
	<div class="wrapper">
		<?php include("../include/menus.php"); ?>
		
	<?php include("../include/footer.php"); ?>
</body>
</html>