<?php

function getBDConnexion(): PDO
{
    try {
        $user = 'clmt';
        $pass = '130702';
        $conn = new PDO('mysql:host=localhost;dbname=base_camping;charset=UTF8'
            , $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage() . "<br/>";
        die();
    }
    return $conn;
}

function getLocations(bool $isValidated): array{
    $conn = getBDConnexion();
    $sql = 'SELECT * FROM Location WHERE isValidated = :isValidated';
    $query = $conn->prepare($sql);
    $query->execute(['isValidated' => $isValidated]);
    return $query->fetchAll();
}

function deleteNew(int $id){
    $conn = getBDConnexion();
    $sql = "DELETE FROM News WHERE id = :id";
    $query = $conn->prepare($sql);
    $query->execute(['id' => $id]);
    print_r($query->errorInfo());
}

function addNew(
    string $titre,
    string $body,
    DateTime $date
){
    $conn = getBDConnexion();
    $sql = 'INSERT INTO News(titre, body, date)
            VALUES (:titre, :body, :date)';
    $query = $conn->prepare($sql);
    $query->execute([
        'titre' => $titre,
        'body' => $body,
        'date' => $date->format('Y-m-d')
    ]);
    print_r($query->errorInfo());
}

function updateNew(
    int $id,
    string $titre,
    string $body,
    DateTime $date
){
    $conn = getBDConnexion();
    $sql = "UPDATE News SET
            titre = :titre,
            body = :body,
            date = :date
            WHERE id = :id
           ";
    $query = $conn->prepare($sql);
    $query->execute([
        'titre' => $titre,
        'body' => $body,
        'date' => $date->format('Y-m-d'),
        'id' => $id
    ]);
    print_r($query->errorInfo());
}

function getNewById(int $id): array{
    $conn = getBDConnexion();
    $sql = "SELECT * FROM News WHERE id = :id";
    $query = $conn->prepare($sql);
    $query->execute(['id' => $id]);
    if ($query->rowCount() == 1){
        return $query->fetch();
    }
    return [];
}

function getNews(){
    $conn = getBDConnexion();
    $sql = 'SELECT * FROM News ORDER BY date DESC';
    $query = $conn->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}

function getEmplacementBySize(int $size){
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Emplacement WHERE Taille <= :size";
    $query = $conn->prepare($sql);
    $query->execute(['size' => $size]);
    return $query->fetchAll();
}

function getMinTailleEmplacement(){
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Emplacement";
    $query = $conn->prepare($sql);
    $query->execute();
    $resultats = $query->fetchAll();
    $size = 0;
    foreach ($resultats as $resultat){
        if ($resultat['Taille'] < $size){
            $size = $resultat['Taille'];
        }
    }
    return $size;
}

function getMaxTailleEmplacement(){
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Emplacement";
    $query = $conn->prepare($sql);
    $query->execute();
    $resultats = $query->fetchAll();
    $size = getMinTailleEmplacement();
    foreach ($resultats as $resultat){
        if ($resultat['Taille'] > $size){
            $size = $resultat['Taille'];
        }
    }
    return $size;
}

function getEmplacementByPrice(int $price){
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Emplacement WHERE Prix_Semaine <= :price";
    $query = $conn->prepare($sql);
    $query->execute(['price' => $price]);
    return $query->fetchAll();
}

function getMinPrixSemaineEmplacement(){
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Emplacement";
    $query = $conn->prepare($sql);
    $query->execute();
    $resultats = $query->fetchAll();
    $price = getMaxPrixSemaineEmplacement();
    foreach ($resultats as $resultat){
        if ($resultat['Prix_Semaine'] < $price){
            $price = $resultat['Prix_Semaine'];
        }
    }
    return $price;
}

function getMaxPrixSemaineEmplacement(){
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Emplacement";
    $query = $conn->prepare($sql);
    $query->execute();
    $resultats = $query->fetchAll();
    $price = 0;
    foreach ($resultats as $resultat){
        if ($resultat['Prix_Semaine'] > $price){
            $price = $resultat['Prix_Semaine'];
        }
    }
    return $price;
}

function getEmplacementByAnnee(int $dateDeb, int $dateFin){
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Emplacement 
         WHERE anneeConstruction >= :dateDeb
         AND anneeConstruction <= :dateFin";
    $query = $conn->prepare($sql);
    $query->execute([
        'dateDeb' => $dateDeb,
        'dateFin' => $dateFin
    ]);
    return $query->fetchAll();
}

function getEmplacementByPeriode(string $dateDeb, string $dateFin): array
{
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Emplacement 
         WHERE Periode_Dispo_Debut <= :dateDeb
         AND Periode_Dispo_Fin >= :dateFin";
    $query = $conn->prepare($sql);
    $query->execute([
        'dateDeb' => $dateDeb,
        'dateFin' => $dateFin
    ]);
    return $query->fetchAll();
}

function addEmplacement(
    string   $name,
    string   $type,
    string   $adresse,
    int      $annee,
    string   $taille,
    int      $maxPersonne,
    DateTime $dateDeb,
    DateTime $dateFin,
    int      $prixSemaine,
    int      $prixAnnee,
    string   $options
)
{
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

function deleteEmplacement(string $id)
{
    $conn = getBDConnexion();
    $sql = "DELETE FROM Emplacement WHERE idEmpl = :id";
    $query = $conn->prepare($sql);
    $query->execute(['id' => $id]);
    print_r($query->errorInfo());
}

function updateEmplacement(
    string   $id,
    string   $name,
    string   $type,
    string   $adresse,
    int      $annee,
    string   $taille,
    int      $maxPersonne,
    DateTime $dateDeb,
    DateTime $dateFin,
    int      $prixSemaine,
    int      $prixAnnee,
    string   $options
)
{
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
            PathImage = ''
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

function getEmplacementNameById(int $id)
{
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Type WHERE idType =:id";
    $query = $conn->prepare($sql);
    $query->execute(['id' => $id]);
    if ($query->rowCount() == 1) {
        return $query->fetch();
    }
    return null;
}

function getTypeByName(string $name)
{
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Type WHERE nomType = :name";
    $query = $conn->prepare($sql);
    $query->execute(['name' => $name]);
    if ($query->rowCount() == 1) {
        return $query->fetch();
    }
    return null;
}

function getTypeById(int $id){
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Type WHERE idType = :id";
    $query = $conn->prepare($sql);
    $query->execute(['id' => $id]);
    if ($query->rowCount() == 1) {
        return $query->fetch();
    }
    return null;
}

function getOneEmplacementById(int $id)
{
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Emplacement WHERE idEmpl = :id";
    $query = $conn->prepare($sql);
    $query->execute(['id' => $id]);
    if ($query->rowCount() == 1) {
        return $query->fetch();
    }
    return null;
}

function getEmplacementById(int $id, bool $onlyQb = false)
{
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Emplacement WHERE idType = :id";
    $query = $conn->prepare($sql);
    $query->execute(['id' => $id]);
    if ($onlyQb) {
        return $query;
    }
    return $query->fetchAll();
}
function getAllEmplacements()
{
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Emplacement";
    $query = $conn->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}

function getTypes(): array
{
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Type";
    $query = $conn->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}

function connection()
{
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
    if (isset($_SESSION['ERRORCO'])) {
        echo "<p style='background-color: red'>" . $_SESSION['ERRORCO'] . "</p><br/>";
    }
    if (isset($_POST['submit'])) {
        if (isset($_POST['login']) && isset($_POST['password'])) {
            require('./bd/Utilisateur.php');
            $login = $_POST['login'];
            $password = $_POST['password'];
            $user = getUser($login, $password);
            $isAdmin = isAdmin($user);
            if ($isAdmin || null !== $user) {
                unset($_SESSION['ERRORCO']);
                $_SESSION['USER'] = $user['login'];
                $_SESSION['USER_ID'] = $user['id'];
                header('location: http://88.208.226.189/index.php');
                die();
            } else {
                $_SESSION['ERRORCO'] = 'Inconnu';
            }
        }
    }
    echo "</div>";
}

function registerUser(
    string $username,
    string $password,
    string $adresse,
    string $email,
    string $tel
){
    $conn = getBDConnexion();

    $sql = "insert into Utilisateur(login, password, adresse, mail, telephone) values (
                                :username,
                                :password,
                                :adresse,
                                :email,
                                :tel
)";
    $query = $conn->prepare($sql);
    $query->execute([
        'name' => $username,
        'type' => $password,
        'adresse' => $adresse,
        'annee' => $email,
        'taille' => $tel

    ]);
    print_r($query->errorInfo());
}

?>