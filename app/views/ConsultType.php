<?php
	session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 'on');
	if (!isset($_SESSION['USER'])) {
		header('location: index.php');
		die();
	}

?>
<!DOCTYPE html>
<html>
<head>
    <?php
        include("./../../include/headfile.php");
    ?>
    <style>
        td {
            text-align: center;
            padding: 5px;
        }

        table {
            border: 1px black;
        }
    </style>
</head>
<body>
	<?php 
		include("./../../include/header.php");
	?>
	<div class="wrapper">
		<?php include("./../../include/menus.php"); ?>
		<section id="content">
            <div class="card">
                <div class="card-headear">
                    <h1>Consulter les emplacements par type </h1>
                </div>
                <div class="card-body">
                    <?php
                        require('./../base/Functions.php');

                        echo "
                            <form method='post'>
                                <fieldset>
                                    <legend>Types d'emplacement</legend><br/>
                                    <div class='row'>
                                        <div class='col-md-4'></div>
                                        <div class='col-md-4'>
                                            <select name='listType'>
                        ";

                        $types = getTypes();
                        foreach ($types as $type){
                            echo "<option value='" . $type['idType'] . "'>" . $type['nomType'] . "</option>";
                        }

                        echo "
                                        </select>
                                    </div>
                                    <div class='col-md-4'></div>
                                </div><br>
                                <div class='row'>
                                    <div class='col-md-4'></div>
                                    <div class='col-md-4'>
                                        <input type='submit' name='submit' value='Afficher'>
                                    </div>
                                    <div class='col-md-4'></div>
                                </div>
                            </fieldset>
                        </form>
                        ";
                    ?>
                </div>
            </div>
            <?php
                if (isset($_POST['submit'])){
                    if (isset($_POST['listType'])){
                        echo "
                            <div class='card'>
                                <div class='card-header'>
                                    <h4>" . $_POST['listType'] . "</h4>
                                </div>
                                <div class='card-body'>
                                    <center><table>
                                        <caption> Emplacement du type " . $_POST['listType'] . "</caption>
                                        <tr><th>Id de l'emplacement</th><th>Type de l'emplacement</th><th>Adresse Emplacement</th><th>Année de Construction</th></tr>
                        ";

                        $emplacements = getEmplacementByType($_POST['listType']);
                        foreach ($emplacements as $emplacement){
                            echo "
                                <tr>
                                    <td>" . $emplacement['idEmpl'] . "</td>
                                    <td>" . $_POST['listType'] . "</td>
                                    <td>" . $emplacement['adresseEmpl'] . "</td>
                                    <td>" . $emplacement['anneeConstruction'] . "</td>
                                </tr>
                            ";
                        }

                        echo "
                                    </table></center>
                                </div>
                            </div>
                        ";

                    }
                }
            ?>
		</section>
	</div>
	<?php include("./../../include/footer.php"); ?>
</body>
</html>