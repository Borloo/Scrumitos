<?php
$emplacement_id = isset($_GET['emplacement_id']) ? $_GET['emplacement_id'] : '';
error_reporting(E_ALL);
ini_set('display_errors', 'on');

include("../base/HtmlFunctions.php");
?>

<!DOCTYPE html>
<html>
<head>
    <?php include("./../../include/headfile.php"); ?>
    <title>Inscription</title>

</head>
<body>
<?php include("./../../include/header.php"); ?>
<h1>Inscription d'un client</h1>
<?php
include("./../../include/menus.php");
?>
<form method="post">
    <input type="hidden" name="emplacement_id" value="<?php echo $emplacement_id; ?>">
    <label for="username">Nom:</label>
    <input type="text" id="username" name="username" required><br>
    <label for="adresse">Adresse:</label>
    <input type="adresse" id="adresse" name="adresse" required><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>
    <label for="password">Mot de passe</label>
    <input type="password" id="password" name="password" required><br>
    <label for="telephone">Téléphone:</label>
    <input type="text" id="telephone" name="telephone" required><br>
    <input class='btn btn-success' type="submit" role="button" name='submit' value="S'inscrire"/>

</form>
<?php
if (isset($_POST['submit'])){
echo "Formulaire soumis";


registerUser($_POST['username'], $_POST['password'], $_POST['adresse'], $_POST['email'], $_POST['telephone']);


}

?>
<?php include("./../../include/footer.php"); ?>
</body>
</html>


