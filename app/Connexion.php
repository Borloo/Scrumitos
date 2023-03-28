<?php
// 1ère instruction à faire apparâitre dans un script quand une session est 
// lue ou manipulée
session_start();


    require_once("./base/Functions.php");

    if (empty($_SESSION['token'])) {
        connection();
    } else {
        deconnection();
    }

?>