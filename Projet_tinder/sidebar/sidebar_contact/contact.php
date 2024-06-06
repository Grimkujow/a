<?php session_start();?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nous contacter</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="shortcut icon" href="../../main_image/logo.png">
    <link rel="stylesheet" type="text/css" href="../../sidebar_css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .twitter-link {
            color: skyblue;
            text-decoration: none;
        }
        .twitter-link:hover {
            text-decoration: underline;
        }
        .instagram-link {
            color: palevioletred;
            text-decoration: none;
        }
        .instagram-link:hover {
            background: linear-gradient(135deg, #FFD700, #FF69B4, #8A2BE2);
            text-decoration: underline;
        }
        .mail-link {
            color: black;
            text-decoration: none;
        }
        .mail-link:hover {
            text-decoration: underline;
        }
        .youtube-link {
            color: darkred;
            text-decoration: none;
        }
        .youtube-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php include('../../sidebar.php'); ?>
    <div class="content">
    <h1>Contactez l'équipe</h1>
    <p>Vous rencontrez un problème ou voulez simplement échanger avec nos équipes ? Contactez-nous via nos différents moyens de communication :</p>
    <ul>
        <li>
            <a href="mailto:adresse-email" target="_blank" class="mail-link">
                <i class="far fa-envelope"></i> Email
            </a>
        </li>
        <li>
            <a href="https://www.twitter.com/notre_equipe" target="_blank" class="twitter-link">
                <i class="fab fa-twitter"></i> Twitter
            </a>
        </li>
        <li>
            <a href="https://www.instagram.com/notre_equipe" target="_blank" class="instagram-link">
                <i class="fab fa-instagram"></i> Instagram
            </a>
        </li>
        <li>
            <a href="https://www.youtube.com/c/notre_equipe" target="_blank" class="youtube-link">
                <i class="fab fa-youtube"></i> Youtube
            </a>
        </li>
    </ul>
    </div>   
</body>
</html>

