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
    <?php include('sidebar.php'); ?>
<div class="content">
<?php
session_start();

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['imageData'])) {
        if(isset($_SESSION['user_id'])){
            $id = $_SESSION['user_id'];
                $uploadDirectory = 'sidebar/sidebar_utilisateur/user_drawing/' . $id . '/';

                // Pour créer un répertoire si il ne le trouve pas / n'existe pas
                if (!is_dir($uploadDirectory)) {
                    mkdir($uploadDirectory, 0777, true);
                }

                $file = 'dataU/utilisateurs.txt';

                $imageData = $_POST['imageData'];

                $nb_abo = get_user_abo($file, $id);

                $existing_drawings = count(glob($uploadDirectory . "img-*.png"));
                $max_drawings_allowed = ($nb_abo == '1') ? 4 : 1; //Si condition est vraie : var = 4 , sinon var = 1

                if ($existing_drawings < $max_drawings_allowed) {
                    $next_number = $existing_drawings + 1;
                    $fileName = "img-$next_number.png";
                    $filePath = $uploadDirectory . $fileName;

                    if (file_put_contents($filePath, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData)))) {
                        echo "Image sauvegardée.";
                    } 
                    else {
                        echo "Erreur: Impossible de sauvegarder l'image.";
                    }
                } 
            else {
                echo "Erreur: Champ imageData non défini dans le formulaire.";
            } 
        }
        else{
            echo "Erreur: Vous n'êtes pas connecté.";
        }
           
    }
    else {
        echo "Erreur: Cette page ne peut être accédée que par une requête POST.";
    }
}?>
</div>
