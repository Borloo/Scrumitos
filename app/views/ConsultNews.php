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
            height: 100%;
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
                    if (isset($_GET['msg'])){
                        if ($_GET['msg'] == 'updated'){
                            echo "<p>News mise à jour !</p>";
                        }
                    }
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
                <?php

                require('./../base/HtmlFunctions.php');

                getHtmlListNews();

                ?>
            </div>
        </div>
    </section>
</div>
<?php include("../../include/footer.php"); ?>
</body>

</html>