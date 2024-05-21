<?php 
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
if ($data[5] == 1) {
} else {
    echo "L'utilisateur est déjà abonné.";
}
?>