<?php
$fichier = 'utilisateurs.txt';
$email_exist = false;
if (file_exists($fichier)) {
    $lignes = file($fichier);
    foreach ($lignes as $ligne) {
        $utilisateur = explode(';', $ligne);
        if ($utilisateur[0] === $_POST['email']) {
            $email_exist = true;
            break;
        }
    }
}
?>