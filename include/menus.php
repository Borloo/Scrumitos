<nav class="sidebar">
    <ul class="list-group">
        <li class="list-group-item"><a href="/index.php">Accueil</a></li>
        <li class="list-group-item"><a href="/app/ConsultNews.php">News</a></li>
        <li class="list-group-item"><a href="/app/views/ConsultEmplacement.php?c=0">Recherches d'emplacements</a></li>
        <li class="list-group-item"><a href="/app/views/allEmplacements.php">Consulter tous les emplacements</a></li>
        <?php
        // si l'admin ne s'est pas déja connecté alors on affiche le lien pour cela
        if (!isset($_SESSION['USER'])) {
            echo '<li class="list-group-item"><a href="/app/Connexion.php">Se connecter comme admin </a></li>';
        } // si l'admin est connecté alors on lui affiche des liens particuliers
        else {
            echo '<li class="list-group-item"><a href="/app/addNews.php">Ajouter des news</a></li>';
            echo '<li class="list-group-item"><a href="/app/Deconnexion.php">Se déconnecter </a></li>';
        }
        ?>
    </ul>
</nav>
