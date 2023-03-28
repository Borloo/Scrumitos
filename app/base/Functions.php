<?php

include("./../bd/Utilisateur.php");

function connection(){
    echo
    "
    <div class='card'>
        <div class='card-header'>
            <h2>Connexion</h2>
        </div>
        <div class='card-body'>
            <form method='post'>
                <p>Login : <input type='text' name='login'></p>
                <p>Password : <input type='text' name='password'></p>
                <input type='submit' name='submit' value='Se connecter'>
            </form>
        </div>";
    if(isset($_POST['submit'])){
        if (isset($_POST['login']) && isset($_POST['password'])){
            $login = $_POST['login'];
            echo $login;
            $password = $_POST['password'];
            echo $password;
            $user = getUser($login, $password);
            echo "user : ";
            echo $user;
        }
    }
    echo "</div>";
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