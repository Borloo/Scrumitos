<?php

    function getConnexion(){
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

    function getUser(string $login, string $password){
        $sql = "SELECT * FROM Utilisateur 
         WHERE login= :login 
         AND password = :password";
        $conn = $this->getConnexion();
        $conn->prepare($sql);
        $res = $conn->execute(['login' => $login, 'password' => $password]);
        $res->fetchAll();
        echo "
        <p>$res</p>
        ";
        return $res;
    }
?>