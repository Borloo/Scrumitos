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
        echo "<p>Deb</p><br/>";
        /** @var PDO $conn */
        $conn = $this->getConnexion();
        echo "<p>après conn</p><br/>";
        $sql = "SELECT * FROM Utilisateur 
             WHERE login= :login 
             AND password = :password";
        echo "<p>avant prepare</p><br/>";
        $query = $conn->prepare($sql);
        echo "<p>avant query</p><br/>";
        $query->execute(['login' => $login, 'password' => $password]);
        echo "<p>après query</p><br/>";
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