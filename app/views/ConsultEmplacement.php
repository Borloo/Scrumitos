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
    </style>
</head>

<body>
    <?php
    include("./../../include/header.php");
    ?>
    <div class="wrapper">
        <?php include("./../../include/menus.php");
        ?>
        <section id="content">
            <div class="card">
                <div class="card-headear">
                    <h1>Recherche d'emplacements </h1>
                </div>
                <div class="card-body">
                    <a class="btn btn-secondary" href="ConsultType.php?suppr=0&add=0" role="button">Recherche emplacement par type</a>
                    <a class="btn btn-secondary" href="" role="button">Recherche emplacement par période</a>
                    <a class="btn btn-secondary" href="../ConsultEmplacementPrix.php" role="button">consulter emplacement année construction</a>
                    <a class="btn btn-secondary" href="../ConsultEmplacementPrix.php" role="button">Recherche emplacement prix</a>
                    <a class="btn btn-secondary" href="p" role="button">Recherche emplacement taille</a>

                </div>
            </div>
        </section>
    </div>
    <?php include("./../../include/footer.php"); ?>
</body>

</html>