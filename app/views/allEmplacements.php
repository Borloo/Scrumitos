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
            <?php
            getAllEmplacements();
            $emplacements = getAllEmplacements();
            if (!empty($emplacements)) {
                foreach ($emplacements as $emplacement) {
                    echo "
                                <tr>
                                    <td>" . $emplacement['Nom_Emplacement'] . "</td>
                                    <td>" . $emplacement . "</td>
                                    <td>" . $emplacement['adresseEmpl'] . "</td>
                                    <td>" . $emplacement['anneeConstruction'] . "</td>
                                    <td>
                                        <div class='row' id='actions'>
                                            <div class='col-md-4'>
                                                <a href='./EmplacementDetail.php?maj=0&id=" . $emplacement['idEmpl'] . "&edit=1'><input type='button' class='btn btn-warning' value='Modifier'></a>
                                            </div>
                                            <div class='col-md-4'>
                                                <a href='./EmplacementDetail.php?maj=0&id=" . $emplacement['idEmpl'] . "&edit=0'><input type='button' class='btn btn-info' value='Prévisualiser'></a>
                                            </div>
                                            <div class='col-md-4'>
                                                <a href='./EmplacementDetail.php?maj=0&id=" . $emplacement['idEmpl'] . "&edit=3'><input type='button' class='btn btn-danger' value='Supprimer'></a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>";
                }
            }
            ?>
        </div>
    </section>
</div>
<?php include("./../../include/footer.php"); ?>
</body>
</html>
