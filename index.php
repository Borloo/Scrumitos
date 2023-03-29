<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');
?>
<!DOCTYPE html>
<html>
<head>
    <?php
        include("./app/include/headfile.php");
    ?>
</head>
<body>
	<?php
		include("./app/include/header.php");
	?>
	<div class="wrapper">
		<?php include("./app/include/menus.php"); ?>
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
	<?php include("./app/include/footer.php"); ?>
</body>
</html>
