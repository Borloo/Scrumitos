<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');
?>

<!DOCTYPE html>
<html>

<head>
    <?php include("./../../include/headfile.php"); ?>
    <style>
        td {
            text-align: center;
            padding: 5px;
        }

        th {
            padding: 5px 20px 5px 20px;
        }

        table {
            border: 1px solid black;
        }

        select {
            width: 100%;
        }

        .btn {
            width: 100%;
        }

        .row {
            margin: 2%;
        }

        .card {
            margin-bottom: 2%;
        }
    </style>
</head>

<body>
<?php include("./../../include/header.php"); ?>
<div class="wrapper">
    <?php include("./../../include/menus.php");?>
    <section id="content">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <?php
                    if (isset($_SESSION['USER'])){
                        echo "
                        <div class='col-md-3'></div>
                        <div class='col-md-4'>
                            <h1>News du camping</h1>
                        </div>
                        <div class='col-md-2'></div>
                        <div class='col-md-2'>
                            <a href='ConsultNews.php?id=-1'><input class='btn btn-success' id='ajouter' type='button' value='Ajouter'></a>
                        </div>
                        <div class='col-md-1'></div>
                        ";
                    }else{
                        echo "<h1>News du camping</h1>";
                    }
                    ?>
                </div>
            </div>
            <div class="card-body">

            </div>
        </div>
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
<?php include("../../include/footer.php"); ?>
</body>

</html>