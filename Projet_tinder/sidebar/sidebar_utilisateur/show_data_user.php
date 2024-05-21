<?php
$file = "../../dataU/utilisateurs.txt";

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

$id = $_SESSION['user_id'];

$user_ligne = get_user_data($file, $id);

if ($user_ligne !== null) {
    $data = explode(',', $user_ligne);
    $email = $data[0];
    $sexe = $data[4];
    $pseudo = $data[2];
    $age = $data[7];
    $ville = $data[8];
    echo "<p style='font-family: Arial, sans-serif; font-size: 20px; text-align: center;'> <span style='color: black;'>Bienvenue</span> <span style='color: white;'>$pseudo </span>!</p>";

    echo "Adresse mail : $email<br>";
    echo "Pseudo : $pseudo<br>";
    echo "Sexe : $sexe<br>";
    echo "Age : $age<br>";
    echo "Ville : $ville<br>";
} else {
    echo "L'utilisateur associé à cet identifiant de session n'a pas été trouvé.";
}

?>