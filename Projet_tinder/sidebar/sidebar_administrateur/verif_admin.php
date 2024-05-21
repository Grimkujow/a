<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>déestinés</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="shortcut icon" href="../../main_image/logo.png">
    <link rel="stylesheet" type="text/css" href="../../sidebar_css.css">
</head>
<body>
    <?php include('../../sidebar.php'); ?>  

    <div class="content">
        <?php include('../../session_verif.php'); ?>
        <form action="verif.php" method="post">
                <label for="mdp_admin_user">Entrer le mot de passe administrateur :</label><br>
                <input type="text" id="mdp_admin_user" name="mdp_admin_user"><br><br>

                <input type="submit" value="Valider">
        </form>
    </div>
</body>
</html>
