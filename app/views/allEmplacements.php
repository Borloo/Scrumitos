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
                    <td>Type</td>
                    <td>Adresse</td>
                    <td>Année de construction</td>
                    <td>Aperçu</td>
                </tr>
                </thead>
                <tbody>
                <?php
                $emplacements = getAllEmplacements();
                $listimg = array(
                    "1" => "images/images/empl115.jpg",
                    "2" => "images/images/empl198.jpg",
                    "3" => "images/images/empl231.jpg",
                    "4" => "images/images/empl302.jpg",
                    "5" => "images/images/empl357.jpg",
                );
                $compteur = 1;
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
                                      <img src='../../$listimg[$compteur]'>
                                    </td>
                                </tr>";
                        $compteur += 1;
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
