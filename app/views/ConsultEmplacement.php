<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');
?>
<!DOCTYPE html>
<html>
<head>
    <?php include("./../../include/headfile.php"); ?>
    <style>
        td {
            text-align: center;
            padding: 5px;
        }

        th {
            padding: 5px 20px 5px 20px;
        }

        table {
            border: 1px solid black;
        }
        .btn {
            width: 100%;
        }
    </style>
</head>

<body>
    <?php include("./../../include/header.php"); ?>
    <div class="wrapper">
        <?php include("./../../include/menus.php"); ?>
        <section id="content">
            <div class="card">
                <div class="card-headear">
                    <h1>Recherche d'emplacements par :</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class='col-md-2'></div>
                        <div class='col-md-3'>
                            <a class="btn btn-secondary" href="ConsultType.php?suppr=0&add=0" role="button">Type</a>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-3">
                            <a class="btn btn-secondary" href="" role="button">Période</a>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <div class="row">
                        <div class='col-md-2'></div>
                        <div class='col-md-3'>
                            <a class="btn btn-secondary" href="../ConsultEmplacementPrix.php" role="button">Année de construction</a>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-3">
                            <a class="btn btn-secondary" href="../ConsultEmplacementPrix.php" role="button">Prix</a>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-5"></div>
                        <div class="col-md-2">
                            <a class="btn btn-secondary" href="#" role="button">Taille</a>
                        </div>
                        <div class="col-md-5"></div>
                    </div>

                </div>
            </div>
        </section>
    </div>
    <?php include("./../../include/footer.php"); ?>
</body>
</html>