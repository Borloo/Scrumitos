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
    <?php include("./../../include/menus.php"); ?>
    <section id="content">
        <div class="card">
            <div class="card-body">
                <?php
                    var_dump($_SESSION);
                ?>

                <form method="post">
                <span class='input-group-text' id='basic-addon1'>Votre avis : </span>
                <input class='form-control' type="text"  name="avisTtx" placeholder="Ecrivez votre avis...">
                <input type="submit" id="submit" value="Valider">
                </form>
            </div>
        </div>
    </section>
</div>
</body>
<?php include("./../../include/footer.php"); ?>
</html>