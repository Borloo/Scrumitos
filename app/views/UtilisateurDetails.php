<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require('./../base/HtmlFunctions.php');
$id = $_GET['id'];
if (isset($_GET['del'])){
    if ($_GET['del'] == "1"){
        deleteUser((int)$id);
        echo "<script>
                location.href='http://88.208.226.189/app/views/Utilisateurs.php?msg=del'
            </script>";
        die();
    }
}
$user = getUserById((int)$id);
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
                    if ($_GET['id'] == '-1'){
                        inscription();
                    }else{
                        inscription((int)$_GET['id'], false);
                    }
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
