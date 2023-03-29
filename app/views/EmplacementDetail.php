<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 'on');
    if (!isset($_SESSION['USER'])) {
        header('location: index.php');
        die();
    }
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
                        require('./../base/Functions.php');
                        
                        $emplacement = getOneEmplacementById((int)$_GET['id']);
                        print_r($emplacement);
                    ?>
                </div>
            </section>
        </div>
        <?php include("./../../include/footer.php"); ?>
    </body>
</html>
