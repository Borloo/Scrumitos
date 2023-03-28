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
    echo '22 <br/>';
    if(isset($_POST['submit'])){
        if (isset($_POST['login']) && isset($_POST['password'])){
            echo "<p>ok1</p><br>";
            echo __DIR__;
            require('./bd/Utilisateur.php');
            echo "<p>ok2</p><br>";
            $login = $_POST['login'];
            $password = $_POST['password'];
            $user = getUser($login, $password);
            echo "<p>user</p><br>";
            echo "<script type='text/javascript'>
                    console.log(" . $user . ");
                </script>";
            print_r($user);
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