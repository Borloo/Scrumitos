<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../include/styles.css"/>
    <title>Consulter les emplacements par prix</title>
</head>
<body>
<?php
include("../include/header.php");
include("./../include/headfile.php");
?>
<!--include("../include/connect.inc.php"); -->

<div class="wrapper">
    <?php include("../include/menus.php"); ?>
    <section id="content">
        <div class="card">
            <div class="card-body">
                <h1>Consulter les emplacements par prix</h1>;

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>Nom</td>
                        <td>Taille</td>
                        <td>Nombre de personnes max</td>
                        <td>Prix /semaine</td>
                    </tr>
                    </thead>
 <?php
                try {

                    $sql = "SELECT * FROM Emplacement order by Prix_Semaine desc";
                    $user = 'clmt';
                    $pass = '130702';
                    $conn = new PDO(
                        'mysql:host=localhost;dbname=base_camping;charset=UTF8'
                        ,
                        $user,
                        $pass,
                        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
                    );

                    $reqnews = $conn->prepare($sql);
                    $reqnews->execute();
                    $emplacements = $reqnews->fetchAll();

                    foreach ($emplacements as $emplacement) {
                        echo "<tr>";
                        echo "<td>", $emplacement['Nom_Emplacement'], "</td>";
                        echo "<td>", $emplacement['Taille'], "m2 </td>";
                        echo "<td>", $emplacement['Max_Personnes'], "</td>";
                        echo "<td>", $emplacement['Prix_Semaine'], "</td>";
                        echo "</tr>";

                    }
                    echo "</table>";
                    $reqnews->closeCursor();

                } catch (PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }

                ?>
            </div>
        </div>
    </section>
</div>

<?php include("../include/footer.php"); ?>

</body>
</html>

<style>
    /* #newsContent{
        width: 400px;
        height: 200px;
    } */
</style>


