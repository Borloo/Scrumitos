<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 'on');
    if (!isset($_SESSION['USER'])) {
        header('location: index.php');
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
                <div class="card">
                    <?php
                        require('./../base/Functions.php');

                        $emplacement = getOneEmplacementById((int)$_GET['id']);
                        if (null != $emplacement){
                            $name = $emplacement['Nom_Emplacement'];
                            $id = $emplacement['idEmpl'];
                            $typeId = $emplacement['idType'];
                            print_r($emplacement);
                            echo "
                                <div class='card-headear'>
                                    <h1>" . $id . " - " . $name . "</h1>
                                </div>
                                <div class='card-body'>
                                    <div class='row'>
                                        <div class='col-md-6'>
                                            <input name='name' type='text' value='" . $name . "'>
                                        </div>
                                        <div class='col-md-6'>
                                            <input name='name' type='text' value='" . $typeId . "'>
                                        </div>
                                    </div>
                                </div>
                            ";
                        }else{
                            echo "<p>Il semblerait il y avoir un problème, cliquez <a href='./../../index.php'>ici</a> pour retourner à l'acceuil</p>";
                        }
                    ?>
                </div>
            </section>
        </div>
        <?php include("./../../include/footer.php"); ?>
    </body>
</html>
