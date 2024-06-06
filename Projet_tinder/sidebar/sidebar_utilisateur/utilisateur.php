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
            background-color: white;
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
        <?php
            function get_user_abo($file, $id){
                if (file_exists($file) && is_readable($file)) {
                    $content = file_get_contents($file);
                    $lines = explode(PHP_EOL, $content);
                    foreach($lines as $line){
                        $data = explode(',', $line);

                        if (isset($data[1]) && $data[1] === $id) {
                            return $data[5];
                        }
                    }
                }
                else {
                    echo "Erreur: Le fichier $file n'existe pas ou n'est pas lisible.";
                }

            return null;
            }
            $id = $_SESSION['user_id'];
            $file = '../../dataU/utilisateurs.txt';
            $nb_abo = get_user_abo($file, $id);
            $uploadDirectory = 'user_drawing/' . $id . '/';
            if($nb_abo == 0){
                $imagePath = $uploadDirectory . 'img-1.png';
                if (file_exists($imagePath)) {
                    echo "<img src=\"$imagePath\" alt=\"Drawing\">";
                } 
                else {
                    echo "L'image n'existe pas.";
                }
            }
            else if($nb_abo == 1){
                    $imageCount = 1;
                    $imageFound = false;

                    while (true) {
                        $imagePath = $uploadDirectory . 'img-' . $imageCount . '.png';
                        echo '<div class="image-container">';
                        if (file_exists($imagePath)){ 
                            echo "<img src='$imagePath' alt='Drawing'>";
                            $imageCount++;
                            $imageFound = true;
                        }
                        else {
                            break;
                        }
                        echo '</div>';
                    }

                    if (!$imageFound) {
                        echo "Aucune image trouvée pour cet utilisateur.";
                    }
            }
            else {
                    echo "Niveau d'abonnement invalide.";
                }
            
        ?>
        <br><br><br>
        <button class="btn">
        <span class="button-content">
            <a href="edit_user.php" class="custom-link">Modifier le profil</a></span></button>
        <button class="btn">
        <span class="button-content" ><a href="deconnexion.php" class="custom-link">Déconnexion</a></span></button>
        </div>
        </div>

</body>
</html>
