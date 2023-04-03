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
</head>
<body>
<?php include("./../../include/header.php"); ?>
<div class="wrapper">
    <?php include("./../../include/menus.php"); ?>
    <section id="content">
        <h1>Mon compte <?php echo $_SESSION['USER']['login']?></h1>
        <?php
        $locations = getLocationsByUser((int)$_SESSION['USER']['id']);
        if (!empty($locations)){
            echo "
            <form method='post'>
                <div class='card'>
                    <div class='card-header'>
                        <h4>Mes locations</h4>
                    </div>
                    <div class='card-body'>
                        <table class='table'>
                            <tr><th scope='col'>Emplacement</th><th scope='col'>Date de début</th><th scope='col'>Date de fin</th><th scope='col'>Options</th><th scope='col'>Status</th><th></th></tr>";
                foreach ($locations as $location){
                    if ($location['isValidated'] == 1){
                        $status = "Validée";
                    }else{
                        $status = "En attente";
                    }
                    $dateDeb = new DateTime($location['dateDeb']);
                    $dateFin = new DateTime($location['dateFin']);
                    $emplacement = getOneEmplacementById($location['idEmplacement']);
                    echo "
                    <input type='hidden'name='id' value='" . $location['id'] . "'>
                    <tr>
                        <th scope='row'>" . $emplacement['Nom_Emplacement'] . "</th>
                        <td>" . $dateDeb->format('Y-m-d H:i:s') . "</td>
                        <td>" . $dateFin->format('Y-m-d H:i:s') . "</td>
                        <td>" . $location['options'] . "</td>
                        <td>" . $status . "</td>
                        <td>";
                    if ($location['isValidated'] == 1){
                        echo "<a href='#'><input class='btn btn-info' type='button' name='avis' value='Avis'></a>";
                    }else{
                        echo "<input class='btn btn-danger' type='submit' name='submit' value='Annuler'>";
                    }
                        echo "</td>
                    </tr>
                    ";
                }
                        echo "</table>
                    </div>
                </div>
            </form>
            ";
            if (isset($_POST['submit'])){
                print_r($_POST['submit']);
                removeLocation((int)$_POST['id']);
//                echo "
//                <script>
//                    location.href='http://88.208.226.189/app/views/Compte.php?msg=cancelLocation'
//                </script>";
//                die();
            }
        }
        ?>
    </section>
</div>
<?php include("./../../include/footer.php"); ?>
</body>
</html>
