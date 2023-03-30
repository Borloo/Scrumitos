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
    <title>Mon site !</title>
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

            echo "<h1>les dernières news du camping</h1>";
            echo "<BR/><BR/>";
            ?>
            <div class="grid gap-3">
                <div class="p-2 g-col-6">Grid item 1</div>
                <div class="p-2 g-col-6">Grid item 2</div>
                <div class="p-2 g-col-6">Grid item 3</div>
                <div class="p-2 g-col-6">Grid item 4</div>
            </div>

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

                foreach ($news as $new) {
                    echo '<div class="row"><div class="col-6"><div class="card"><div class="card-body">';
                    echo '<h5 class="card-title">' . $new['titre'] . '</h5>';
                    echo '<h6 class="card-subtitle mb-2 text-muted">' . $new['date'] . '</h6>';
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