<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de news</title>
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
            <h1>Ajouter des news TEST</h1>
            <form action="addNews.php" method="post">
                <p>Titre : <input type="text" name="newsName" autocomplete="off"/></p>
                <p>News : <input type="text" name="newsContent" autocomplete="off" /></p>
                <p><input type="submit" value="Envoyer"></p>
            </form>

            <?php 
            if($_POST) {
            ?> 
                Le titre de la news est:  <?php echo htmlspecialchars($_POST['newsName']); ?>.
                Son contenu est <?php echo $_POST['newsContent']; 
            }?> 



		</section>
	</div>

	<?php include("./include/footer.php"); ?>
    
</body>
</html>


