<?php

require('Functions.php');

function getHtmlMenu(){
    echo "
<nav>
    <div class='offcanvas offcanvas-start w-25' tabindex='-1' id='offcanvas' data-bs-keyboard='false' data-bs-backdrop='false'>
        <div class='offcanvas-header'>
            <h6 class='offcanvas-title d-none d-sm-block' id='offcanvas'>Menu</h6>
            <button type='button' class='btn-close text-reset' data-bs-dismiss='offcanvas' aria-label='Close'></button>
        </div>
        <div class='offcanvas-body px-0'>
            <ul class='nav nav-pills flex-column mb-sm-auto mb-0 align-items-start' id='menu'>
                <li class='nav-item'>
                    <a href='#' class='nav-link text-truncate'><i class='fs-5 bi-house'></i><span class='ms-1 d-none d-sm-inline'>Home</span></a>
                </li>
                <li>
                    <a href='#submenu1' data-bs-toggle='collapse' class='nav-link text-truncate'><i class='fs-5 bi-speedometer2'></i><span class='ms-1 d-none d-sm-inline'>Dashboard</span> </a>
                </li>
                <li>
                    <a href='#' class='nav-link text-truncate'><i class='fs-5 bi-table'></i><span class='ms-1 d-none d-sm-inline'>Orders</span></a>
                </li>
                <li class='dropdown'>
                    <a href='#' class='nav-link dropdown-toggle  text-truncate' id='dropdown' data-bs-toggle='dropdown' aria-expanded='false'>
                        <i class='fs-5 bi-bootstrap'></i><span class='ms-1 d-none d-sm-inline'>Bootstrap</span>
                    </a>
                    <ul class='dropdown-menu text-small shadow' aria-labelledby='dropdown'>
                        <li><a class='dropdown-item' href='#'>New project...</a></li>
                        <li><a class='dropdown-item' href='#'>Settings</a></li>
                        <li><a class='dropdown-item' href='#'>Profile</a></li>
                        <li>
                            <hr class='dropdown-divider'>
                        </li>
                        <li><a class='dropdown-item' href='#'>Sign out</a></li>
                    </ul>
                </li>
                <li>
                    <a href='#' class='nav-link text-truncate'>
                        <i class='fs-5 bi-grid'></i><span class='ms-1 d-none d-sm-inline'>Products</span></a>
                </li>
                <li>
                    <a href='#' class='nav-link text-truncate'>
                        <i class='fs-5 bi-people'></i><span class='ms-1 d-none d-sm-inline'>Customers</span> </a>
                </li>
            </ul>
        </div>
    </div>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col min-vh-100 py-3'>
                <!-- toggler -->
                <button class='btn float-end' data-bs-toggle='offcanvas' data-bs-target='#offcanvas' role='button'>
                    <i class='bi bi-arrow-right-square-fill fs-3' data-bs-toggle='offcanvas' data-bs-target='#offcanvas'></i>
                </button>
        Content..
            </div>
        </div>
    </div>
</nav>
    ";
}

function getHtmlTaille()
{
    $sizeMin = getMinTailleEmplacement();
    $sizeMax = getMaxTailleEmplacement();
    echo "
            <div class='card'>
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
                        </fieldset>
                    </form>
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
                </div>
            </div>
            ";
    if (isset($_POST['submit'])) {
        if (isset($_POST['range'])) {
            echo "
                    <div class='card'>
                        <div class='card-header'>
                            <h4>" .  $_POST['range'] . "m²</h4>
                        </div>
                        <div class='card-body'>";
            $emplacements = getEmplacementBySize((int)$_POST['range']);
            if (!empty($emplacements)) {
                echo "
                            <center>
                                <table>
                                    <tr><th>Nom</th><th>Type</th><th>Adresse</th><th>Taille</th>";
                if (isset($_SESSION['USER'])) {
                    echo "<th>Actions</th>";
                }
                echo "</tr>";
                getHtmlEmplacementTable($emplacements, 'size');
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
                                <table>
                                    <tr><th>Nom de l'emplacement</th><th>Type de l'emplacement</th><th>Adresse Emplacement</th><th>Prix/semaine</th>";
                if (isset($_SESSION['USER'])) {
                    echo "<th>Actions</th>";
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
                <h1>Année de construction</h1>
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
                                <table>
                                    <tr><th>Nom de l'emplacement</th><th>Type de l'emplacement</th><th>Adresse Emplacement</th><th>Prix/semaine</th>";
                if (isset($_SESSION['USER'])) {
                    echo " <th>Actions</th>";
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
                        <h1>Période</h1>
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
                        <h4></h4>
                    </div>
                    <div class='card-body'>";
            $emplacements = getEmplacementByPeriode($dateDeb, $dateFin);
            if (!empty($emplacements)) {
                echo "
                                    <center><table>
                                        <caption> Emplacement du " . $dateDeb . " - " . $dateFin . "</caption>
                                        <tr><th>Nom de l'emplacement</th><th>Type de l'emplacement</th><th>Adresse Emplacement</th><th>Prix/semaine</th><th>Actions</th></tr>";
                getHtmlEmplacementTable($emplacements, 'date');
                echo "</table></center>";
            } else {
                echo "<p>Aucun résultat</p>";
            }
            echo "
                                </div>  
                            </div>
                        ";
            echo "</div>
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
                    <h1>Consulter les emplacements par type </h1>
                </div>
                <div class='card-body'>
                    <form method='post'>
                        <fieldset>
                            <div class='row'>
                                <div class='col-md-5'></div>
                                <div class='col-md-2'>  
                                    <select name='listType'>";
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
                                <div class='col-md-2'></div>
                                <div class='col-md-4'>
                                    <input class='btn btn-secondary' type='submit' id='submit' name='submit' value='Afficher'>
                                </div>";
    if (isset($_SESSION['USER'])) {
        echo "
                                    <div class='col-md-4'>
                                        <a href='./EmplacementDetail.php?maj=0&id=-1&edit=2'><input class='btn btn-info' id='ajouter' type='button' value='Ajouter'></a>
                                </div>";
    }
    echo "
                                <div class='col-md-2'></div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>";
    if (isset($_POST['submit'])) {
        if (isset($_POST['listType'])) {
            $typeId = $_POST['listType'];
            $typeName = getEmplacementNameById($typeId)['nomType'];
            echo "
                            <div class='card'>
                                <div class='card-header'>
                                    <div class='row'>
                                        <h4>" . $typeName . "</h4>
                                    </div>
                                </div>
                                <div class='card-body'>
                                    <table>
                                        <caption> Emplacement du type " . $typeName . "</caption>
                                        <tr><th>Nom de l'emplacement</th><th>Type de l'emplacement</th><th>Adresse Emplacement</th><th>Année de Construction</th>";
            if (isset($_SESSION['USER'])) {
                echo "<th>Actions</th>";
            }
            echo "</tr>";
            $emplacements = getEmplacementById($typeId);
            if (!empty($emplacements)) {
                getHtmlEmplacementTable($emplacements);
            } else {
                echo "<tr><td>Aucun résultat</td></tr>";
            }
            echo "
                                    </table></center>
                                </div>
                            </div>";
        }
    }
}

function getHtmlEmplacementTable(array $emplacements, string $specify = '')
{
    switch ($specify){
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
            <td>" . $emplacement['Nom_Emplacement'] . "</td>
            <td>" . $type['nomType'] . "</td>
            <td>" . $emplacement['adresseEmpl'] . "</td>
            <td>" . $emplacement[$specify] . $suffix . "</td>";
        if (isset($_SESSION['USER'])) {
            echo "
            <td>
                <div class='row'>
                    <div class='col-md-4'>
                        <a href='./EmplacementDetail.php?maj=0&id=" . $emplacement['idEmpl'] . "&edit=1'><input type='button' class='btn btn-warning' value='Modifier'></a>
                    </div>
                    <div class='col-md-4'>
                        <a href='./EmplacementDetail.php?maj=0&id=" . $emplacement['idEmpl'] . "&edit=0'><input type='button' class='btn btn-info' value='Prévisualiser'></a>
                    </div>
                    <div class='col-md-4'>
                        <a href='./EmplacementDetail.php?maj=0&id=" . $emplacement['idEmpl'] . "&edit=3'><input type='button' class='btn btn-danger' value='Supprimer'></a>
                    </div>
                </div>
            </td>
            ";
        }

        echo "</tr>
                            ";
    }
}

?>