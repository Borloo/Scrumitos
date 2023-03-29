<?php

    require('./base/Functions.php');

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
            return [
                'id' => $user['id'],
                'login' => $user['login'],
                'roles' => $user['roles'],
            ];
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