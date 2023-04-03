<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');

require('./../base/HtmlFunctions.php');
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

        select {
            width: 100%;
        }

        .btn {
            width: 100%;
        }

        .row {
            margin: 2%;
        }

        .card {
            margin-bottom: 2%;
        }
    </style>
</head>

<body>
<?php include("./../../include/header.php"); ?>
<div class="wrapper">
    <?php include("./../../include/menus.php"); ?>
    <section id="content">
        <div class="card">
            <div class="card-header">
                <h1>Recherche d'emplacements par :</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class='col-md-3'></div>
                    <div class='col-md-2'>
                        <a class="btn btn-secondary" href="ConsultEmplacement.php?c=1" role="button">Type</a>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <a class="btn btn-secondary" href="ConsultEmplacement.php?c=2" role="button">Période</a>
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row">
                    <div class='col-md-3'></div>
                    <div class='col-md-2'>
                        <a class="btn btn-secondary" href="ConsultEmplacement.php?c=3" role="button">Année</a>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <a class="btn btn-secondary" href="ConsultEmplacement.php?c=4" role="button">Prix</a>
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row">
                    <div class="col-md-5"></div>
                    <div class="col-md-2">
                        <a class="btn btn-secondary" href="ConsultEmplacement.php?c=5" role="button">Taille</a>
                    </div>
                    <div class="col-md-5"></div>
                </div>

            </div>
        </div>
        <?php

        switch ($_GET['c']) {
            case "1":
                getHtmlType();
                break;
            case "2":
                getHtmlPeriode();
                break;
            case "3":
                getHtmlAnnee();
                break;
            case "4":
                getHtmlPrix();
                break;
            case "5":
                getHtmlTaille();
                break;
        }
        ?>
    </section>
</div>
<?php include("./../../include/footer.php"); ?>
</body>
</html>