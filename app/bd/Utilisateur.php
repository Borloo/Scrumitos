<?php

    echo "<p>Utilisateur.php</p>";

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

    function getUser(string $login, string $password)
    {
        /** @var PDO $conn */
        $conn = getConnexion();
        $sql = "SELECT * FROM Utilisateur 
             WHERE login= :login 
             AND password = :password";
        $query = $conn->prepare($sql);
        $query->execute(['login' => $login, 'password' => $password]);
        if ($query->rowCount() == 1){
            $user = $query->fetch();
            return [$user['id'] => [
                'login' => $user['login'],
                'roles' => $user['roles'],
            ]];
        }
        return null;
    }

    function isAdmin(array $user): bool
    {
        if ($user != null){
            echo "<p>isAdmin - user roles</p><br>";
            print_r($user['roles']);
            echo $user['roles'] . "<br>";
            $roles = explode(', ', $user['roles']);
            foreach($roles as $role){
                echo "<p>role</p><br>";
                print_r($role);
                if ($role == 'ADMIN') {
                    return true;
                }
            }
        }
        return false;
    }
?>