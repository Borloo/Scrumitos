<?php 
error_reporting(E_ALL);
ini_set('display_errors', 'on');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=".../include/styles.css" />
    <title>Ajout de news</title>
</head>
<body>
    <?php include("../include/header.php");?>
    <!--include("../include/connect.inc.php"); -->
        
	<div class="wrapper">
        <?php include("../include/menus.php"); ?>
		<section id="content">
            <div class="card">
                <div class="card-body">
                    <?php 
                    echo "<h1>Ajouter des news TEST</h1><br><br>";
                    ?> 

                    <form action="addNews.php" method="post">
                        <p>Titre : <input type="text" name="newsName" autocomplete="off"/></p>
                        <br>
                        <p>News : <input type="text" id="newsContent" name="newsContent" autocomplete="off"/></p>
                        <br>
                        <p>Date: <input type="date" name="newsDate"/></p>
                        <br>                        
                        <p><input type="submit" value="Envoyer"></p>
                    </form>

                    <?php
                    if($_POST) {
                        echo "Le titre de la news est: ", $_POST['newsName'], "<br>"; 
                        echo "La date est: ", $_POST['newsDate'], "<br>"; 
                        echo "Son contenu est: ", $_POST['newsContent'], "<br>"; 

                        try {

                            $sql = "SELECT titre, body, date FROM News order by id desc";
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

                            //Début de la requete d'ajout
                            $newsName = $_POST['newsName'];
                            $newsDate = $_POST['newsDate'];
                            $newsContent = $_POST['newsContent'];

                            if ($newsName == "" OR $newsDate == "" OR $newsContent == "")
                            {
                                echo '<script> alert("Element manquant")</script>';
                            }
                            else
                            {
                                $requeteAjout = $conn ->query("INSERT INTO   News (titre, body, date)
                                                                VALUES ('$newsName', '$newsContent', '$newsDate')");
                                    
                                if ($requeteAjout === false) 
                                {
                                    var_dump($conn->errorInfo());
                                    die("<script>alert('ERREUR')</script>");
                                } 
                                else
                                {
                                    echo "Ajout réussi"; 
                                    exit();
                                }
                            }
                            //Fin de la requete d'ajout

                            $reqnews->closeCursor();

                        } catch (PDOException $e) {
                            echo "Erreur : " . $e->getMessage();
                        }
    
                    }
                    ?> 
                </div>
            </div>
		</section>
	</div>

	<?php include("../include/footer.php"); ?>
    
</body>
</html>

<style>
/* #newsContent{
    width: 400px;    
    height: 200px;
} */
</style>


