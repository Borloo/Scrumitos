<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');
?>
<!DOCTYPE html>
<html>
<head>
    <?php include("./../../include/headfile.php"); ?>
</head>
<body>
<?php include("./../../include/header.php"); ?>
<div class="wrapper">
    <?php include("./../../include/menus.php");?>
    <section id="content">
        <div class="card">
            <div class="card-header">
                <?php
                if (isset($_GET['msg'])){
                    switch ($_GET['msg']){
                        case 'updated':
                            echo "<p>News mise à jour !</p>";
                            break;
                        case 'created' :
                            echo "<p>News ajoutée !</p>";
                            break;
                        case 'deleted' :
                            echo "<p>News supprimée !</p>";
                            break;
                    }
                }
                echo "
                <div class='row'>
                    <h1>News du camping</h1>
                </div>";
                if(isset($_SESSION['USER'])) {
                    if ($_SESSION['USER']['isAdmin'] == 1) {
                        echo "
                    <div class='row'>
                        <div class='col-md-5'></div>
                        <div class='col-md-2'>
                            <a href='NewsDetail.php?id=-1&edit=1'><input class='btn btn-success' id='ajouter' type='button' value='Ajouter'></a></div>
                        <div class='col-md-5'></div>
                    </div>";
                    }
                }
                ?>
            </div>
            <div class="card-body">
                <?php

                require('./../base/HtmlFunctions.php');

                getHtmlListNews();

                ?>
            </div>
        </div>
    </section>
</div>
<?php include("../../include/footer.php"); ?>
</body>

</html>