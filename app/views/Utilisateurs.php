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
        <div class="card">
            <div class="card-header">
                <?php
                if (isset($_GET['msg'])){
                    switch ($_GET['msg']){
                        case "del":
                            echo "<p>Utilisateur supprimé !</p>";
                            break;
                        case "up":
                            echo "<p>Utilisateur modifié !</p>";
                            break;
                    }
                }
                ?>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-5">
                        <h1>Utilisateurs</h1>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <a href='/app/views/UtilisateurDetails.php?id=-1'><input type='button' class='btn btn-success' value='Ajouter'></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="post">
                    <table class="table">
                        <tr><th scope="col">Login</th><th scope="col">Rôles</th><th scope="col">Email</th><th scope="col">Téléphone</th><th></th></tr>
                        <?php
                        $users = getAllUsers();
                        foreach ($users as $user){
                            $badges = "";
                            $roles = explode(', ', $user['roles']);
                            foreach($roles as $role){
                                switch ($role){
                                    case 'ADMIN':
                                        $badges .= "<span class='badge text-bg-warning'>Administrateur</span>";
                                        break;
                                    case 'USER':
                                        $badges .= "<span class='badge text-bg-info'>Utilisateur</span>";
                                        break;
                                }
                            }
                            echo "
                            <tr>
                                <th scope='row'>" . $user['login'] . "</th>
                                <td>" . $badges . "</td>
                                <td>" . $user['mail'] . "</td>
                                <td>" . $user['telephone'] . "</td>
                                <td>";
                                if (isset($_SESSION['USER'])) {
                                    if ($_SESSION['USER']['isAdmin'] == 1) {
                                        echo "
                                        <div class='row'>
                                            <div class='col-md-6'>
                                                <a href='/app/views/UtilisateurDetails.php?id=" . $user['id'] . "'><input type='button' class='btn btn-warning' value='Modifier'></a>
                                            </div>
                                            <div class='col-md-6'>
                                                <a href='/app/views/UtilisateurDetails.php?id=" . $user['id'] . "&del=1'><input type='button' class='btn btn-danger' value='Supprimer'></a>
                                            </div>
                                        </div>";
                                    }
                                }
                                echo "</td>
                            </tr>";
                        }
                        ?>
                    </table>
                </form>
            </div>
        </div>
    </section>
</div>
<?php include("./../../include/footer.php"); ?>
</body>
</html>
