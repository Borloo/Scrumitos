<?php
   
    include("../include/header.php");
    include("../include/connect.inc.php");
    include("../include/menus.php"); ?>
        <section id="content">
            <?php
            /********************
            ConsultNews.php	
            *********************/

            echo "<h1>les dernières news du camping</h1>";
            echo "<BR/><BR/>";


            try {
                $reqnews = $conn->prepare("SELECT * FROM News");
                $reqNews->execute();
                $news = $reqnews->fetchAll();

                foreach ($news as $new) {
                    echo "<tr>";
                    echo "<td>" . $new["id"] . "</td>";
                    echo "<td>" . $new["titre"] . "</td>";
                    echo "<td>" . $new["body"] . "</td>";
                    echo "</tr>";
                }
                $reqnews->closeCursor();
            }catch(PDOException $e){
                echo "Erreur : " . $e->getMessage();
            }

            echo "</table></center>";
            echo "<BR/><BR/>";

            ?>
        </section>
    </div>
    <?php include("../include/footer.php"); ?>
</body>

</html>