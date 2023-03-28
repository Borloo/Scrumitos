<?php


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
                <p>Password : <input type='password' name='password'></p>
                <input type='submit' name='submit' value='Se connecter'>
            </form>
        </div>";
    echo '31 <br/>';
    if(isset($_POST['submit'])){
        if (isset($_POST['login']) && isset($_POST['password'])){
            require('./bd/Utilisateur.php');
            $login = $_POST['login'];
            $password = $_POST['password'];
            $user = getUser($login, $password);
            if ($user == null){
                echo "<p>Problèmes d'identification</p><br/>";
            }
            echo "<p>avant isAdmin</p><br>";
            $isAdmin = isAdmin($user);
            echo "<p>isAdmin</p><br>";
            print_r($isAdmin);
            if (null == $user || !$isAdmin){
                $_SESSION['USER'] = 'Inconnu';
            }else{
                $_SESSION['USER'] = $user['login'];
            }
//            header('http://88.208.226.189/index.php');
//            die();
        }
    }
    echo "</div>";
}

function deconnection(){
    session_destroy();
}
?>