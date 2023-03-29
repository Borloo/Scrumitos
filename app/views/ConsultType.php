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

        th {
            padding: 5px 20px 5px 20px;
        }

        table {
            border: 1px solid black;
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
                        $typeId = $_POST['listType'];
                        $typeName = getEmplacementNameById($typeId)['nomType'];
                        echo "
                            <div class='card'>
                                <div class='card-header'>
                                    <h4>" . $typeName . "</h4>
                                </div>
                                <div class='card-body'>
                                    <center><table>
                                        <caption> Emplacement du type " . $typeName . "</caption>
                                        <tr><th>Id de l'emplacement</th><th>Type de l'emplacement</th><th>Adresse Emplacement</th><th>Année de Construction</th><th>Actions</th></tr>
                        ";

                        $emplacements = getEmplacementById($typeId);
                        if (!empty($emplacements)){
                            foreach ($emplacements as $emplacement){
                                echo "
                                <tr>
                                    <td>" . $emplacement['idEmpl'] . "</td>
                                    <td>" . $typeName . "</td>
                                    <td>" . $emplacement['adresseEmpl'] . "</td>
                                    <td>" . $emplacement['anneeConstruction'] . "</td>
                                    <td>
                                        <a href='./EmplacementDetail.php?maj=0&id=" . $emplacement['idEmpl'] . "&edit=1'>Modifier</a>
                                        <a href='./EmplacementDetail.php?maj=0&id=" . $emplacement['idEmpl'] . "&edit=0'>Prévisualiser</a>
                                    </td>
                                </tr>
                            ";
                            }
                        }else{
                            echo "<tr><td>Aucun résultat</td></tr>";
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