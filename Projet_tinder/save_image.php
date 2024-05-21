<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si le champ imageData est défini dans $_POST
    if (isset($_POST['imageData'])) {
        $uploadDirectory = 'sidebar/sidebar_utilisateur/user_drawing/';

        // Pour créer un répertoire si il le trouve pas/existe pas
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        // Récupérer les données de l'image envoyée depuis le formulaire
        $imageData = $_POST['imageData'];

        $id = $_SESSION['user_id'];

        $fileName = $id . '.png';

        $filePath = $uploadDirectory . $fileName;

        // Enregistrer l'image sur le serveur
        if (file_put_contents($filePath, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData)))) {
            header('Location: /Projet_tinder/index.php');
        } else {
            // Échec de l'enregistrement de l'image
            echo "Erreur: Impossible de sauvegarder l'image.";
        }
    } else {
        // Le champ imageData n'est pas défini dans $_POST
        echo "Erreur: Champ imageData non défini dans le formulaire.";
    }
} else {
    // La requête n'est pas une requête POST
    echo "Erreur: Cette page ne peut être accédée que par une requête POST.";
}

