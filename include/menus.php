<nav class="sidebar">
    <ul class="list-group">
        <li class="list-group-item"><a href="/index.php" class="text-decoration-none">Accueil</a></li>
        <li class="list-group-item"><a href="/app/views/ConsultNews.php" class="text-decoration-none">News</a></li>
        <li class="list-group-item"><a href="/app/views/ConsultEmplacement.php" class="text-decoration-none">Emplacements</a></li>
        <?php
        // si l'admin ne s'est pas déja connecté alors on affiche le lien pour cela
        if (!isset($_SESSION['USER'])) {
            echo "<li class='list-group-item'><a href='/app/views/Connexion.php?conn=1' class='text-decoration-none'>Se connecter ou S'inscrire</a></li>";
        } // si l'admin est connecté alors on lui affiche des liens particuliers
        else {
            if ($_SESSION['USER']['isAdmin'] == "1"){
                echo "<li class='list-group-item'><a href='/app/views/Locations.php' class='text-decoration-none'>Locations à valider</a></li>";
            }
            echo '<li class="list-group-item"><a href="/app/views/Compte.php" class="text-decoration-none">Mon compte</a></li>';
        }
        ?>
    </ul>
</nav>
