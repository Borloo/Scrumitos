<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="../include/styles.css"/>
    <title>Les News</title>
    <?php
    include("../include/headfile.php");
    ?>
</head>

<body>
<?php
include("../include/header.php");
// include("../include/connect.inc.php");
?>
<div class="wrapper">
    <?php include("../include/menus.php"); ?>
    <section id="content">
        <div class="container">
            <?php
            /********************
             * ConsultNews.php
             *********************/

            echo "<h1>Les dernières news du camping</h1>";
            echo "<BR/><BR/>";
            ?>

            <?php


            try {

                $sql = "SELECT titre, body, date FROM News order by date desc";
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
                $reqnews->execute();
                $news = $reqnews->fetchAll();
                echo '<div class="row ">';
                foreach ($news as $new) {
                    echo '<div class="col-6 mb-4"><div class="card"><div class="card-body">';
                    echo '<h5 class="card-title">' . $new['titre'] . '</h5>';
                    $date_type = strtotime($new['date']);
                    echo '<h6 class="card-subtitle mb-2 text-muted">' . date('d/m/y', $date_type). '</h6>';
                    echo '<p class="card-text">' . $new['body'] . '</p>';
                    echo "</div></div></div>";
                }
                echo '</div>';
                $reqnews->closeCursor();

            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }

            ?>
        </div>
    </section>
</div>
<?php include("../include/footer.php"); ?>
</body>

</html>