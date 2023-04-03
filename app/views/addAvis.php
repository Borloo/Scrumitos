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
    <?php include("./../../include/menus.php"); ?>
    <section id="content">
        <div class="card">
            <div class="card-body">
                <?php
                    echo $_SESSION['USER_ID'];
                ?>

                <form method="post">
                    <fieldset>
                    <div class='card-header'>
                        <h4>Ajout d'un avis</h4>
                    </div>

                    <div class='card-body'>
                        <div class='row'>
                            <div class='col-md-4'>
                                <div class='input-group mb-3'>
                                    <span class='input-group-text' id='basic-addon1'>Votre avis : </span>
                                    <input class='form-control' type="text"  name="avisTtx" placeholder="Ecrivez votre avis...">
                                </div>
                            </div>
                        </div>
                    </div>       
                    <div class='card-footer'>
                                    <div class='row'>
                                        <div class='col-md-5'></div>
                                        <div class='col-md-2'>
                                            <input class='btn btn-success' type="submit" name='submit' value="Valider">
                                        </div>
                                        <div class='col-md-5'></div>
                                    </div>
                                </div>
                    </fieldset>
                </form>

                <?php

                    if (isset($_POST['submit'])){
                        $avis = $_POST['avisTtx'];
                        echo "l'avis est: " + $avis;

                        if ($avis == "" )
                        {
                            echo '<p> alert("Entrez un avis")</p>';
                        }
                        else
                        {
                            echo '<p> alert("Avis valide")</p>';
                            // $requeteAjout = $linkpdo ->query("INSERT INTO t_serie (nomSerie, nbSaisonTot, nbSaisonVues)
                            //                                 VALUES ('$nomSerie', '$nbSaisonTot', '$nbSaisonVues')");
                                
                            // if ($requeteAjout === false) 
                            // {
                            //     var_dump($linkpdo->errorInfo());
                            //     die("<script>alert('ERREUR')</script>");
                            // } 
                            // else
                            // {
                            //     header('Location: index.php');
                            //     exit();
                            // }
                        }
                    }
                ?>
            </div>
        </div>
    </section>
</div>
</body>
<?php include("./../../include/footer.php"); ?>
</html>