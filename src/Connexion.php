<?php
// 1ère instruction à faire apparâitre dans un script quand une session est 
// lue ou manipulée
session_start();


    require_once("./base/Functions.php");

    if (empty($_SESSION['token'])) {
        connection();
    } else {
        deconnection();
    }


// Le formulaire a été soumis
	if (isset($_POST['Envoyer'])) {
		// si les champs du formulaire ne sont pas remplis ou n'ont la bonne valeur
		if (!isset($_POST['login']) OR !isset($_POST['motPasse']) 
		        OR $_POST['login'] != "Admin" OR $_POST['motPasse'] != "Admin") {
				echo('Erreur d\'identification... Recommencez <BR/><BR/>');			
		}
		// Les identifiants sont remplis et corrects 
		else {
			// on enregistre la variable session 'identifie'
			$_SESSION['AdminConnecte']='OK';
			// on redirige vers index.php, il ne faut aucun affichage HTML (même <HEAD>...) avant une redirection
			header('location:index.php');
			// on arrêt l'execution pour ne pas executer les instructions plus bas
			die();
		}
	}

	// on génère l'en-tête HTML car on doit afficher le formulaire de connexion
	echo ('<!DOCTYPE html>');
	echo ('<html><head><meta charset="utf-8" /><link rel="stylesheet" href="../include/styles.css" /></head><body>');

	// On affiche le formulaire
	echo "<p>Veuillez entrer les identifiants :</p><BR/>";
	echo "<form method='post' action='Connexion.php'>";
		echo "<p>";
		echo "Login : <input type='text' value='Admin' name='login' /> <BR/><BR/>";
		echo "Mot de passe : <input type='password' value='Admin' name='motPasse' /><BR/><BR/>";
		echo "<input type='submit' name='Envoyer' value='Valider' />";
		echo "</p>";
	echo "</form>";
		
	// on ferme les balises HTML
	echo ('</body></html>');

?>