<nav class="sidebar">
    <ul class="list-group">
        <li class="list-group-item"><a href="/index.php" class="text-decoration-none">Accueil</a></li>
        <li class="list-group-item"><a href="/app/views/ConsultNews.php" class="text-decoration-none">News</a></li>
        <li class="list-group-item"><a href="/app/views/ConsultEmplacement.php?c=0" class="text-decoration-none">Recherches d'emplacements</a></li>
        <li class="list-group-item"><a href="/app/views/allEmplacements.php" class="text-decoration-none">Consulter tous les emplacements</a></li>
        <?php
        // si l'admin ne s'est pas déja connecté alors on affiche le lien pour cela
        if (!isset($_SESSION['USER'])) {
            echo "<li class='list-group-item'><a href='/app/views/Connexion.php?conn=1' class='text-decoration-none'>Se connecter ou S'inscrire</a></li>";
        } // si l'admin est connecté alors on lui affiche des liens particuliers
        else {
            if ($_SESSION['USER']['isAdmin']){
                echo "<li class='list-group-item'><a href='/app/views/Locations.php' class='text-decoration-none'>Locations à valider</a></li>";
            }
            echo '<li class="list-group-item"><a href="/app/Deconnexion.php" class="text-decoration-none">Se déconnecter </a></li>';
        }
        ?>
    </ul>
</nav>
