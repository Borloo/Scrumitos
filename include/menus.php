<nav class="sidebar">
  <ul>
    <li><a href="index.php">Accueil</a></li>
    <li><a href="ConsultDate.php">Consulter les emplacements par année de construction/rénovation</a></li>
<?php
		// si l'admin ne s'est pas déja connecté alors on affiche le lien pour cela
		if (!isset($_SESSION['AdminConnecte'])) {
			echo '<li><a href="./../src/Connexion.php">Se connecter comme admin </a></li>';
		}
		// si l'admin est connecté alors on lui affiche des liens particuliers
		else {
			echo '<li><a href="ConsultType.php">Consulter les emplacements par type</a></li>';
			echo '<li><a href="Deconnexion.php">Se déconnecter </a></li>';
		}
?>
  </ul>
</nav>
