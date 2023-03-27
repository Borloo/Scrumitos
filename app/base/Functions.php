<?php

function connection(){
    echo
    "<div class='card-header'>
        <h2>Connexion</h2>
    </div>
    <div class='card-body'>
        <form method='post'><input type='submit' name='submit' value='Se connecter'></form>
    </div>";
    if(isset($_POST['submit'])){
        header("location: ./FormConnection.php");
    }
}

function deconnection(){
    echo
    "<div class='card-header'>
        <h2>Connexion</h2>
    </div>
    <div class='card-body'>
        <form method='post'>
            <input type='submit' name='submit' value='Se déconnecter'>
        </form>
    </div>";
    if(isset($_POST['submit'])) {
        if (empty($_SESSION['token'])) {
            header("location: ./Connexion.php?msg=Vous n'êtes pas identifié");
        }
        session_destroy();
        header('location: ./Deconnexion.php');
    }
}
?>