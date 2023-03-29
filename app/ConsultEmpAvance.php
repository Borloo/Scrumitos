<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Recherche Emplacement</title>
</head>

<body>
    <?php

    session_start();

    include("../include/header.php");
    ?>

    <section id="content">
			<?php
            include("../include/menus.php");
            // le formulaire de choix de la tranche de date
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
						$titre = "Emplacements antérieurs à 2000";
						// on recherche les emplacements datant d'avant 2000
						$requete = "SELECT * FROM Emplacement WHERE anneeConstruction < 2000";
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
    <p>EZ CITY GANG</p>
    <?php include("../include/footer.php"); ?>
</body>

</html>


