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
    <?php
    include("./../../include/headfile.php");
    ?>
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
    </style>
</head>

<body>
    <?php
    include("./../../include/header.php");
    ?>
    <div class="wrapper">
        <?php include("./../../include/menus.php");
        ?>
        <section id="content">
            <div class="card">
                <div class="card-headear">
                    <h1>Recherche d'emplacements </h1>
                </div>
                <div class="card-body">
            <?php
			echo "<BR/><BR/>";
			echo "<form method='post'>";
			echo "<fieldset>";
			// BR_Choix = Bouton Radio du choix
			echo "<input type='radio' name='BR_choix' value='byType' checked='checked'";
			// on garde la sélection effectuée précédemment
			if (isset($_POST['Afficher']) && isset($_POST['BR_choix']) && $_POST['BR_choix'] == "byType") {
				echo "checked='checked'";
			}
			echo "/> Recherche d'emplacements par type<BR/><BR/>";
			echo "<input type='radio' name='BR_choix' value='byPeriod' ";
			if (isset($_POST['Afficher']) && isset($_POST['BR_choix']) && $_POST['BR_choix'] == "byPeriod") {
				echo "checked='checked'";
			}
			echo "/> Recherche d'emplacements par période<BR/><BR/>";
            echo "<input type='radio' name='BR_choix' value='byYear' ";
            if (isset($_POST['Afficher']) && isset($_POST['BR_choix']) && $_POST['BR_choix'] == "byYear") {
                echo "checked='checked'";
            }
            echo "/> Recherche d'emplacements par années de construction<BR/><BR/>";
			echo "<input type='radio' name='BR_choix' value='bySize' ";
			if (isset($_POST['Afficher']) && isset($_POST['BR_choix']) && $_POST['BR_choix'] == "bySize") {
				echo "checked='checked'";
			}
			echo "/> Recherche d'emplacement par taille<BR/><BR/>";
			echo "<input type='submit' name='Afficher' value='Afficher'/><BR/><BR/>";
			echo "</fieldset>";
			echo "</form>";

            // le formulaire a été soumis
			if (isset($_POST['Afficher']) && isset($_POST['BR_choix'])) {
				// echo $_POST['BR_choix'];	
				//  on sélectionne les emplacements recherchés					
				switch ($_POST['BR_choix']) {
					case "byType":
                        header('location: ConsultType.php?suppr=0&add=0');
						break;

                    case "byYear" :
                        header('location : ConsultDate.php');
                        break;

					case "byPeriod":
						$titre = "Emplacements par périodes";
						
						break;
					case "bySize":
						$titre = "Emplacements par taille";
					
						break;
				}
            }
                
        ?>
                </div>
            </div>
        </section>
    </div>
    <?php include("./../../include/footer.php"); ?>
</body>

</html>