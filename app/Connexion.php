<?php
    session_start();
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
        <section id="content">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <?php
                            require_once("./base/Functions.php");

                            if (empty($_SESSION['token'])) {
                                connection();
                            } else {
                                deconnection();
                            }
                            ?>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>