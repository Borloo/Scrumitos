<nav class="sidebar">
  <ul>
<<<<<<< Updated upstream
	<li><a href="/app/ConsultNews.php">News</a></li>
	<li><a href="/app/ConsultEmplacementPrix.php">Emplacement par prix</a></li>
<<<<<<< Updated upstream
=======
    <li><a href="/app/ConsultEmpAvance.php">Consultation avancée des emplacements</a></li>
=======
    <li><a href="/index.php">Accueil</a></li>
	<li><a href="/app/ConsultNews.php">Consulter les news</a></li>
    <li><a href="/app/ConsultDate.php">Consulter les emplacements par année de construction/rénovation</a></li>
<<<<<<< Updated upstream
	<li><a href="/app/ConsultEmplacementPrix.php">Consultation des emplacements par prix</a></li>
	<li><a href="/app/ConsultDetails.php">Consulter les détails d'un emplacement</a></li>
=======
	<li><a href="/app/ConsultDetails.php">Les emplacements</a></li>
>>>>>>> Stashed changes

>>>>>>> Stashed changes
>>>>>>> Stashed changes
<?php
		// si l'admin ne s'est pas déja connecté alors on affiche le lien pour cela
		if (!isset($_SESSION['USER'])) {
			echo '<li><a href="/app/Connexion.php">Se connecter comme admin </a></li>';
		}
		// si l'admin est connecté alors on lui affiche des liens particuliers
		else {
			echo '<li><a href="/app/views/ConsultEmplacement.php">Recherche emplacements</a></li>';
			echo '<li><a href="/app/addNews.php">Ajouter des news</a></li>';
			echo '<li><a href="/app/Deconnexion.php">Se déconnecter </a></li>';
		}
?>
  </ul>
</nav>
