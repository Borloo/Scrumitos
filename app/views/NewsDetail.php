<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');
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

        .btn {
            width: 100%;
        }

        .row {
            margin: 2%;
        }

        .card {
            margin-bottom: 2%;
            height: 100%;
        }
    </style>
</head>

<body>
<?php include("./../../include/header.php"); ?>
    <div class="wrapper">
        <?php include("./../../include/menus.php");?>
        <section id="content">
            <div class="card">
                <form>
                    <fieldset>
                        <?php

                        require('./../base/Functions.php');

                        if (isset($_GET['id'])){
                            switch ($_GET['edit']){
                                case "0":
                                    $valueButton = "Retour";
                                    break;
                                case "1":
                                    $valueButton = "Sauvegarder";
                                    break;
                                default:
                                    $valueButton = "";
                                    break;
                            }
                            $new = getNewById((int)$_GET['id']);
                            echo "
                            <div class='card-header'>
                                <h4>" . $new['titre'] . "</h4>
                            </div>
                            <div class='card-body'>
                                <div class='row'>
                                    <div class='col-md-4'>
                                        <div class='input-group mb-3'>
                                            <span class='input-group-text' id='basic-addon1'>Titre</span>
                                            <input class='form-control' name='titre' type='text' value='" . $new['titre'] . "'";
                                            if ($_GET['edit'] == 0){
                                                echo "readonly";
                                            }
                                            echo ">
                                        </div>
                                    </div>
                                    <div class='col-md-4'>
                                        <div class='input-group mb-3'>
                                            <span class='input-group-text' id='basic-addon1'>Contenu</span>
                                            <input class='form-control' name='body' type='text' value='" . $new['body'] . "'";
                                            if ($_GET['edit'] == 0){
                                                echo "readonly";
                                            }
                                            echo ">
                                        </div>
                                    </div>
                                    <div class='col-md-4'>
                                        <div class='input-group mb-3'>
                                            <span class='input-group-text' id='basic-addon1'>Date</span>
                                            <input class='form-control' name='date' type='date' value='" . $new['date'] . "'";
                                            if ($_GET['edit'] == 0){
                                                echo "readonly";
                                            }
                                            echo ">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='card-footer'>
                                <div class='row'>
                                    <div class='col-md-5'></div>
                                    <div class='col-md-2'>
                                        <input class='btn btn-success' type='submit' name='submit' value='" . $valueButton . "'>  
                                    </div>
                                    <div class='col-md-5'></div>
                                </div>
                            </div>
                            ";
                        }
                        ?>
                    </fieldset>
                </form>
            </div>
            <?php
            if (isset($_POST['submit'])){
                switch ($_POST['submit']){
                    case "Sauvegarder":
                        echo "sauve";
                        break;
                    default:
                        echo "<script>
                                location.href='http://88.208.226.189/app/views/ConsultNews.php'
                            </script>";
                        die();
                }
            }
            ?>
        </section>
    </div>
</body>
<?php include("../../include/footer.php"); ?>
</html>
