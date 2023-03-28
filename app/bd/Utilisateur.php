<?php

    function getConnexion()
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
        $conn = $this->getConnexion();
        $sql = "SELECT * FROM Utilisateur 
             WHERE login= :login 
             AND password = :password";
        $query = $conn->prepare($sql);
        $query->execute(['login' => $login, 'password' => $password]);
        echo $query->rowCount();
        if ($query->rowCount() == 1){
            print_r($query->fetch());
            return $query->fetch();
        }
        return null;
    }

    function isAdmin(array $user): bool
    {
        if ($user != null){
            $roles = explode(', ', $user['roles']);
            foreach($roles as $role){
                if ($role == 'ADMIN') {
                    return true;
                }
            }
        }
        return false;
    }
?>