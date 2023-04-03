<?php
$emplacement_id = isset($_GET['emplacement_id']) ? $_GET['emplacement_id'] : '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <?php include("./../../include/headfile.php"); ?>
</head>
<body>
<?php include("./../../include/header.php"); ?>
<h1>Inscription d'un client</h1>
<?php
include("./../../include/menus.php");
?>
<form action="valider_inscription.php" method="post">
    <input type="hidden" name="emplacement_id" value="<?php echo $emplacement_id; ?>">
    <label for="nom">Nom:</label>
    <input type="text" id="nom" name="nom" required><br>
    <label for="prenom">Prénom:</label>
    <input type="text" id="prenom" name="prenom" required><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>
    <label for="telephone">Téléphone:</label>
    <input type="text" id="telephone" name="telephone" required><br>
    <input type="submit" value="Soumettre">
</form>
<?php include("./../../include/footer.php"); ?>
</body>
</html>
