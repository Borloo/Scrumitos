<header class="globalHeader" id="top">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-5">
            <h1><a href="/index.php" class="text-decoration-none">Camping de la Grande Bleue</a></h1>
        </div>
        <div class="col-md-1"></div>
        <?php
        if (isset($_SESSION['USER'])) {
            ?>
            <div class="col-md-2">
                <a href="http://88.208.226.189/app/views/Deconnexion.php" class="text-decoration-none"><input class="btn btn-success" type="button"
                                                                              value="Déconnexion"></a>
            </div>
            <?php
        }
        ?>
    </div>
</header>
