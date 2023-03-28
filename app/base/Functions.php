<?php


function connection(){
    echo "
    <div class='card'>
        <div class='card-header'>
            <h2>Connexion</h2>
        </div>
        <div class='card-body'>
            <form method='post'>
                <div class='row'>
                    <p>Login : <input type='text' name='login'></p>
                </div>
                <div class='row'>
                    <p>Password : <input type='password' name='password'></p>
                </div>
                <div class='row'>
                    <div class='col-md-6'>
                        <input class='btn btn-success' type='submit' name='submit' value='Se connecter'>
                    </div>
                    <div class='col-md-6'>
                        <input class='btn btn-dark' type='submit' name='retour' value='Retour'>
                    </div>
                </div>
            </form>
        </div>
    </div>";
    if(isset($_POST['submit'])){
        if (isset($_POST['login']) && isset($_POST['password'])){
            require('./bd/Utilisateur.php');
            $login = $_POST['login'];
            $password = $_POST['password'];
            $user = getUser($login, $password);
            $isAdmin = isAdmin($user);
            if ($isAdmin && null !== $user){
                $_SESSION['USER'] = $user['login'];
                header('location: http://88.208.226.189/index.php');
                die();
            }else{
                echo "<p>Inconnu</p>";
            }
        }
    }
    if (isset($_POST['retour'])){
        header('location: http://88.208.226.189/index.php');
        die();
    }
}
?>