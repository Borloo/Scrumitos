<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');

require('./../base/HtmlFunctions.php');

if (isset($_GET['deletedLocId'])){
    removeLocation((int)$_GET['deletedLocId']);
    echo "
    <script>
        location.href='http://88.208.226.189/app/views/Compte.php?msg=cancelLocation'
    </script>";
    die();
}
?>
<!DOCTYPE html>
<html>
<head>
<?php include("./../../include/headfile.php"); ?>
</head>
<body>
<?php include("./../../include/header.php"); ?>
<div class="wrapper">
    <?php include("./../../include/menus.php"); ?>
    <section id="content">
        <h1>Mon compte <?php echo $_SESSION['USER']['login']?></h1>
        <div class="card">
            <div class="card-header">
                <h4>Mes informations</h4>
            </div>
            <div class="card-body">
                <?php inscription((int)$_SESSION['USER']['id']); ?>
            </div>
        </div>
        <?php
        $locations = getLocationsByUser((int)$_SESSION['USER']['id']);
        if (!empty($locations)){
            echo "
            <div class='card'>
                <div class='card-header'>
                    <h4>Mes locations</h4>
                </div>
                <div class='card-body'>
                    <table class='table'>
                        <tr><th scope='col'>Emplacement</th><th scope='col'>Date de début</th><th scope='col'>Date de fin</th><th scope='col'>Options</th><th scope='col'>Status</th><th></th></tr>";
            foreach ($locations as $location){
                $emplacement = getOneEmplacementById($location['idEmplacement']);
                $today = new DateTime('now', new DateTimeZone('Europe/Berlin'));
                $today = $today->format('Y-m-d H:i:s');
                $dateDeb = new DateTime($location['dateDeb']);
                $dateFin = new DateTime($location['dateFin']);
                $dateDeb = $dateDeb->format('Y-m-d H:i:s');
                $dateFin = $dateFin->format('Y-m-d H:i:s');
                if ($location['isValidated'] == 1){
                    if ($today >= $dateDeb && $today <= $dateFin){
                        $status = "En cours";
                    }elseif ($today <= $dateFin){
                        $status = "A venir";
                    }else{
                        $status = "Fini";
                    }
                }else{
                    $status = "En attente";
                }
                echo "
                <tr>
                    <th scope='row'>" . $emplacement['Nom_Emplacement'] . "</th>
                    <td>" . $dateDeb . "</td>
                    <td>" . $dateFin . "</td>
                    <td>" . $location['options'] . "</td>
                    <td>" . $status . "</td>
                    <td>";
                switch ($status){
                    case "En cours":
                        echo "<input class='btn btn-success' type='button' name='enCours' value='En cours'>";
                        break;
                    case "Fini":
                        echo "<a href='addAvis.php?id=" . $location['id'] . "'><input class='btn btn-info' type='button' name='avis' value='Avis'></a>";
                        break;
                    case "A venir":
                        echo "<a href='Compte.php?deletedLocId=" . $location['id'] . "'<input class='btn btn-info' type='button' name='cancel'>Annuler</a>";
                        break;
                    default:
                        echo "<a href='Compte.php?deletedLocId=" . $location['id'] . "'<input class='btn btn-danger' type='button' name='cancel'>Annuler</a>";
                        break;
                }
                    echo "</td>
                </tr>
                ";
            }
                    echo "</table>
                </div>
            </div>
            ";
        }
        ?>
    </section>
</div>
<?php include("./../../include/footer.php"); ?>
</body>
</html>
