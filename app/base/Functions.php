<?php

function getBDConnexion(): PDO
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

function getEmplacementNameById(int $id){
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Type WHERE idType =:id";
    $query = $conn->prepare($sql);
    $query->execute(['id' => $id]);
    if ($query->rowCount() == 1){
        return $query->fetch();
    }
    return null;
}

function getOneEmplacementById(int $id){
    /** @var PDOStatement $emplacement */
    $emplacement = getEmplacementById($id, true);
    if ($emplacement->rowCount() == 1){
        print_r('ok2');
        return $emplacement->fetch();
    }
    return null;
}

function getEmplacementById(int $id, bool $onlyQb = false){
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Emplacement WHERE idType = :id";
    $query = $conn->prepare($sql);
    $query->execute(['id' => $id]);
    if ($onlyQb){
        print_r('ok');
        return $query;
    }
    return $query->fetchAll();
}

function getTypes(): array{
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Type";
    $query = $conn->prepare($sql);
    $query->execute();
    return $query->fetchAll();
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
                    <div class='col-md-4'></div>
                    <div class='col-md-4'>
                        <input class='btn btn-success' type='submit' name='submit' value='Se connecter'>
                    </div>
                    <div class='col-md-4'></div>
                </div>
            </form>
        </div>";
        if (isset($_SESSION['ERRORCO'])){
            echo "<p style='background-color: red'>" . $_SESSION['ERRORCO'] . "</p><br/>";
        }
        if(isset($_POST['submit'])){
            if (isset($_POST['login']) && isset($_POST['password'])){
                require('./bd/Utilisateur.php');
                $login = $_POST['login'];
                $password = $_POST['password'];
                $user = getUser($login, $password);
                $isAdmin = isAdmin($user);
                if ($isAdmin || null !== $user){
                    unset($_SESSION['ERRORCO']);
                    $_SESSION['USER'] = $user['login'];
                    header('location: http://88.208.226.189/index.php');
                    die();
                }else{
                    $_SESSION['ERRORCO'] = 'Inconnu';
                }
            }
        }
    echo "</div>";
}
?>