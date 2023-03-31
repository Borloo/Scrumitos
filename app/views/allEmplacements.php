<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');
include("./../../include/headfile.php");
require('./../base/HtmlFunctions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <?php include("./../../include/headfile.php"); ?>
</head>
<body>
<?php include("./../../include/header.php"); ?>
<div class="wrapper">
    <?php
    include("./../../include/menus.php");
    ?>
    <section id="content">
        <div class="card">
            <div class="card-header">
                <h1>Nos emplacements :</h1>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>Nom</td>
                    <td>Taille</td>
                    <td>Nombre de personnes max</td>
                    <td>Prix /semaine</td>
                </tr>
                </thead>
                <tbody>
                <?php
                $emplacements = getAllEmplacements();
                if (!empty($emplacements)) {
                    foreach ($emplacements as $emplacement) {
                        $listType = getTypeById($emplacement['idType']);
                        echo "
                                <tr>
                                    <td>" . $emplacement['Nom_Emplacement'] . "</td>
                                    <td>" . $listType['nomType'] . "</td>
                                    <td>" . $emplacement['adresseEmpl'] . "</td>
                                    <td>" . $emplacement['anneeConstruction'] . "</td>
                                    <td>
                                       img ici
                                    </td>
                                </tr>";
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
<?php include("./../../include/footer.php"); ?>
</body>
</html>
