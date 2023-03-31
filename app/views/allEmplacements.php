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
                $listimg = array("1" => "images/images/empl115.jpg");
                $compteur = 1;
                if (!empty($emplacements)) {
                    foreach ($emplacements as $emplacement) {
                        $listType = getTypeById($emplacement['idType']);
                        ?>
                                <tr>
                                    <td><?php  $emplacement['Nom_Emplacement'] ?></td>
                                    <td><?php $listType['nomType'] ?></td>
                                    <td><?php $emplacement['adresseEmpl'] ?></td>
                                    <td><?php $emplacement['anneeConstruction'] ?></td>
                                    <td>
                                      <img src="../../<?php $listimg[$compteur]?>">
                                    </td>
                                </tr>
                <?php
                        $compteur+= $compteur;
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
