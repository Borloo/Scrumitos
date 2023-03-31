<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');
include("./../../include/headfile.php");
require('./../base/HtmlFunctions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <?php include("./../../include/headfile.php"); ?>
</head>
<body>
<?php include("./../../include/header.php"); ?>
<div class="wrapper">
    <?php
    include("./../../include/menus.php");
    getAllEmplacements();
    ?>
</div>
<?php include("./../../include/footer.php"); ?>
</body>
</html>
