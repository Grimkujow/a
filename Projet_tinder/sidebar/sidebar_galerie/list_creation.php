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

    // Vérifier si le fichier existe avant de tenter de le lire
    if (file_exists($fichier_utilisateurs)) {
        $utilisateurs_connexion = file_get_contents($fichier_utilisateurs);
        $utilisateurs_lignes_connexion = explode("\n", $utilisateurs_connexion);

        // Chemin vers le fichier de la galerie
        $file = 'list_galerie.txt';

        foreach ($utilisateurs_lignes_connexion as $ligne) {
            // Afficher la ligne pour le débogage
            error_log("Ligne brute : $ligne");

            // Vérifier que la ligne n'est pas vide
            if (trim($ligne) !== '') {
                $infos_utilisateur = explode(",", $ligne);
                error_log("Nombre de champs : " . count($infos_utilisateur));

                // Vérifier que la ligne contient les informations nécessaires
                if (count($infos_utilisateur) > 5) {
                    $id = $infos_utilisateur[1];
                    $nb_abo = $infos_utilisateur[5];
                    $uploadDirectory = 'user_drawing/' . $id . '/';

                    if ($nb_abo == 0) {
                        $imagePath = $uploadDirectory . 'img-1.png';
                        if (file_exists($imagePath)) {
                            $data = $id . ',' . $imagePath . PHP_EOL;
                            file_put_contents($file, $data, FILE_APPEND | LOCK_EX);
                        }
                    } elseif ($nb_abo == 1) {
                        $imageCount = 1;

                        while (true) {
                            $imagePath = $uploadDirectory . 'img-' . $imageCount . '.png';
                            error_log('<div class="image-container">');
                            if (file_exists($imagePath)) {
                                error_log("<img src='$imagePath' alt='Drawing'>");
                                $imageCount++;

                                // Écrire les données dans le fichier
                                $data = $id . ',' . $imagePath . PHP_EOL;
                                file_put_contents($file, $data, FILE_APPEND | LOCK_EX);
                            } else {
                                break;
                            }
                            error_log('</div>');
                        }
                    }
                } else {
                    error_log("Ligne invalide ou incomplète : $ligne");
                }
            }
        }
    } else {
        error_log("Le fichier utilisateurs n'existe pas.");
    }
    ?>



</body></html>