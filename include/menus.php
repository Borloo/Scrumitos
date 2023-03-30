<nav class="sidebar">
  <ul>
	<li><a href="/app/ConsultNews.php">News</a></li>
    <li><a href="/app/views/ConsultDate.php">Emplacements par année</a></li>
	<li><a href="/app/ConsultEmplacementPrix.php">Emplacement par prix</a></li>
    <li><a href="/app/ConsultEmpAvance.php">Consultation avancée des emplacements</a></li>
<?php
		// si l'admin ne s'est pas déja connecté alors on affiche le lien pour cela
		if (!isset($_SESSION['USER'])) {
			echo '<li><a href="/app/Connexion.php">Se connecter comme admin </a></li>';
		}
		// si l'admin est connecté alors on lui affiche des liens particuliers
		else {
			echo '<li><a href="/app/views/ConsultEmplacement.php">Recherche emplacements</a></li>';
            echo '<li><a href="/app/views/ConsultType.php?suppr=0&add=0">Emplacements par type</a></li>';
			echo '<li><a href="/app/addNews.php">Ajouter des news</a></li>';
			echo '<li><a href="/app/Deconnexion.php">Se déconnecter </a></li>';
		}
?>
  </ul>
</nav>
