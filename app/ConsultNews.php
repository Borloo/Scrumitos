<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="./include/styles.css" />
    <title>Mon site !</title>
</head>

<body>
    <?php
    include("./include/header.php");
    include("./include/connect.inc.php");
    ?>
    <div class="wrapper">
        <?php include("./include/menus.php"); ?>
        <section id="content">
            <?php
            /********************
            ConsultType.php	
            *********************/
            // le formulaire de saisie du type d'emplacement recherché
            echo "<h1>les dernières news du camping</h1>";
            echo "<BR/><BR/>";					
            
            // on affiche le tableau des résultats

            $reqnews = $conn->prepare("SELECT * FROM news where ");
            $reqNews->execute();
            foreach ($reqnews as $new) {
                echo "<tr>";
                echo "<td>" . $new["id"] . "</td>";
                echo "<td>" . $new["titre"] . "</td>";
                echo "<td>" . $new["body"] . "</td>";
                echo "</tr>";
            }
            $reqnews->closeCursor();
            echo "</table></center>";
            echo "<BR/><BR/>";

            ?>
        </section>
    </div>
    <?php include("./include/footer.php"); ?>
</body>

</html>