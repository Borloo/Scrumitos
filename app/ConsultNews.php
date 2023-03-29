<?php 
error_reporting(E_ALL);
ini_set('display_errors', 'on');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../include/styles.css" />
    <title>Mon site !</title>
</head>

<body>
    <?php
    include("../include/header.php");
    // include("../include/connect.inc.php");
    ?>
    <div class="wrapper">
        <?php include("../include/menus.php"); ?>
        <section id="content">
            <div class="card">
                <div class="card-body">
                    <?php
                    /********************
                    ConsultNews.php	
                    *********************/

                    echo "<h1>les dernières news du camping</h1>";
                    echo "<BR/><BR/>";


                    try {

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
                        $reqnews->execute();
                        $news = $reqnews->fetch();

                        foreach ($news as $new) {
                            echo "<tr>";
                            echo "<td>" . $new['id'] . "</td>";
                            echo "<td>" . $new['titre'] . "</td>";
                            echo "<td>" . $new['body'] . "</td>";
                            echo "</tr>";
                        }
                        $reqnews->closeCursor();

                    } catch (PDOException $e) {
                        echo "Erreur : " . $e->getMessage();
                    }

                    echo "</table></center>";
                    echo "<BR/><BR/>";


                    ?>
                </div>
            </div>
        </section>
    </div>
    <?php include("../include/footer.php"); ?>
</body>

</html>