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

function getMinYear(){
    $year = new DateTime('now', new DateTimeZone('Europe/Berlin'));
    $year = $year->format('Y');
    $locations = getAllLocations();
    foreach ($locations as $location){
        $dateDeb = new DateTime($location['dateDeb']);
        $dateDeb = $dateDeb->format('Y');
        if ($dateDeb >= $year){
            $year = $dateDeb;
        }
    }
    $news = getAllNews();
    foreach ($news as $new){
        $date = new DateTime($new['date']);
        $date = $date->format('Y');
        if ($date >= $year){
            $year = $date;
        }
    }
    return $year;
}

function getAllNews(){
    $conn = getBDConnexion();
    $sql = "SELECT * FROM News";
    $query = $conn->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}

function getAllLocations(){
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Location";
    $query = $conn->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}

function deleteUser(int $id)
{
    $conn = getBDConnexion();
    $sql = "DELETE FROM Utilisateur WHERE id = :id";
    $query = $conn->prepare($sql);
    $query->execute(['id' => $id]);
}

function getAllUsers()
{
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Utilisateur";
    $query = $conn->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}

function getAvisLocation(int $id)
{
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Location WHERE idEmplacement = :id";
    $query = $conn->prepare($sql);
    $query->execute(['id' => $id]);
    $res = $query->fetchAll();
    $tab = [];
    foreach ($res as $resultat) {
        if ($resultat['avis'] != '') {
            $tab[] = $resultat;
        }
    }
    return $tab;
}

function addAvis(
    int    $idLocation,
    string $avis
)
{
    $conn = getBDConnexion();
    $sql = "UPDATE Location SET avis = :avis WHERE id = :id";
    $query = $conn->prepare($sql);
    $query->execute([
        'avis' => $avis,
        'id' => $idLocation
    ]);
}

function removeLocation(int $id)
{
    $conn = getBDConnexion();
    $sql = "DELETE FROM Location WHERE id = :id";
    $query = $conn->prepare($sql);
    $query->execute(['id' => $id]);
}

function getLocationsByUser(int $idUtilisateur)
{
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Location WHERE idUtilisateur = :idUtilisateur";
    $query = $conn->prepare($sql);
    $query->execute(['idUtilisateur' => $idUtilisateur]);
    return $query->fetchAll();
}

function addLocation(
    int      $idEmplacement,
    int      $idUtilisateur,
    DateTime $dateDeb,
    DateTime $dateFin,
    string   $options
)
{
    $conn = getBDConnexion();
    $sql = "INSERT INTO Location(idEmplacement, idUtilisateur, dateDeb, dateFin, options, isValidated, avis)
            VALUES (:idEmplacement, :idUtilisateur, :dateDeb, :dateFin, :options, false, '')";
    $query = $conn->prepare($sql);
    $query->execute([
        'idEmplacement' => $idEmplacement,
        'idUtilisateur' => $idUtilisateur,
        'dateDeb' => $dateDeb->format('y-m-d H:i:s'),
        'dateFin' => $dateFin->format('Y-m-d H:i:s'),
        'options' => $options
    ]);
}

function validateLocation(int $id)
{
    $location = getLocationById($id);
    if (null != $location) {
        $conn = getBDConnexion();
        $sql = 'UPDATE Location SET isValidated = true WHERE id = :id';
        $query = $conn->prepare($sql);
        $query->execute(['id' => $id]);
    }
}

function getLocationById(int $id)
{
    $conn = getBDConnexion();
    $sql = 'SELECT * FROM Location WHERE id = :id';
    $query = $conn->prepare($sql);
    $query->execute(['id' => $id]);
    if ($query->rowCount() == 1) {
        return $query->fetch();
    }
    return [];
}

function getLocations(bool $isValidated): array
{
    $conn = getBDConnexion();
    $sql = 'SELECT * FROM Location WHERE isValidated = :isValidated';
    $query = $conn->prepare($sql);
    $query->execute(['isValidated' => $isValidated]);
    return $query->fetchAll();
}

function deleteNew(int $id)
{
    $conn = getBDConnexion();
    $sql = "DELETE FROM News WHERE id = :id";
    $query = $conn->prepare($sql);
    $query->execute(['id' => $id]);
    print_r($query->errorInfo());
}

function addNew(
    string   $titre,
    string   $body,
    DateTime $date
)
{
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
    int      $id,
    string   $titre,
    string   $body,
    DateTime $date
)
{
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

function getNewById(int $id): array
{
    $conn = getBDConnexion();
    $sql = "SELECT * FROM News WHERE id = :id";
    $query = $conn->prepare($sql);
    $query->execute(['id' => $id]);
    if ($query->rowCount() == 1) {
        return $query->fetch();
    }
    return [];
}

function getNews()
{
    $conn = getBDConnexion();
    $sql = 'SELECT * FROM News ORDER BY date DESC';
    $query = $conn->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}

function getEmplacementBySize(int $size)
{
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Emplacement WHERE Taille <= :size";
    $query = $conn->prepare($sql);
    $query->execute(['size' => $size]);
    return $query->fetchAll();
}

function getMinTailleEmplacement()
{
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Emplacement";
    $query = $conn->prepare($sql);
    $query->execute();
    $resultats = $query->fetchAll();
    $size = 0;
    foreach ($resultats as $resultat) {
        if ($resultat['Taille'] < $size) {
            $size = $resultat['Taille'];
        }
    }
    return $size;
}

function getMaxTailleEmplacement()
{
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Emplacement";
    $query = $conn->prepare($sql);
    $query->execute();
    $resultats = $query->fetchAll();
    $size = getMinTailleEmplacement();
    foreach ($resultats as $resultat) {
        if ($resultat['Taille'] > $size) {
            $size = $resultat['Taille'];
        }
    }
    return $size;
}

function getEmplacementByPrice(int $price)
{
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Emplacement WHERE Prix_Semaine <= :price";
    $query = $conn->prepare($sql);
    $query->execute(['price' => $price]);
    return $query->fetchAll();
}

function getMinPrixSemaineEmplacement()
{
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Emplacement";
    $query = $conn->prepare($sql);
    $query->execute();
    $resultats = $query->fetchAll();
    $price = getMaxPrixSemaineEmplacement();
    foreach ($resultats as $resultat) {
        if ($resultat['Prix_Semaine'] < $price) {
            $price = $resultat['Prix_Semaine'];
        }
    }
    return $price;
}

function getMaxPrixSemaineEmplacement()
{
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Emplacement";
    $query = $conn->prepare($sql);
    $query->execute();
    $resultats = $query->fetchAll();
    $price = 0;
    foreach ($resultats as $resultat) {
        if ($resultat['Prix_Semaine'] > $price) {
            $price = $resultat['Prix_Semaine'];
        }
    }
    return $price;
}

function getEmplacementByAnnee(int $dateDeb, int $dateFin)
{
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
    string   $options,
    string   $image
)
{
    $conn = getBDConnexion();
    $sql = "INSERT INTO `Emplacement`(`Nom_Emplacement`, `idType`, `adresseEmpl`, `anneeConstruction`, `Taille`, `Max_Personnes`, `Periode_Dispo_Debut`, `Periode_Dispo_Fin`, `Prix_Semaine`, `Prix_Periode_Annee`, `Options`, `PathImage`) 
            VALUES (:name, :type, :adresse, :annee, :taille, :maxPersonne, :dateDeb, :dateFin, :prixSemaine, :prixAnnee, :options, :image)";
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
        'image' => $image,
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
    string   $options,
    string   $image
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
            PathImage = :image
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
        'image' => $image,
        'id' => $id,
    ]);
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

function getTypeById(int $id)
{
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

function getEmplacementByIdType(int $id)
{
    $conn = getBDConnexion();
    $sql = "SELECT * FROM Emplacement WHERE idType = :id";
    $query = $conn->prepare($sql);
    $query->execute(['id' => $id]);
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

function updateUser(
    string   $id,
    string   $adresse,
    string   $mail,
    string   $telephone
)
{
    $conn = getBDConnexion();
    $sql = "UPDATE Utilisateur SET
            adresse = :adresse,
            mail = :mail,
            telephone = :telephone,
            WHERE id = :id
           ";
    $query = $conn->prepare($sql);
    $query->execute([
        'adresse' => $adresse,
        'mail' => $mail,
        'telephone' => $telephone,
        'id' => $id,
    ]);
    print_r($query->errorInfo());
}

function registerUser(
    string $username,
    string $password,
    string $adresse,
    string $email,
    string $tel
)
{
    $conn = getBDConnexion();
    $sql = "insert into Utilisateur(login, password,roles, adresse, mail, telephone) values (
                                :login,
                                :password,
                                :roles,
                                :adresse,
                                :mail,
                                :telephone
)";
    $query = $conn->prepare($sql);
    $query->execute([
        'login' => $username,
        'password' => $password,
        'roles' => "USER",
        'adresse' => $adresse,
        'mail' => $email,
        'telephone' => $tel
    ]);
    print_r($query->errorInfo());
}


?>