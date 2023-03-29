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

function addEmplacement(
    string $name,
    string $type,
    string $adresse,
    int $annee,
    string $taille,
    int $maxPersonne,
    DateTime $dateDeb,
    DateTime $dateFin,
    int $prixSemaine,
    int $prixAnnee,
    string $options
){
    $conn = getBDConnexion();
    $sql = "INSERT INTO `Emplacement`(`Nom_Emplacement`, `idType`, `adresseEmpl`, `anneeConstruction`, `Taille`, `Max_Personnes`, `Periode_Dispo_Debut`, `Periode_Dispo_Fin`, `Prix_Semaine`, `Prix_Periode_Annee`, `Options`, `PathImage`) 
            VALUES (:name, :type, :adresse, :annee, :taille, :maxPersonne, :dateDeb, :dateFin, :prixSemaine, :prixAnnee, :options, '')";
    $query = $conn->prepare($sql);
    $query->execute([
        'name' => $name,
        'type' => $type,
        'adresse' => $adresse,
        'annee' => $annee,
        'taille' => $taille,
        'maxPersonne' => $maxPersonne,
        'dateDeb' => $dateDeb->format('Y-m-d H:i:s'),
        'dateFin' => $dateFin->format('Y-m-d H:i:s'),
        'prixSemaine' => $prixSemaine,
        'prixAnnee' => $prixAnnee,
        'options' => $options,
    ]);
    print_r($query->errorInfo());
}

function deleteEmplacement(string $id){
    $conn = getBDConnexion();
    $sql = "DELETE FROM Emplacement WHERE idEmpl = :id";
    $query = $conn->prepare($sql);
    $query->execute(['id' => $id]);
    print_r($query->errorInfo());
}

function updateEmplacement(
    string $id,
    string $name,
    string $type,
    string $adresse,
    int $annee,
    string $taille,
    int $maxPersonne,
    DateTime $dateDeb,
    DateTime $dateFin,
    int $prixSemaine,
    int $prixAnnee,
    string $options
){
    $conn = getBDConnexion();
    $sql = "UPDATE Emplacement SET
            Nom_Emplacement = :name,
            idType = :type,
            adresseEmpl = :adresse,
            anneeConstruction = :annee,
            Taille = :taille,
            Max_Personnes = :maxPersonne,
            Periode_Dispo_Debut = :dateDeb,
            Periode_Dispo_Fin = :dateFin,
            Prix_Semaine = :prixSemaine,
            Prix_Periode_Annee = :prixAnnee,
            Options = :options,
            PathIlage = ''
            WHERE idEmpl = :id
           ";
    $query = $conn->prepare($sql);
    $query->execute([
        'name' => $name,
        'type' => $type,
        'adresse' => $adresse,
        'annee' => $annee,
        'taille' => $taille,
        'maxPersonne' => $maxPersonne,
        'dateDeb' => $dateDeb->format('Y-m-d H:i:s'),
        'dateFin' => $dateFin->format('Y-m-d H:i:s'),
        'prixSemaine' => $prixSemaine,
        'prixAnnee' => $prixAnnee,
        'options' => $options,
        'id' => $id,
    ]);
    print_r($query->errorInfo());
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

function getTypeByName(string $name){
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Type WHERE nomType = :name";
    $query = $conn->prepare($sql);
    $query->execute(['name' => $name]);
    if ($query->rowCount() == 1){
        return $query->fetch();
    }
    return null;
}

function getOneEmplacementById(int $id){
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Emplacement WHERE idEmpl = :id";
    $query = $conn->prepare($sql);
    $query->execute(['id' => $id]);
    if ($query->rowCount() == 1){
        return $query->fetch();
    }
    return null;
}

function getEmplacementById(int $id, bool $onlyQb = false){
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Emplacement WHERE idType = :id";
    $query = $conn->prepare($sql);
    $query->execute(['id' => $id]);
    if ($onlyQb){
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