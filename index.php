<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <?php
        include("./include/headfile.php");
    ?>
</head>
<body>
	<?php
		include("./include/header.php");
	?>
	<div class="wrapper">
		<?php include("./include/menus.php"); ?>
		<section id="content">
            <div class="card">
                <div class="card-body">
                    <?php
                        if (isset($_SESSION['USER'])){
                            echo "<p>Bonjour " . $_SESSION['USER'] . " ! Et bienvenue à la Grande Bleue le meilleur camping de France</p>";
                        }else{
                            echo "<p>Bonjour, vous pouvez vous connecter ou vous inscrire via le menu !</p>";
                        }
                    ?>
                </div>
            </div>
		</section>
	</div>
	<?php include("./include/footer.php"); ?>
</body>
</html>
