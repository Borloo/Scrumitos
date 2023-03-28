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
		// Index.php
		session_start();
		include("./include/header.php"); 
	?>
	<div class="wrapper">
		<?php include("./include/menus.php"); ?>
		<section id="content">
            <div class="card">
                <div class="card-body">
                    <?php
                        if (isset($_SESSION['ADMIN'])){
                            echo "<p>" . $_SESSION['ADMIN'] . "</p>";
                        }else{
                            echo "<p>oui</p>";
                        }
                    ?>
                </div>
            </div>
		</section>
	</div>
	<?php include("./include/footer.php"); ?>
</body>
</html>
