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
    <?php
    // Chemin vers le fichier utilisateurs
    $fichier_utilisateurs = "../../dataU/utilisateurs.txt";
    $nomFichier = 'list_galerie.txt';
    if (file_exists($nomFichier)) {
        if (unlink($nomFichier)) {
        } else {
        }
    } else {
    }
    // Vérifier si le fichier existe avant de tenter de le lire
    if (file_exists($fichier_utilisateurs)) {
        $utilisateurs_connexion = file_get_contents($fichier_utilisateurs);
        $utilisateurs_lignes_connexion = explode("\n", $utilisateurs_connexion);

        // Chemin vers le fichier de la galerie
        $file = $fichier = fopen($nomFichier, 'w');
        $donnees = "Ceci est une ligne de données.\n";
        foreach ($utilisateurs_lignes_connexion as $ligne) {
            // Afficher la ligne pour le débogage

            // Vérifier que la ligne n'est pas vide
            if (trim($ligne) !== '') {
                // Écrire les données dans le fichier
                $infos_utilisateur = explode(",", $ligne);
                // Vérifier que la ligne contient les informations nécessaires
                if (count($infos_utilisateur) > 5) {
                    $id = $infos_utilisateur[1];
                    $pseudo = $infos_utilisateur[2];
                    $nb_abo = $infos_utilisateur[5];
                    $uploadDirectory = '../sidebar_utilisateur/user_drawing/' . $id . '/';
                    if ($nb_abo == 0) {
                        $imagePath = $uploadDirectory . 'img-1.png';
                        if (file_exists($imagePath)) {
                            $data = "$id,$imagePath,$pseudo \n";
                            fwrite($fichier, $data);
                        } else {
                        }
                    } elseif ($nb_abo > 0) {
                        $imageCount = 1;
                        while (true) {
                            $imagePath = $uploadDirectory . 'img-' . $imageCount . '.png';
                            echo '<div class="image-container">';
                            if (file_exists($imagePath)) {
                                $imageCount++;
                                // Écrire les données dans le fichier
                                $data = "$id,$imagePath,$pseudo \n";
                                fwrite($fichier, $data);
                            } else {
                                break;
                            }
                        }
                    }
                } else {
                }
            }
        }
    } else {
        echo "Le fichier utilisateurs n'existe pas.";
    }
    fclose($file);
    ?>


</body></html>