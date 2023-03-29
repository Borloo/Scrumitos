<?php

function getConnexion(): PDO
{
    try{
        $user = 'clmt';
        $pass = '130702';
        $conn = new PDO('mysql:host=localhost;dbname=base_camping;charset=UTF8'
            ,$user, $pass, array(PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION));
    }
    catch (PDOException $e){
        echo "Erreur: ".$e->getMessage()."<br/>";
        die() ;
    }
    return $conn;
}

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
        </div>";
        echo "<p>1</p>";
        if (isset($_SESSION['ERRORCO'])){
            echo "<p style='background-color: red'>" . $_SESSION['ERRORCO'] . "</p><br/>";
        }
        if(isset($_POST['submit'])){
            if (isset($_POST['login']) && isset($_POST['password'])){
                require('./bd/Utilisateur.php');
                $login = $_POST['login'];
                $password = $_POST['password'];
                echo "<p>ok1</p><br>";
                $user = getUser($login, $password);
                echo "<p>ok2</p><br>";
                $isAdmin = isAdmin($user);
                echo "<p>ok3</p><br>";
                if ($isAdmin || null !== $user){
                    unset($_SESSION['ERRORCO']);
                    $_SESSION['USER'] = $user['login'];
//                    header('location: http://88.208.226.189/index.php');
//                    die();
                }else{
                    $_SESSION['ERRORCO'] = 'Inconnu';
                }
            }
        }
        if (isset($_POST['retour'])){
//            header('location: http://88.208.226.189/index.php');
//            die();
        }
    echo "</div>";
}
?>