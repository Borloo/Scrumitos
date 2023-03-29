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
                            $dateDeb = $emplacement['Periode_Dispo_Debut'];
                            $dateFin = $emplacement['Periode_Dispo_Fin'];
                            $prixSemaine = $emplacement['Prix_Semaine'];
                            $prixAnnee = $emplacement['Prix_Periode_Annee'];
                            $options = $emplacement['Options'];
                            echo "
                                <div class='card-headear'>
                                    <h1>" . $id . " - " . $name . "</h1>
                                </div>
                                <div class='card-body'>
                                <form method='post'>
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
                                                <input class='form-control' name='taille' type='string' value='" . $taille . "'>
                                            </div>
                                        </div>
                                        <div class='col-md-6'>
                                            <div class='input-group mb-3'>
                                                <span class='input-group-text'>Max personne</span>
                                                <input class='form-control' name='maxPersonne' type='number' value='" . $maxPersonne . "'>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-md-6'>
                                            <div class='input-group mb-3'>
                                                <span class='input-group-text'>Date début</span>
                                                <input class='form-control' name='dateDeb' type='datetime-local' value='" . $dateDeb . "'>
                                            </div>
                                        </div>
                                        <div class='col-md-6'>
                                            <div class='input-group mb-3'>
                                                <span class='input-group-text'>Date fin</span>
                                                <input class='form-control' name='dateFin' type='datetime-local' value='" . $dateFin . "'>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-md-6'>
                                            <div class='input-group mb-3'>
                                                <span class='input-group-text'>Prix semaine</span>
                                                <input class='form-control' name='prixSemaine' type='number' value='" . $prixSemaine . "'>
                                            </div>
                                        </div>
                                        <div class='col-md-6'>
                                            <div class='input-group mb-3'>
                                                <span class='input-group-text'>Prix année</span>
                                                <input class='form-control' name='prixAnnee' type='number' value='" . $prixAnnee . "'>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='input-group mb-3'>
                                            <span class='input-group-text'>Options</span>
                                            <input class='form-control' name='options' type='text' value='" . $options . "'>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-md-5'></div>
                                            <div class='col-md-2'>
                                                <input type='submit' name='submit' value='Sauvegarder'>
                                            </div>
                                        <div class='col-md-5'></div>
                                    </div>
                                </div>
                            </form>
                            ";
                            if (isset($_POST['submit'])){
                                if (
                                    isset($_POST['name']) &&
                                    isset($_POST['listType']) &&
                                    isset($_POST['adresse']) &&
                                    isset($_POST['annee']) &&
                                    isset($_POST['taille']) &&
                                    isset($_POST['maxPersonne']) &&
                                    isset($_POST['dateDeb']) &&
                                    isset($_POST['dateFin']) &&
                                    isset($_POST['prixSemaine']) &&
                                    isset($_POST['prixAnnee'])
                                ){
                                    $name = $_POST['name'];
                                    $type = getTypeByName($_POST['listType'])['idType'];
                                    $adresse = $_POST['adresse'];
                                    $annee = $_POST['annee'];
                                    $taille = $_POST['taille'];
                                    $maxPersonne = $_POST['maxPersonne'];
                                    $dateDeb = new DateTime($_POST['dateDeb']);
                                    $dateFin = new DateTime($_POST['dateFin']);
                                    $prixSemaine = $_POST['prixSemaine'];
                                    $prixAnnee = $_POST['prixAnnee'];
                                    $options = $_POST['options'];
                                    print_r($_GET['id'] . " / " . $name . " / " . $type . " / " . $adresse . " / " . $annee . " / " . $taille . " / " . $maxPersonne . " / " . $dateDeb->format('Y-m-d H:i:s') . " / " . $dateFin->format('Y-m-d H:i:s') . " / " . $prixSemaine . " / " . $prixAnnee . " / " . $options);
                                    updateEmplacement((string)$_GET['id'], $name, $type, $adresse, (int)$annee, $taille, (int)$maxPersonne);
                                }
                            }
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
