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
            $emplacements = getAllEmplacements();
            if (!empty($emplacements)) {
                foreach ($emplacements as $emplacement) {
                   $listType = getTypeById($emplacement['idType']);
echo(gettype($sonType));
                    echo "
                                <tr>
                                    <td>" . $emplacement['Nom_Emplacement'] . "</td>
                                    <td>" . $listType['nomType']. "</td>
                                    <td>" . $emplacement['adresseEmpl'] . "</td>
                                    <td>" . $emplacement['anneeConstruction'] . "</td>
                                    <td>
                                       img ici
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
