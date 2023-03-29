<nav class="sidebar">
  <ul>
    <li><a href="../../index.php">Accueil</a></li>
    <li><a href="../ConsultDate.php">Consulter les emplacements par année de construction/rénovation</a></li>
	<li><a href="../ConsultDetails.php">Consulter les détails d'un emplacement</a></li>

<?php
		// si l'admin ne s'est pas déja connecté alors on affiche le lien pour cela
		if (!isset($_SESSION['USER'])) {
			echo '<li><a href="../Connexion.php">Se connecter comme admin </a></li>';
		}
		// si l'admin est connecté alors on lui affiche des liens particuliers
		else {
            echo '<li><a href="../views/ConsultType.php">Recherche un emplacement selon son type</a></li>';
			echo '<li><a href="../addNews.php">Ajouter des news</a></li>';
			echo '<li><a href="../views/ConsultType.php">Consulter les emplacements par type</a></li>';
			echo '<li><a href="../Deconnexion.php">Se déconnecter </a></li>';
		}
?>
  </ul>
</nav>
