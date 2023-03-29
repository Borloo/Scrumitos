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
                            $adresse = $emplacement['adresseEmpl'];
                            $annee = $emplacement['anneeConstruction'];
                            $taille = $emplacement['Taille'];
                            $maxPersonne = $emplacement['Max_Personnes'];
                            print_r($emplacement);
                            echo "
                                <div class='card-headear'>
                                    <h1>" . $id . " - " . $name . "</h1>
                                </div>
                                <div class='card-body'>
                                    <div class='row'>
                                        <div class='col-md-6'>
                                            <div class='input-group mb-3'>
                                                <span class='input-group-text' id='basic-addon1'>Nom</span>
                                                <input class='form-control' name='name' type='text' value='" . $name . "'>
                                            </div>
                                        </div>
                                        <div class='col-md-6'>
                                            <div class='input-group mb-3'>
                                                <span class='input-group-text' id='basic-addon2'>Type</span>
                                                <select class='form-select' name='listType'>";
                                                    $types = getTypes();
                                                    foreach ($types as $type){
                                                        print_r(($type['idType'] == $typeId ? "value='" . $type['nomType'] . "'" : ''));
                                                        echo "<option " . ($type['idType'] == $typeId ? "value='" . $type['nomType'] . "'" : '') . ">" . $type['nomType'] . "</option>";
                                                    }
                                                    echo "</select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-md-6'>
                                            <div class='input-group mb-3'>
                                                <span class='input-group-text'>Adresse</span>
                                                <input class='form-control' name='adresse' type='text' value='" . $adresse . "'>
                                            </div>
                                        </div>
                                        <div class='col-md-6'>
                                            <div class='input-group mb-3'>
                                                <span class='input-group-text'>Année construction</span>
                                                <input class='form-control' name='annee' type='number' value='" . $annee . "'>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-md-6'>
                                            <div class='input-group mb-3'>
                                                <span class='input-group-text'>Taille</span>
                                                <input class='form-control' name='annee' type='number' value='" . $taille . "'>
                                            </div>
                                        </div>
                                        <div class='col-md-6'>
                                            <div class='input-group mb-3'>
                                                <span class='input-group-text'>Max personne</span>
                                                <input class='form-control' name='annee' type='number' value='" . $maxPersonne . "'>
                                            </div>
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
