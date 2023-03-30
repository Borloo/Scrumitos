<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../include/styles.css" />
    <title>Mon site !</title>
</head>

<body>
    <?php
    session_start();
    include("../include/header.php");
    ?>
    <div class="wrapper">
        <?php include("../include/menus.php"); ?>
        <section id="content">
            <?php
            require('./base/Functions.php');?>

            <?php
            echo "<h1>Consulter les emplacements par décennie de parution</h1>";
			echo "<BR/><BR/>";
			echo "<form method='post'>";
			echo "<fieldset>";
			echo "<legend> Emplacements </legend><BR/>";
			// BR_Choix = Bouton Radio du choix
			echo "<input type='radio' name='BR_choix' value='moins2000' checked='checked'";
			// on garde la sélection effectuée précédemment
			if (isset($_POST['Afficher']) && isset($_POST['BR_choix']) && $_POST['BR_choix'] == "moins2000") {
				echo "checked='checked'";
			}
			echo "/> Date de construction/rénovation antérieure à 2000<BR/><BR/>";
			echo "<input type='radio' name='BR_choix' value='moins2010' ";
			if (isset($_POST['Afficher']) && isset($_POST['BR_choix']) && $_POST['BR_choix'] == "moins2010") {
				echo "checked='checked'";
			}
			echo "/> Date de construction/rénovation entre 2000 et 2009<BR/><BR/>";
			echo "<input type='radio' name='BR_choix' value='plus2010' ";
			if (isset($_POST['Afficher']) && isset($_POST['BR_choix']) && $_POST['BR_choix'] == "plus2010") {
				echo "checked='checked'";
			}
			echo "/> Date de construction/rénovation postérieure ou égale à 2010<BR/><BR/>";
			echo "<input type='submit' name='Afficher' value='Afficher'/><BR/><BR/>";
			echo "</fieldset>";
			echo "</form>";

			// le formulaire a été soumis
			if (isset($_POST['Afficher']) && isset($_POST['BR_choix'])) {
				// echo $_POST['BR_choix'];	
				//  on sélectionne les emplacements recherchés					
				switch ($_POST['BR_choix']) {
					case "moins2000":
					 echo "
                            <form method='post'>
                                <fieldset>
                                    <div class='row'>
                                        <div class='col-md-4'></div>
                                        <div class='col-md-4'>
                                            <select name='listType'>
                        ";

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
                                        <input class='btn btn-secondary' type='submit' name='submit' value='Afficher'>
                                    </div>
                                    <div class='col-md-2'></div>
                                </div>
                            </fieldset>
                        </form>
                        ";
            ?>
    </div>
    </div>
    <?php
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
                                        <tr><th>Nom de l'emplacement</th><th>Type de l'emplacement</th><th>Adresse Emplacement</th><th>Année de Construction</th><th>Actions</th></tr>
                        ";

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
                                        <a href='./EmplacementDetail.php?maj=0&id=" . $emplacement['idEmpl'] . "&edit=0'><input type='button' class='btn btn-info' value='Prévisualiser'></a>     
                                    </td>
                                </tr>
                            ";
                }
            } else {
                echo "<tr><td>Aucun résultat</td></tr>";
            }
            echo "
                                    </table></center>
                                </div>
                            </div>
                        ";

        }
    }
    
						break;

					case "moins2010":
						$titre = "Emplacements entre 2000 et 2009";
						$requete = "SELECT * FROM Emplacement WHERE anneeConstruction <= 2009 
																  AND anneeConstruction >= 2000";
						break;
					case "plus2010":
						$titre = "Emplacements postérieurs ou égaux à 2010";
						$requete = "SELECT * FROM Emplacement WHERE anneeConstruction >= 2010";
						break;
				}

				try {
					$user = 'clmt';
					$pass = '130702';
					$conn = new PDO(
						'mysql:host=localhost;dbname=base_camping;charset=UTF8'
						,
						$user,
						$pass,
						array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
					);

					$reqEmpl = $conn->prepare($requete);
					$reqEmpl->execute();

					// on affiche le tableau des résultats
					echo "<BR/><BR/>";

					echo "<center><table border='2' >";
					echo "<caption>" . $titre . "</caption>";
					echo "<tr><th>Id Empl</th><th>Type de l'emplacement</th><th>Adresse de l'emplacement</th><th>Année de construction</th></tr>";
					// affichage lignes du tableau 
					foreach ($reqEmpl as $empl) {
						echo "<tr>";
						echo "<td>" . $empl['idEmpl'] . "</td>";
						echo "<td>" . $empl['idType'] . "</td>";
						echo "<td>" . $empl['adresseEmpl'] . "</td>";
						echo "<td>" . $empl['anneeConstruction'] . "</td>";
						echo "</tr>";
					}
					$reqEmpl->closeCursor();
					echo "</table></center>";
				} catch (PDOException $e) {
					echo "erreur: " . $e->getMessage();
				}


				echo "<BR/><BR/>";
			}
			?>
    </section>
    </div>
    <?php include("../include/footer.php"); ?>
</body>

</html>