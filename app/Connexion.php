<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');
?>

<!DOCTYPE html>
<html>

<head>
    <?php
    include("./../include/headfile.php");
    ?>
</head>

<body>
    <?php
    include("./../include/header.php");
    ?>
    <div class="wrapper">
        <?php include("./../include/menus.php"); ?>
        <section id="content">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">

                        <div class="col-md-4">
                            <?php
                            require_once("./base/Functions.php");

                            if (empty($_SESSION['token'])) {
                                connection();
                            }
                            ?>

                        <div class="col-md-4"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php include("./../include/footer.php"); ?>
</body>

</html>