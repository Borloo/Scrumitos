<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require('./../base/HtmlFunctions.php');
?>
<!DOCTYPE html>
<html>
<head>
    <?php include("./../../include/headfile.php"); ?>
</head>
<body>
    <?php include("./../../include/header.php"); ?>
    <div class="wrapper">
        <?php include("./../../include/menus.php"); ?>
        <section id="content">
            <div class="card-header">
                <h1>Archives</h1>
            </div>
            <div class="card">
                <?php
                echo "
                <div class='card'>
                    <div class='row'>
                        <div class='col-md-5'></div>
                        <div class='col-md-2'>
                            
                                <div class='input-group-text' id='basic-addon2'>Année à archiver</div>
                                <form method='POST'>
                                <select class='form-select' required name='listYear'>";
                                $years = getAnnee();
                                foreach ($years as $year){
                                    if($year['YEAR(dateFin)']==null){
                                        echo "<option value='Aucune année à archiver'></option>";
                                    }
                                    echo "<option value='" . $year['YEAR(dateFin)'] . "'>" . $year['YEAR(dateFin)'] . "</option>";
                                }
                                echo "
                                
                                </select>
                                <br><br>
                                <div class='col-md-1'></div>
                                    
                                <div class='col-md-1'></div>
                                <div class='col-md-2'>
                                        <input class='btn btn-secondary' type='submit' id='submit' name='submit' value='Archiver'>
                                </div>
                                </form>
                            
                            
                        </div>
                        <div class='col-md-5'></div>
                    </div>
                </div>
                ";

                if (isset($_POST['listYear'])) {

                    if($_POST['listYear'] == null){
                        echo '<p>Aucune année à archiver</p>';
                    }
                    else {
                        $selectedYear = $_POST['listYear'];
                        archivage($selectedYear);

                        echo '<p> Année ' . $selectedYear . ' archivée';
                    }
                }

                ?>
            </div>
        </section>
    </div>
    <?php include("./../../include/footer.php"); ?>
</body>
</html>