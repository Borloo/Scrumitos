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
    </style>
</head>

<body>
<?php include("./../../include/header.php"); ?>
<div class="wrapper">
    <?php include("./../../include/menus.php"); ?>
    <section id="content">
            <?php
            if (isset($_GET['id'])){
                $location = getLocationById($_GET['id']);
                $emplacement = getOneEmplacementById($location['idEmplacement']);
                echo "
                <form method='post'>
                    <div class='card'>
                        <div class='card-header'>
                            <h1>Avis de <em>" . $emplacement['Nom_Emplacement'] . "</em></h1>
                        </div>
                        <div class='card-body'>
                            <div class='row'>
                                <div class='col-md-2'></div>
                                <div class='col-md-8'>
                                    <textarea class='form-control' rows='3' name='avis' placeholder='Votres avis nous intéresse' required></textarea>
                                </div>
                                <div class='col-md-2'></div>
                            </div>
                            <div class='row'>
                                <div class='col-md-5'></div>
                                <div class='col-md-2'>
                                    <input class='btn btn-success' name='submit' type='submit' value='Enregistrer'>
                                </div>
                                <div class='col-md-5'></div>
                            </div>
                        </div>
                    </div>
                </form>
                ";
                if (isset($_POST['submit'])){
                    if (isset($_POST['avis'])){
                        addAvis($_GET['id'], $_POST['avis']);
                        echo "<script>
                                location.href='http://88.208.226.189/app/views/Compte.php?msg=addAvis'
                            </script>";
                        die();
                    }
                }
            }
            ?>
    </section>
</div>
</body>
<?php include("./../../include/footer.php"); ?>
</html>