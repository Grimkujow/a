<?php session_start();?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="shortcut icon" href="../../main_image/logo.png">
    <link rel="stylesheet" type="text/css" href="../../sidebar_css.css">
    <title>DrawnTogether</title>
    <style>
        .image-container {
            border: 2px solid black;
            padding: 10px;
            display: inline-block;
        }
        .image-container img {
            width: 400px;
            height: auto;
        }
    </style>
</head>
<body>
    <?php include('../../sidebar.php'); ?>
    <div class="content">
        <?php include('../../session_verif.php'); ?>
        <div class="content-header">
            <h4 class="my-0 font-weight-normal">Profil</h4>
        </div><br>
        <?php include('show_data_user.php'); ?>
        <br><br><br><br><p>Votre dessin : </p>
        <div class="image-container">
        <?php
        $chemin = "/Projet_tinder/sidebar/sidebar_utilisateur/user_drawing/{$_SESSION['user_id']}.png";
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . $chemin)) {
                echo "<img src=\"$chemin\" alt=\"Drawing\">";
            } else {
                echo "L'image n'existe pas.";
            }
        ?>
        </div>
        <br><br><br>
        <p style="font-size: 20px;">
            <a href="edit_user.php">Modifier le profil</a>
        </p>
           <?php
        if ($_SESSION['loggedin'] == true) {
            echo '<a href="deconnexion.php">Déconnexion</a>';
        } ?>
    </div>
</body>
</html>
