<?php

// Récupérer l'identifiant utilisateur depuis $_SESSION['user_id']
$user_id = $_SESSION['user_id'];

$chemin_fichier = '../../dataU/utilisateurs.txt';
$donnees = file($chemin_fichier);

function get_user_data($file, $id){
    $content = file_get_contents($file);
    $lines = explode(PHP_EOL, $content);
    foreach($lines as $line){
        $data = explode(',', $line);

        if (isset($data[1]) && $data[1] === $id) {
            return $line;
        }
    }    
return null;
}

$lineToUpdate = get_user_data($chemin_fichier, $user_id);
if ($lineToUpdate !== null) {

    $data = explode(',', $lineToUpdate);
    $data[5] = '1';

    $nouvelleLigne = implode(',', $data);

    $content = file_get_contents($chemin_fichier);

    $nouveauContenu = str_replace($lineToUpdate, $nouvelleLigne, $content);

    file_put_contents($chemin_fichier, $nouveauContenu);
     echo "Vous etes abonné, merci.";
}

else{
    echo "L'utilisateur n'a pas été trouvé.";
}

?>
