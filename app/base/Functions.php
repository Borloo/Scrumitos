<?php


function connection(){
    include("./../bd/Utilisateur.php");
    echo
    "
    <div class='card'>
        <div class='card-header'>
            <h2>Connexion</h2>
        </div>
        <div class='card-body'>";
            echo "<form method='post'>
                <p>Login : <input type='text' name='login'></p>
                <p>Password : <input type='text' name='password'></p>
                <input type='submit' name='submit' value='Se connecter'>
            </form>
        </div>";
    echo '6 <br/>';
    if(isset($_POST['submit'])){
        if (isset($_POST['login']) && isset($_POST['password'])){
            $login = $_POST['login'];
            $password = $_POST['password'];
            $sql = "SELECT * FROM Utilisateur 
             WHERE login= :login 
             AND password = :password";
            $user = 'clmt';
            $pass = '130702';
            $conn = new PDO('mysql:host=localhost;dbname=base_camping;charset=UTF8'
                ,$user, $pass, array(PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION));
            $res = $conn->prepare($sql);
            $res->execute(['login' => $login, 'password' => $password]);
            if ($res->rowCount() != 1){
                $msg = "Erreur lors de la connexion ...";
                header('location : index.php?msg=' . $msg);
                die();
            }
            $row = $res->fetch();
            $roles = explode(', ', $row['roles']);
            foreach($roles as $role){
                if ($role == 'ADMIN'){
                    print_r($role);
                }
            }
            $msg = "Pas de rôle admin";
            header('location : index.php?msg=' . $msg);
            die();
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