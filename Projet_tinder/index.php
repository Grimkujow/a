<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>déestinés</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="shortcut icon" href="main_image/logo.jpg">
    <link rel="stylesheet" type="text/css" href="sidebar_css.css">
    <link rel="stylesheet" type="text/css" href="dessin_css.css">
    <style>
        #canvas-container {
            width: 500px;
            height: 300px;
            border: 1px solid #000;
        }
        canvas {
            border: 1px solid #000;
        }
    </style>
</head>
<body>
    <?php include('sidebar.php'); ?>
    <div class="content">
    <?php include('dessiner.php'); ?>
    </div>
</body>
</html>