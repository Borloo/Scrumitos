<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require('./../base/HtmlFunctions.php');
$user = getUserById((int)$_GET['id']);
?>
<!DOCTYPE html>
<html>
<head>
    <?php include("./../../include/headfile.php"); ?>
</head>
<body>
    <?php include("./../../include/header.php"); ?>
    <div class="wrapper">
        <?php include("./../../include/menus.php"); ?>
        <section id="content">
            <div class="card">
                <?php
                if (isset($_GET['id'])){
                    inscription();
                }else{
                    echo "<p>Utilisateur inconnu</p>";
                }
                ?>
            </div>
        </section>
    </div>
    <?php include("./../../include/footer.php"); ?>
</body>
</html>
