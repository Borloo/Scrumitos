<?php


function connection(){
    include("./../bd/Utilisateur.php");
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
            $password = $_POST['password'];
            echo $login . " " . $password;
            $sql = "SELECT * FROM Utilisateur 
             WHERE login= :login 
             AND password = :password";
            echo $sql;
            try {
                $conn = $this->getConnexion();
                $conn->prepare($sql);
                $res = $conn->execute(['login' => $login, 'password' => $password]);
                $res->fetchAll();
                echo $res;
            }catch (PDOException $e){
                echo "Erreur : " . $e->getMessage();
                die();
            }
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