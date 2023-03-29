<?php 
error_reporting(E_ALL);
ini_set('display_errors', 'on');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../include/styles.css" />
    <title>Consultation des emplacements</title>
</head>
<body>
    <?php include("./include/header.php");?>
    <!--include("./include/connect.inc.php"); -->
        
	<div class="wrapper">
        <?php include("./include/menus.php"); ?>
		<section id="content">
            <div class="card">
                <div class="card-body">
                    <?php 
                    echo "<h1>Consulter les emplacements</h1><br><br>";
                    echo "<table>";

                    try {

                        $sql = "SELECT * date FROM Emplacement order by Prix_Semaine desc";
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
                        $emplacements = $reqnews->fetchAll();

                        foreach ($emplacements as $emplacement) {
                            echo "<tr>";
                            echo "<td>", $emplacement['Nom_Emplacement'], "</td>";
                            echo "<td>", $emplacement['Taille'], "</td>";
                            echo "<td>", $emplacement['Max_Personnes'], "</td>";
                            echo "<td>", $emplacement['Prix_Semaine'], "</td>";
                           
                            echo "</tr>";
                            echo "</table>";
                        }
                        $reqnews->closeCursor();

                    } catch (PDOException $e) {
                        echo "Erreur : " . $e->getMessage();
                    }

                    
                    
                    ?> 
                </div>
            </div>
		</section>
	</div>

	<?php include("./include/footer.php"); ?>
    
</body>
</html>

<style>
/* #newsContent{
    width: 400px;    
    height: 200px;
} */
</style>


