<?php

function connection(){
    echo
    "<div class='card-header'>
        <h2>Connexion</h2>
    </div>
    <div class='card-body'>
        <form method='post'><input type='submit' name='SeConnecter' value='Se connecter'></form>
    </div>";
    if(isset($_POST['SeConnecter'])){
        header("location: ./FormConnection.php");
    }
}

function deconnection(){
    echo
    "<div class='card-header'>
        <h2>Connexion</h2>
    </div>
    <form method='post'><input type='submit' name='SeDeconnecter' value='Se déconnecter'></form>";
    if(isset($_POST['SeDeconnecter'])) {
        if (empty($_SESSION['SLogin'])) {
            header("location: ./Connexion.php?msg=Vous n'êtes pas identifié");
        }
        session_destroy();
        header('location: ./Deconnexion');
    }
}
?>