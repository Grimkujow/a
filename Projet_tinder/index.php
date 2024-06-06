<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinés</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="shortcut icon" href="main_image/logo.png">
    <link rel="stylesheet" type="text/css" href="sidebar_css.css">
    <link rel="stylesheet" type="text/css" href="dessin_css.css">
</head>
<body>
    <?php include('sidebar.php');
    include('../../session_verif.php'); ?>
    <div class="content">
        <div class="content-header">
            <h4 class="my-0 font-weight-normal">Dessinez Ici</h4>
        </div><br>
    <?php include('dessiner.php'); ?>
    </div>
</body>
</html>