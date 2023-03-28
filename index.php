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
		<section id="content" style="height: 100%">
            <div class="card">
                <div class="card-body">
                    <?php
                        if (isset($_SESSION['USER'])){
                            echo "<p>Bonjour " . $_SESSION['USER'] . " !</p>";
                        }else{
                            echo "<p>Bonjour</p>";
                        }
                    ?>
                </div>
            </div>
		</section>
	</div>
	<?php include("./include/footer.php"); ?>
</body>
</html>
