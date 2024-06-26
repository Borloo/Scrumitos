<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');
?>

<!DOCTYPE html>
<html>

<head>
    <?php include("./../../include/headfile.php"); ?>
</head>

<body>
<?php include("./../../include/header.php"); ?>
    <div class="wrapper">
        <?php include("./../../include/menus.php");?>
        <section id="content">
            <div class="card">
                <form method="post">
                    <fieldset>
                        <?php

                        require('./../base/Functions.php');

                        if (isset($_GET['id'])){
                            $titre = '';
                            $body = '';
                            $date = new DateTime('now', new DateTimeZone('Europe/Berlin'));
                            $date = $date->format('Y-m-d');
                            if ($_GET['id'] != "-1"){
                                $new = getNewById((int)$_GET['id']);
                                $titre = $new['titre'];
                                $body = $new['body'];
                                $date = $new['date'];
                            }
                            switch ($_GET['edit']){
                                case "0":
                                    $valueButton = "Retour";
                                    $titrePage = 'Prévisualisation de ' . $titre;
                                    break;
                                case "1":
                                    $valueButton = "Sauvegarder";
                                    if ($_GET['id'] != "-1"){
                                        $titrePage = 'Modification de ' . $titre;
                                    }else{
                                        $titrePage = "Ajout d'une news";
                                    }
                                    break;
                                case "-1":
                                    deleteNew((int)$_GET['id']);
                                    echo "<script>
                                            location.href='http://88.208.226.189/app/views/ConsultNews.php?msg=deleted'
                                        </script>";
                                    die();
                                default:
                                    $valueButton = "";
                                    $titrePage = '';
                                    break;
                            }
                            echo "
                            <div class='card-header'>
                                <h4>" . $titrePage . "</h4>
                            </div>
                            <div class='card-body'>
                                <div class='row'>
                                    <div class='col-md-4'>
                                        <div class='input-group mb-3'>
                                            <span class='input-group-text' id='basic-addon1'>Titre</span>
                                            <input class='form-control' name='titre' type='text' value='" . $titre . "'";
                            if ($_GET['edit'] == 0){
                                echo "readonly";
                            }
                            echo ">
                                        </div>
                                    </div>
                                    <div class='col-md-4'>
                                        <div class='input-group mb-3'>
                                            <span class='input-group-text' id='basic-addon1'>Contenu</span>
                                            <input class='form-control' name='body' type='text' value='" . $body . "'";
                            if ($_GET['edit'] == 0){
                                echo "readonly";
                            }
                            echo ">
                                        </div>
                                    </div>
                                    <div class='col-md-4'>
                                        <div class='input-group mb-3'>
                                            <span class='input-group-text' id='basic-addon1'>Date</span>
                                            <input class='form-control' name='date' type='date' value='" . $date . "'";
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
                                        <input class='btn btn-success' type='submit' name='submit' value='" . $valueButton . "' style='width: 100%'>  
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
                        $date = new DateTime($_POST['date']);
                        if ($_GET['id'] != '-1'){
                            updateNew($_GET['id'], $_POST['titre'], $_POST['body'], $date);
                            $msg = 'updated';
                            echo "<script>
                                location.href='http://88.208.226.189/app/views/ConsultNews.php?msg=updated'
                                </script>";
                        }else{
                            addNew($_POST['titre'], $_POST['body'], $date);
                            $msg = 'created';
                            echo "<script>
                                location.href='http://88.208.226.189/app/views/ConsultNews.php?msg=created'
                                </script>";
                        }
                        die();
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
