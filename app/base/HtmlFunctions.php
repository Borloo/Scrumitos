<?php

require('Functions.php');

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
    if (isset($_POST['submit'])){
        if (isset($_POST['dateDeb']) && isset($_POST['dateFin'])){
            echo "
                <div class='card'>
                    <div class='card-header'>
                        <h4></h4>
                    </div>
                    <div class='card-body'>";
                        print_r($dateDeb);
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
                                <div class='col-md-4'></div>
                                <div class='col-md-4'>
                                    <select name='listType'>";
    $types = getTypes();
    foreach ($types as $type) {
        echo "<option value='" . $type['idType'] . "'>" . $type['nomType'] . "</option>";
    }
    echo "
                                        </select>
                                    </div>
                                    <div class='col-md-4'></div>
                                </div><br>
                                <div class='row'>
                                    <div class='col-md-2'></div>
                                    <div class='col-md-4'>
                                        <input class='btn btn-secondary' type='submit' id='submit' name='submit' value='Afficher'>
                                    </div>
                                    <div class='col-md-4'>
                                            <a href='./EmplacementDetail.php?maj=0&id=-1&edit=2'><input class='btn btn-info' id='ajouter' type='button' value='Ajouter'></a>
                                    </div>
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
                                    <center><table>
                                        <caption> Emplacement du type " . $typeName . "</caption>
                                        <tr><th>Nom de l'emplacement</th><th>Type de l'emplacement</th><th>Adresse Emplacement</th><th>Année de Construction</th><th>Actions</th></tr>";
            $emplacements = getEmplacementById($typeId);
            if (!empty($emplacements)) {
                foreach ($emplacements as $emplacement) {
                    echo "
                                <tr>
                                    <td>" . $emplacement['Nom_Emplacement'] . "</td>
                                    <td>" . $typeName . "</td>
                                    <td>" . $emplacement['adresseEmpl'] . "</td>
                                    <td>" . $emplacement['anneeConstruction'] . "</td>
                                    <td>
                                        <div class='row' id='actions'>
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
                                </tr>";
                }
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

?>