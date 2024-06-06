<?php
session_start();

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
}

else{
    echo "L'utilisateur n'a pas été trouvé.";
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>déestinés</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="shortcut icon" href="../../main_image/logo.png">
    <link rel="stylesheet" type="text/css" href="../../sidebar_css.css">
    <link rel="stylesheet" type="text/css" href="abonnement.css">
</head>
    <body>
        <?php include('../../sidebar.php'); ?>
        <div class="content">
            <h3>Vous avez choisi le premier abonnement, merci !</h3>
            <h4>Paiement : </h4>
            <form action="abonnement.php" method="post">
                <label for="cardNumber">Numéro de carte :</label>
                <input type="text" id="cardNumber" name="cardNumber" pattern="\d{4}/\d{4}/\d{4}/\d{4}" title="Veuillez entrer un numéro de carte valide (format : xxxx/xxxx/xxxx/xxxx)" required>
                <br><br>
                <label for="cardHolder">Nom du titulaire :</label>
                <input type="text" id="cardHolder" name="cardHolder" style="text-transform: uppercase;"required>
                <br><br>
                <label for="expirationDate">Date d'expiration :</label>
                <input type="text" id="expirationDate" name="expirationDate" pattern="(0[1-9]|1[0-2])/\d{2}" title="Veuillez entrer une date d'expiration valide (format : MM/AA)" required>
                <br><br>
                <label for="cvv">CVV :</label>
                <input type="text" id="cvv" name="cvv" pattern="\d{3}" title="Veuillez entrer un code CVV à 3 chiffres" required>
                <br><br>
                <button type="submit">Payer</button>
            </form>

        </div>

    </body>
</html>
