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
                    <div class='input-group mb-3'>
                        <span class='input-group-text' id='basic-addon2'>Type</span>
                        <select class='form-select' required name='listType'";
                (int) $year = getMinYear();
                $todayYear = new DateTime('now', new DateTimeZone('Europe/Berlin'));
                (int)$todayYear = $todayYear->format('Y');
                for ($i = $todayYear; $i > $year; $i--){
                    echo "<option value='" . $i . "'>" . $i . "</option>";
                }
                echo "
                        </select>
                    </div>
                </div>
                ";
                ?>
            </div>
        </section>
    </div>
</body>
</html>