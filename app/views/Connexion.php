<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');
?>

<!DOCTYPE html>
<html>

<head>
    <?php
    include("./../../include/headfile.php");
    ?>
</head>

<body>
    <?php
    include("./../../include/header.php");
    ?>
    <div class="wrapper">
        <?php include("./../../include/menus.php"); ?>
        <section id="content">
            <div class="row justify-content-center">

                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <?php
                    require_once("./../base/HtmlFunctions.php");

                    if (empty($_SESSION['token'])) {
                        if (isset($_GET['conn'])){
                            if ($_GET['conn'] == 1){
                                connection();
                            }else{
                                inscription();
                            }
                        }
                    }
                    ?>
                </div>
                <div class="col-md-3"></div>
            </div>
        </section>
    </div>
    <?php include("./../../include/footer.php"); ?>
</body>

</html>