<?php
	session_start();
	// si l'internaute accède à cette page sans être l'admin connecté alors
	// on le renvoie vers la page indexphp
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
</head>
<body>
	<?php 
		include("./../../include/header.php");
	?>
	<div class="wrapper">
		<?php include("./../../include/menus.php"); ?>
		<section id="content">
		<?php
			/********************
				ConsultType.php	
			*********************/
				// le formulaire de saisie du type d'emplacement recherché
				echo "<h1>Consulter les emplacements par type </h1>";
				echo "<BR/><BR/>";
				echo "<form method='post'>";
					echo "<fieldset>";
						echo "<legend> Types d'Emplacement </legend><BR/>";	
						// LD_Types = Liste Déroulante des types
						echo "<select name='LD_Types'>";
						// on constitue la liste déroulante à partir de la table Type 
						$reqType = $conn->prepare("SELECT * FROM Type");
						$reqType->execute();	
						foreach($reqType as $type) {
							echo "<option value='".$type["idType"]."'>".$type["nomType"]."</option>";
						}	
						$reqType->closeCursor();		
						echo "</select><br/><br/>";			
						echo "<input type='submit' name='Afficher' value='Afficher'/>";
						echo "<br/><br/>";
					echo "</fieldset>";
				echo "</form>";		
				
			
				// le formulaire a été soumis
				if(isset($_POST['Afficher']) && isset($_POST['LD_Types'])) {
					// echo $_POST['LD_Types'];					
						
					// on affiche le tableau des résultats
					echo "<BR/><BR/>";
					echo "<center><table border='2' >";
						echo "<caption> Emplacement du Type ".$_POST['LD_Types']."</caption>";
						echo "<tr><th>Id Emp</th><th>Type de l'Emplacement</th><th>Adresse Emplacement</th><th>Année de Construction</th></tr>";	
						$reqEmpl = $conn->prepare("SELECT * FROM Emplacement where idType = :pIdType");
						$reqEmpl->execute(array('pIdType' => $_POST['LD_Types']));
						foreach($reqEmpl as $empl) {
							echo "<tr>";
								echo "<td>".$empl["idEmpl"]."</td>";
								echo "<td>".$empl["idType"]."</td>";
								echo "<td>".$empl["adresseEmpl"]."</td>";
								echo "<td>".$empl["anneeConstruction"]."</td>";
							echo "</tr>";	
						}	
						$reqEmpl->closeCursor();
					echo "</table></center>";	
					echo "<BR/><BR/>";
				}		
		?>
		</section>
	</div>
	<?php include("./../../include/footer.php"); ?>
</body>
</html>