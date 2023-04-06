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

        }
    </style>
</head>

<body>
<?php include("./../../include/header.php"); ?>
<div class="wrapper">
    <?php include("./../../include/menus.php"); ?>
    <section id="content">
        <div class="card" style="margin-bottom: 2%">
            <div class="card-header">
                <h1>Recherche d'emplacements par :</h1>
            </div>
            <div class="card-body">
                <div class="row" style="margin: 2%;">
                    <div class='col-md-3'></div>
                    <div class='col-md-2'>
                        <a class="btn btn-secondary" href="ConsultEmplacement.php?c=1" role="button" style="width: 100%;">Type</a>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <a class="btn btn-secondary" href="ConsultEmplacement.php?c=2" role="button" style="width: 100%;">Période</a>
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row" style="margin: 2%;">
                    <div class='col-md-3'></div>
                    <div class='col-md-2'>
                        <a class="btn btn-secondary" href="ConsultEmplacement.php?c=3" role="button" style="width: 100%;">Année</a>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <a class="btn btn-secondary" href="ConsultEmplacement.php?c=4" role="button" style="width: 100%;">Prix</a>
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row" style="margin: 2%;">
                    <div class="col-md-5"></div>
                    <div class="col-md-2">
                        <a class="btn btn-secondary" href="ConsultEmplacement.php?c=5" role="button" style="width: 100%;">Taille</a>
                    </div>
                    <div class="col-md-5"></div>
                </div>

            </div>
        </div>
        <?php
        if (isset($_GET['c'])) {
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
        } else {
            echo "
            <div class='card'>
                <div class='card-header'>
                    <h4>Tous les emplacements</h4>
                </div>
                <div class='card-body'>";
            $emplacements = getAllEmplacements();
            if (!empty($emplacements)) {
                echo "
                    <table class='table'>
                        <tr><th scope='col'>Nom</th><th scope='col'>Type</th><th scope='col'>Adresse</th><th scope='col'>Prix par semaine</th><th scope='col'>Aperçu</th>";
                if (isset($_SESSION['USER'])) {
                    if ($_SESSION['USER']['isAdmin']) {
                        echo"<th scope='col'>Actions</th></tr>";

                    }
                }
                getHtmlEmplacementTable($emplacements);
                echo "</table>";
            } else {
                echo "<p>Aucun emplacements</p>";
            }
            echo "</div>
                    </div>
                    ";
        }
        ?>
    </section>
</div>
<?php include("./../../include/footer.php"); ?>
</body>
</html>