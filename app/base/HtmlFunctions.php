<?php

require("Functions.php");

require("../bd/Utilisateur.php");

function getHtmlNewLocation()
{
    $emplacement = getOneEmplacementById((int)$_GET['id']);
    $dateDeb = $emplacement['Periode_Dispo_Debut'];
    $dateFin = $emplacement['Periode_Dispo_Fin'];
    echo "
        <form method='post'>
            <div class='row'>
                <div class='col-md-6'>
                    <div class='input-group mb-3'>
                        <span class='input-group-text'>Date de début</span>
                        <input class='form-control' name='dateDeb' type='datetime-local' min='" . $dateDeb . "' max='" . $dateFin . "' value='" . $dateDeb . "'>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class='input-group mb-3'>
                        <span class='input-group-text'>Date de fin</span>
                        <input class='form-control' name='dateFin' type='datetime-local' min='" . $dateDeb . "' max='" . $dateFin . "' value='" . $dateFin . "'>
                    </div>
                </div>
            </div>
            <div class='row'>
                <div class='input-group mb-3'>
                    <span class='input-group-text'>Options</span>
                    <input class='form-control' name='options' type='text' value='" . $emplacement['Options'] . "'>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-5'></div>
                <div class='col-md-2'>
                    <input class='btn btn-success' type='submit' name='submit' value='Demander'>
                </div>
                <div class='col-md-5'></div>
            </div>
        </form>
    ";
    if (isset($_POST['submit'])) {
        if (isset($_POST['dateDeb']) && isset($_POST['dateFin']) && isset($_POST['options'])) {
            $dateDeb = new DateTime($_POST['dateDeb'], new DateTimeZone('Europe/Berlin'));
            $dateFin = new DateTime($_POST['dateFin'], new DateTimeZone('Europe/Berlin'));
            addLocation((int)$_GET['id'], (int)$_GET['user'], $dateDeb, $dateFin, $_POST['options']);
            echo "<script>
                    location.href='http://88.208.226.189/index.php?msg=addLocation'
                </script>";
            die();
        }
    }
}

function getHtmlLocationsValidation()
{
    $locations = getLocations(false);
    if (!empty($locations)) {
        echo "
        <form method='post'>
            <table class='table'>
                <caption>Locations à valider</caption>
                <tr><th scope='col'>Utilisateur</th><th scope='col'>Nom de l'emplacement</th><th scope='col'>Type de l'emplacement</th><th scope='col'>Date de réservation</th><th>Actions</th></tr>";
        foreach ($locations as $location) {
            $date = $location['dateDeb'] . ' - ' . $location['dateFin'];
            $user = getUserById((int)$location['idUtilisateur']);
            $emplacement = getOneEmplacementById((int)$location['idEmplacement']);
            $type = getTypeById((int)$emplacement['idType']);
            echo "
                        <tr>
                            <th scope='row'>" . $user['login'] . "</th>
                            <td>" . $emplacement['Nom_Emplacement'] . "</td>
                            <td>" . $type['nomType'] . "</td>
                            <td>" . $date . "</td>
                            <td>
                                <input class='btn btn-success' type='submit' name='submit' value='Valider'>
                                <input type='hidden' name='id' value='" . $location['id'] . "'>
                            </td>
                        </tr>
                    ";
        }
        echo "</table>
            </form>
        ";
    } else {
        echo "<p>Pas de locations à valider</p>";
    }
    if (isset($_POST['submit'])) {
        validateLocation((int)$_POST['id']);
        echo "
        <script>
            location.href='http://88.208.226.189/app/views/Locations.php?msg=validated'
        </script>";
        die();
    }
}

function getHtmlListNews()
{
    $news = getNews();
    if (!empty($news)) {
        $size = sizeof($news) + 1;
        $params = [
            '3' => $size % 3,
            '2' => $size % 2
        ];
        switch ($params) {
            case $params['3'] == 1:
                $limit = 3;
                $col = "<div class='col-md-4'>";
                $colFin = "</div></div>";
                break;
            case $params['2'] == 1:
                $limit = 2;
                $col = "<div class='col-md-6'>";
                $colFin = "</div>";
                break;
            default:
                $limit = 1;
                $col = "<div>";
                $colFin = "</div>";
                break;
        }
        $i = 1;
        foreach ($news as $new) {
            $body = $new['body'];
            if (strlen($body) > 100) {
                $body = substr($body, 0, 100);
                $body .= "(...)";
            }
            if ($i == 1) {
                echo "<div class='row'>";
            }
            echo $col;
            echo "<div class='card'>
                <div class='card-header'>
                    <h5 class='card-title'>" . $new['titre'] . "</h5>
                </div>
                <div class='card-body'>
                    <p>" . $new['date'] . "</p>
                    <p class='card-text'>" . $body . "</p>
                </div>
                <div class='card-footer'>";
            if (isset($_SESSION['USER'])) {
                if ($_SESSION['USER']['isAdmin'] == 1) {
                    echo "<div class='row'>
                                <div class='col-md-4'>      
                                    <a href='./../views/NewsDetail.php?id=" . $new['id'] . "&edit=0' class='btn btn-primary'>Détails</a>
                                </div>
                                <div class='col-md-4'>
                                    <a href='./../views/NewsDetail.php?id=" . $new['id'] . "&edit=1' class='btn btn-warning'>Modifier</a> 
                                </div>
                                <div class='col-md-4'>
                                    <a href='./../views/NewsDetail.php?id=" . $new['id'] . "&edit=-1' class='btn btn-danger'>Supprimer</a>
                                </div>
                            </div>";
                } else {
                    echo "<a href='./../views/NewsDetail.php?id=" . $new['id'] . "&edit=0' class='btn btn-primary'>Détails</a>";
                }
            }
            echo "</div></div></div>";
            if ($i == $limit) {
                $i = 1;
                echo $colFin;
            } else {
                $i++;
            }
        }
    } else {
        echo "<h4>Pas de News :(</h4>";
    }
}

function getHtmlTaille()
{
    $sizeMin = getMinTailleEmplacement();
    $sizeMax = getMaxTailleEmplacement();
    echo "<div class='card'>
                <div class='card-header'>
                    <h4>Taille</h4>
                </div>
                <div class='card-body'>
                    <div class='row'>
                <div class='col-md-2'></div>
                <div class='col-md-1'>
                    <p>" . $sizeMin . "m²</p>
                </div>
                <div class='col-md-6'>
                    <form method='post'>
                        <fieldset>
                            <input type='range'";
    if (isset($_POST['range'])) {
        echo " value='" . $_POST['range'] . "'";
    }
    echo " name='range' class='form-range' min='" . $sizeMin . "' max='" . $sizeMax . "'>
                </div>
                <div class='col-md-1'>
                    <p>" . $sizeMax . "m²</p>
                </div>
                <div class='col-md-2'></div>
            </div>
            <div class='row'>
                <div class='col-md-5'></div>
                <div class='col-md-2'>
                    <input class='btn btn-secondary' type='submit' name='submit' value='Afficher'>
                </div>
                <div class='col-md-5'></div>
            </div>
             </fieldset>
</form> 
         </div>
          </div>
            ";
    if (isset($_POST['submit'])) {
        if (isset($_POST['range'])) {
            echo "
                    <div class='card'>
                        <div class='card-header'>
                            <h4>" . $_POST['range'] . "m²</h4>
                        </div>
                        <div class='card-body'>";
            $emplacements = getEmplacementBySize((int)$_POST['range']);
            if (!empty($emplacements)) {
                echo "<table class='table'>
                                    <tr><th scope='col'>Nom</th><th scope='col'>Type</th><th scope='col'>Adresse</th><th scope='col'>Taille</th>";
                if (isset($_SESSION['USER'])) {
                    if ($_SESSION['USER']['isAdmin'] == 1) {
                        echo "<th scope='col'>Actions</th>";
                    }
                }
                echo "</tr>";
                getHtmlEmplacementTable($emplacements, 'size');
                echo "</table>";
            } else {
                echo "<p>Aucun résultat</p>";
            }
            echo "</div>
                </div>
            ";
        }
    }
}

function getHtmlPrix()
{
    $maxSem = getMaxPrixSemaineEmplacement();
    $minSem = getMinPrixSemaineEmplacement();
    echo "
        <div class='card'>
            <div class='card-header'>
                <h1>Prix par semaine</h1>
            </div>
            <div class='card-body'>
                <form method='post'>
                    <fieldset>
                        <div class='row'>
                            <div class='col-md-2'></div>
                            <div class='col-md-1'>
                                <p>" . $minSem . "€</p>
                            </div>
                            <div class='col-md-6'>
                                <input type='range'";
    if (isset($_POST['range'])) {
        echo " value='" . $_POST['range'] . "'";
    }
    echo " name='range' class='form-range' min='" . $minSem . "' max='" . $maxSem . "'>
                            </div>
                            <div class='col-md-1'>
                                <p>" . $maxSem . "€</p>
                            </div>
                            <div class='col-md-2'></div>
                        </div>
                        <div class='row'>
                            <div class='col-md-5'></div>
                            <div class='col-md-2'>
                                <input class='btn btn-secondary' type='submit' name='submit' value='Afficher'>
                            </div>
                            <div class='col-md-5'></div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    ";
    if (isset($_POST['submit'])) {
        if (isset($_POST['range'])) {
            echo "
                    <div class='card'>
                        <div class='card-header'>
                            <h4>" . $minSem . "€ - " . $_POST['range'] . "€</h4>
                        </div>
                        <div class='card-body'>";
            $emplacements = getEmplacementByPrice((int)$_POST['range']);
            if (!empty($emplacements)) {
                echo "
                            <center>
                                <table class='table'>
                                    <tr><th scope='col'>Nom de l'emplacement</th><th scope='col'>Type de l'emplacement</th><th scope='col'>Adresse Emplacement</th><th scope='col'>Prix/semaine</th>";
                if ($_SESSION['USER']['isAdmin'] == 1) {
                    echo "<th scope='col'>Actions</th>";
                }


                echo "</tr>";
                getHtmlEmplacementTable($emplacements, 'price');
                echo "</table>
                            </center>";
            } else {
                echo "<p>Aucun résultat</p>";
            }
            echo "</div>
                </div>
            ";
        }
    }
}

function getHtmlAnnee()
{
    echo "
        <div class='card'>
            <div class='card-header'>
                <h4>Année de construction</h4>
            </div>
            <div class='card-body'>
                <form method='post'>    
                    <fieldset>
                        <div class='row'>
                            <div class='col-md-3'></div>
                            <div class='col-md-6'>
                                <div class='form-check'>
                                    <input class='form-check-input' name='checkbox' type='radio' value='moins2000' id='flexCheckDefault'";
    if (isset($_POST['submit']) && isset($_POST['checkbox']) && $_POST['checkbox'] == 'moins2000') {
        echo "checked";
    }
    echo ">
                                    <label class='form-check-label' for='flexCheckDefault'>
                                    Date de construction/rénovation antérieure à 2000
                                    </label>
                                </div>
                            </div>
                            <div class='col-md-3'></div>
                        </div>
                        <div class='row'>
                            <div class='col-md-3'></div>
                            <div class='col-md-6'>
                                <div class='form-check'>
                                    <input class='form-check-input' name='checkbox' type='radio' value='moins2010' id='flexCheckDefault1'";
    if (isset($_POST['submit']) && isset($_POST['checkbox']) && $_POST['checkbox'] == 'moins2010') {
        echo "checked";
    }
    echo ">
                                    <label class='form-check-label' for='flexCheckDefault1'>
                                    Date de construction/rénovation entre 2000 et 2009
                                    </label>
                                </div>
                            </div>
                            <div class='col-md-3'></div>
                        </div>
                        <div class='row'>
                            <div class='col-md-3'></div>
                            <div class='col-md-6'>
                                <div class='form-check'>
                                    <input class='form-check-input' name='checkbox' type='radio' value='plus2010' id='flexCheckDefault2'";
    if (isset($_POST['submit']) && isset($_POST['checkbox']) && $_POST['checkbox'] == 'plus2010') {
        echo "checked";
    }
    echo ">
                                    <label class='form-check-label' for='flexCheckDefault2'>
                                    Date de construction/rénovation postérieure ou égale à 2010
                                    </label>
                                </div>
                            </div>
                            <div class='col-md-3'></div>
                        </div>
                        <div class='row'>
                            <div class='col-md-5'></div>
                            <div class='col-md-2'>
                                <input class='btn btn-secondary' type='submit' name='submit' value='Afficher'>
                            </div>
                            <div class='col-md-5'></div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    ";
    if (isset($_POST['submit'])) {
        if (isset($_POST['checkbox'])) {
            $emplacements = [];
            switch ($_POST['checkbox']) {
                case 'moins2000':
                    $titre = 'Avant 2000';
                    $emplacements = getEmplacementByAnnee(1990, 1999);
                    break;
                case 'moins2010' :
                    $titre = 'Avant 2010';
                    $emplacements = getEmplacementByAnnee(2000, 2009);
                    break;
                case 'plus2010' :
                    $titre = 'Après 2010';
                    $dateFin = new DateTime('now', new DateTimeZone('Europe/Berlin'));
                    $emplacements = getEmplacementByAnnee(2010, (int)$dateFin->format('Y'));
                    break;
            }
            echo "
                    <div class='card'>
                        <div class='card-header'>
                            <h4>" . $titre . "</h4>
                        </div>
                        <div class='card-body'>";
            if (!empty($emplacements)) {
                echo "
                            <center>
                                <table class='table'>
                                    <tr><th scope='col'>Nom de l'emplacement</th><th scope='col'>Type de l'emplacement</th><th scope='col'>Adresse Emplacement</th><th scope='col'>Date de construction</th>";
                if (isset($_SESSION['USER'])) {
                    if ($_SESSION['USER']['isAdmin'] == 1) {
                        echo " <th scope='col'>Actions</th>";
                    }
                }
                echo "</tr>";
                getHtmlEmplacementTable($emplacements, 'year');
                echo "</table>
                            </center>";
            } else {
                echo "<p>Aucun résultat</p>";
            }
            echo "
                        </div>
                    </div>
            ";
        }
    }
}

function getHtmlPeriode()
{
    echo "
        <div class='card'>
            <div class='card-headear'>
                <h4>Période</h4>
            </div>
            <div class='card-body'>
                <form method='post'>
                    <fieldset>
                        <div class='row'>
                            <div class='col-md-2'></div>
                            <div class='col-md-4'>
                                <div class='input-group mb-3'>
                                    <span class='input-group-text'>Date début</span>";
    $dateDeb = new DateTime('now', new DateTimeZone('Europe/Berlin'));
    $dateDeb = $dateDeb->format('Y-m-d H:i');
    echo "<input class='form-control' name='dateDeb' type='datetime-local' value='" . $dateDeb . "'>";
    echo "</div>
                                    </div>
                                    <div class='col-md-4'>
                                        <div class='input-group mb-3'>
                                            <span class='input-group-text'>Date fin</span>";
    $dateFin = new DateTime('next week', new DateTimeZone('Europe/Berlin'));
    $dateFin = $dateFin->format('Y-m-d H:i');
    echo "<input class='form-control' name='dateFin' type='datetime-local' value='" . $dateFin . "'>";
    echo "</div>
                                    </div>
                                    <div class='col-md-2'></div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-5'></div>
                                    <div class='col-md-2'>
                                        <input class='btn btn-secondary' type='submit' name='submit' value='Afficher'>
                                    </div>
                                    <div class='col-md-5'></div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
    ";
    if (isset($_POST['submit'])) {
        if (isset($_POST['dateDeb']) && isset($_POST['dateFin'])) {
            $dateDeb = $_POST['dateDeb'];
            $dateFin = $_POST['dateFin'];
            echo "
                <div class='card'>
                    <div class='card-header'>
                        <h4>" . $dateDeb . " - " . $dateFin . "</h4>
                    </div>
                    <div class='card-body'>";
            $emplacements = getEmplacementByPeriode($dateDeb, $dateFin);
            if (!empty($emplacements)) {
                echo "<table class='table'>
                        <caption> Emplacement du " . $dateDeb . " - " . $dateFin . "</caption>
                        <tr><th scope='col'>Nom de l'emplacement</th><th scope='col'>Type de l'emplacement</th><th scope='col'>Adresse Emplacement</th><th scope='col'>Prix/semaine</th>";
                if ($_SESSION['USER']['isAdmin'] == 1) {
                    echo "<th scope='col'>Actions</th>";
                }
                echo "</tr>";
                getHtmlEmplacementTable($emplacements, 'date');
                echo "</table>";
            } else {
                echo "<p>Aucun résultat</p>";
            }
            echo "
                                </div>  
                            </div>
                        ";
        }
    }
}

function getHtmlType()
{
    echo "
            <style>
                #ajouter, #submit {
                    width: 50%;
                }
                #actions {
                    margin: 0;
                }
            </style>
            <div class='card'>
                <div class='card-headear'>
                    <h4>Consulter les emplacements par type </h4>
                </div>
                <div class='card-body'>
                    <form method='post'>
                        <fieldset>
                            <div class='row'>
                                <div class='col-md-5'></div>
                                <div class='col-md-2'>  
                                    <select name='listType' class='form-select'>";
    $typesTemp = getTypes();
    $types = [];
    foreach ($typesTemp as $type) {
        if ($type['idType'] == $_POST['listType']) {
            echo "<option value='" . $type['idType'] . "'>" . $type['nomType'] . "</option>";
        } else {
            array_push($types, $type);
        }
    }
    foreach ($types as $type) {
        echo "<option value='" . $type['idType'] . "'>" . $type['nomType'] . "</option>";
    }
    echo "
                                    </select>
                                </div>
                                <div class='col-md-5'></div>
                            </div>
                            <div class='row'>
                                <div class='col-md-4'></div>";
    if (isset($_SESSION['USER'])) {
        if ($_SESSION['USER']['isAdmin'] == 1) {
            echo "
                                <div class='col-md-2'>
                                    <input class='btn btn-secondary' type='submit' id='submit' name='submit' value='Afficher'>
                                </div>
                                    <div class='col-md-2'>
                                        <a href='./EmplacementDetail.php?maj=0&id=-1&edit=2'><input class='btn btn-info' id='ajouter' type='button' value='Ajouter'></a>
                                </div>";
        } else {
            echo "
            <div class='col-md-1'></div>
            <div class='col-md-2'>
                <input class='btn btn-secondary' type='submit' id='submit' name='submit' value='Afficher'>
            </div>
            <div class='col-md-1'></div>
        ";
        }
    } else {
        echo "
            <div class='col-md-1'></div>
            <div class='col-md-2'>
                <input class='btn btn-secondary' type='submit' id='submit' name='submit' value='Afficher'>
            </div>
            <div class='col-md-1'></div>
        ";
    }
    echo "
                                <div class='col-md-4'></div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>";
    if (isset($_POST['submit'])) {
        if (isset($_POST['listType'])) {
            $typeId = $_POST['listType'];
            $typeName = getEmplacementNameById($typeId)['nomType'];
            $emplacements = getEmplacementByIdType($typeId);
            echo "
            <div class='card'>
                <div class='card-header'>
                    <h4>" . $typeName . "</h4>
                </div>
                <div class='card-body'>";
            if (!empty($emplacements)) {
                echo "
                    <table class='table'>
                        <caption> Emplacement du type " . $typeName . "</caption>
                        <tr><th scope='col'>Nom de l'emplacement</th><th scope='col'>Type de l'emplacement</th><th scope='col'>Adresse Emplacement</th><th scope='col'>Prix par semaine</th><th scope='col'>Actions</th></tr>";
                getHtmlEmplacementTable($emplacements);
                echo "</table>";
            } else {
                echo "<p>Aucun résultat</p>";
            }
            echo "
                    </div>
                </div>";
            echo "</div>
                </div>
            ";
        }
    }
}

function getHtmlEmplacementTable(array $emplacements, string $specify = '')
{
    switch ($specify) {
        case 'size':
            $specify = 'Taille';
            $suffix = 'm²';
            break;
        case 'year':
            $specify = 'anneeConstruction';
            $suffix = '';
            break;
        default:
            $specify = 'Prix_Semaine';
            $suffix = "€";
    }
    foreach ($emplacements as $emplacement) {
        $type = getTypeById($emplacement['idType']);

        echo "
        <tr>
            <th scope='row'>" . $emplacement['Nom_Emplacement'] . "</th>
            <td>" . $type['nomType'] . "</td>
            <td>" . $emplacement['adresseEmpl'] . "</td>
            <td>" . $emplacement[$specify] . $suffix . "</td>
            <td>";
        if (isset($_SESSION['USER'])) {
            if ($_SESSION['USER']['isAdmin'] == 1) {
                echo "
                <div class='row'>
                    <div class='col-md-4'>
                        <a href='./EmplacementDetail.php?maj=0&id=" . $emplacement['idEmpl'] . "&edit=1'><input type='button' class='btn btn-warning' value='Modifier'></a>
                    </div>
                    <div class='col-md-4'>
                        <a href='./EmplacementDetail.php?maj=0&id=" . $emplacement['idEmpl'] . "&edit=0'><input type='button' class='btn btn-info' value='Détails'></a>
                    </div>
                    <div class='col-md-4'>
                        <a href='./EmplacementDetail.php?maj=0&id=" . $emplacement['idEmpl'] . "&edit=3'><input type='button' class='btn btn-danger' value='Supprimer'></a>
                    </div>
                </div>
            ";
            } else {
                echo "
                <a href='./EmplacementDetail.php?maj=0&id=" . $emplacement['idEmpl'] . "&edit=0'><input type='button' class='btn btn-info' value='Détails'></a>
            ";
            }
        } else {
            echo "
                <a href='./EmplacementDetail.php?maj=0&id=" . $emplacement['idEmpl'] . "&edit=0'><input type='button' class='btn btn-info' value='Détails'></a>
            ";
        }
        echo "
            </td>
        </tr>";
    }
}

function inscription(int $idUtilisateur = null, bool $coToUser = true)
{
    if (null !== $idUtilisateur) {
        $user = getUserById($idUtilisateur);
        $tel = $user['telephone'];
        $email = $user['mail'];
        $adresse = $user['adresse'];
        $login = $user['login'];
        $password = $user['password'];
    } else {
        $tel = '';
        $email = '';
        $adresse = '';
        $login = '';
        $password = '';
    }
    echo "
    <div class='card'>
        <div class='card-header'>
            <h1>Incription</h1>
        </div>
        <div class='card-body'>
        <form method='post'>
            <fieldset>
                <div class='row'>
                    <div class='col-md-6'>
                        <div class='input-group mb-3'>
                            <span class='input-group-text'>Téléphone</span>
                            <input class='form-control' name='telephone' type='number' value='" . $tel . "'>
                        </div>
                    </div>
                    <div class='col-md-6'>
                        <div class='input-group mb-3'>
                            <span class='input-group-text'>Email</span>
                            <input class='form-control' name='email' type='email' value='" . $email . "'>
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='input-group mb-3'>
                        <span class='input-group-text'>Adresse</span>
                        <input class='form-control' name='adresse' type='text' value='" . $adresse . "'>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-6'>
                        <div class='input-group mb-3'>
                            <span class='input-group-text'>Login</span>
                            <input class='form-control' name='login' type='text' value='" . $login . "'>
                        </div>
                    </div>
                    <div class='col-md-6'>
                        <div class='input-group mb-3'>
                            <span class='input-group-text'>Password</span>
                            <input class='form-control' name='password' type='password' value='" . $password . "'>
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-5'></div>
                    <div class='col-md-2'>
                        <input class='btn btn-success' type='submit' name='submit' value='Enregistrer'>
                    </div>
                    <div class='col-md-5'></div>
                </div>
            </fieldset>
        </form>
        </div>
    </div>
    ";
    if (isset($_POST['submit'])) {
        if (
            isset($_POST['telephone']) &&
            isset($_POST['email']) &&
            isset($_POST['adresse']) &&
            isset($_POST['login']) &&
            isset($_POST['password'])
        ) {
            if (null !== $idUtilisateur) {
                updateUser((int)$_SESSION['USER']['id'], $_POST['login'], $_POST['password'], $_POST['adresse'], $_POST['email'], $_POST['telephone']);
                $isAdmin = $_SESSION['USER']['isAdmin'];
            } else {
                registerUser($_POST['login'], $_POST['password'], $_POST['adresse'], $_POST['email'], $_POST['telephone']);
                $isAdmin = false;
            }
            if ($coToUser){
                $user = getUser($_POST['login'], $_POST['password']);
                $_SESSION['USER'] = [
                    'id' => $user['id'],
                    'login' => $user['login'],
                    'isAdmin' => $isAdmin,
                    'user' => $user
                ];
                echo "<script>
                    location.href='http://88.208.226.189/app/views/Compte.php'
                </script>";
                die();
            }else{
                echo "<script>
                    location.href='http://88.208.226.189/app/views/Utilisateurs.php'
                </script>";
                die();
            }
        }
    }
}

function connection()
{
    echo "
    <div class='card'>
        <div class='card-header'>
            <h2>Connexion</h2>
        </div>
        <div class='card-body'>
            <form method='post'>
                <div class='row'>
                    <p>Login : <input type='text' name='login'></p>
                </div>
                <div class='row'>
                    <p>Password : <input type='password' name='password'></p>
                </div>
                <div class='row'>
                    <div class='col-md-2'></div>
                    <div class='col-md-4'>
                        <input class='btn btn-success' type='submit' name='submit' value='Se connecter'>
                    </div>
                    <div class='col-md-4'>
                        <a href='/app/views/Connexion.php?conn=0'><input class='btn btn-success' type='button' value='Incription'></a></div>
                    </div>
                    <div class='col-md-2'></div>
                </div>
            </form>
        </div>";
    if (isset($_POST['submit'])) {
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $user = getUser($login, $password);
            if (null !== $user) {
                $isAdmin = isAdmin($user);
                unset($_SESSION['ERROR']);
                if ($isAdmin) {
                    $_SESSION['USER'] = [
                        'id' => $user['id'],
                        'login' => $user['login'],
                        'isAdmin' => true,
                        'user' => $user
                    ];
                } else {
                    $_SESSION['USER'] = [
                        'id' => $user['id'],
                        'login' => $user['login'],
                        'isAdmin' => false,
                        'user' => $user
                    ];
                }
                header('location: http://88.208.226.189/index.php');
                die();
            } else {
                echo "<p style='background-color: red'>Utilisateur inconnu</p>";
                $_SESSION['ERROR'] = 'Inconnu';
            }
        }else{
            echo "<p style='background-color: red'>Remplissez les champs nécéssaires</p>";
        }
    }
    echo "</div>";
}
?>