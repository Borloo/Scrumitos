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
                <?php
                if (isset($_GET['id'])){
                    $new = getNewById((int)$_GET['id']);
                    echo "
                    <div class='card-header'>
                        <h4>" . $new['titre'] . "</h4>
                    </div>
                    <div class='card-body'>
                    </div>
                    <div class='card-footer'>
                        <a class='btn btn-success' href='ConsultNews.php' role='button'>Sauvegarder</a>
                    </div>
                    ";
                }
                ?>
            </div>
        </section>
    </div>
</body>
<?php include("../../include/footer.php"); ?>
</html>
