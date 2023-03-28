<?php
include("../include/header.php");
include("../include/connect.inc.php");

include("../include/menus.php");

/********************
ConsultNews.php	
*********************/

echo "<h1>les dernières news du camping</h1>";
echo "<BR/><BR/>";


try {

    $login = $_POST['login'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM News";
    $user = 'clmt';
    $pass = '130702';
    $conn = new PDO(
        'mysql:host=localhost;dbname=base_camping;charset=UTF8'
        ,
        $user,
        $pass,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );

    $reqnews = $conn->prepare($sql);
    $reqNews->execute();
    $news = $reqnews->fetch();

    foreach ($news as $new) {
        echo "<tr>";
        echo "<td>" . $new["id"] . "</td>";
        echo "<td>" . $new["titre"] . "</td>";
        echo "<td>" . $new["body"] . "</td>";
        echo "</tr>";
    }
    $reqnews->closeCursor();

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

echo "</table></center>";
echo "<BR/><BR/>";



include("../include/footer.php");
?>