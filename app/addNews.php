<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de news</title>
</head>
<body>
    <h1>Ajouter des news</h1>
    <form action="action.php" method="post">
        <p>Titre : <input type="text" name="newsName" /></p>
        <p>News : <input type="text" name="newsContains" /></p>
        <p><input type="submit" value="Envoyer"></p>
    </form>
</body>
</html>

<?php
    if($_POST) {
        echo 'Contenu de la variable $_POST : >';
        print_r($_POST);
    }

?>
