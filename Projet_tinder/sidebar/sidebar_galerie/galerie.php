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
    <link rel="stylesheet" type="text/css" href="galerie.css">

</head>
<body>
    <div class="content">
    <?php include('../../sidebar.php'); 
        include('list_creation.php'); 
        include('galerie.html');

        if (isset($_SESSION['id_img'])) {
            $test = $_SESSION['id_img'];
            echo "Session ID: $test";
        }
    function afficherGalerie() {
        $nom_fichier = "list_galerie.txt";
        if (file_exists($nom_fichier)) {
            $donnees = file_get_contents($nom_fichier);
            $donnees_tableau = array_filter(explode(PHP_EOL, $donnees));
            shuffle($donnees_tableau);

            foreach ($donnees_tableau as $ligne) {
                if (!empty($ligne)) {
                    list($id, $lien_image, $pseudo) = explode(",", $ligne);
                    echo "$pseudo :";
                    echo "<a href='galerie.php'><img src='$lien_image' style='width:500px;cursor:pointer;' data-id='$id'><br></a>";
                }
            }
        } else {
            error_log("Le fichier $nom_fichier n'existe pas.");
        }
    }
    afficherGalerie()
    ?>
    </div>
</body>
</html>