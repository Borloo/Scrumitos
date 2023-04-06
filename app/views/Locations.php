<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');

if (isset($_GET['user'])){
    if ($_GET['user'] == '-1'){
        echo "
        <script>
            location.href='Connexion.php?conn=0'
        </script>";
        die();
    }
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
    <?php include("./../../include/menus.php");?>
    <section id="content">
        <div class="card">
            <div class="card-header">
                <?php
                if (isset($_GET['msg'])){
                    if ($_GET['msg'] == 'validated') {
                        echo 'Location validée !';
                    }
                }
                if (isset($_GET['new'])){
                    switch ($_GET['new']){
                        case '0':
                            echo "<h1>Locations en attente de validation</h1>";
                            break;
                        case '1':
                            echo "<h1>Demande de location</h1>";
                            break;
                    }
                }
                ?>
            </div>
            <div class="card-body">
                <?php
                require('./../base/HtmlFunctions.php');
                if (isset($_GET['new'])){
                    switch ($_GET['new']){
                        case '0':
                            getHtmlLocationsValidation();
                            break;
                        case '1':
                            getHtmlNewLocation();
                            break;
                    }
                }else{
                    getHtmlLocationsValidation();
                }

                ?>
            </div>
        </div>
    </section>
</div>
<?php include("../../include/footer.php"); ?>
</body>

</html>
