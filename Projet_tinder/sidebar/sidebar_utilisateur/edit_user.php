<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="shortcut icon" href="../../main_image/logo.png">
    <link rel="stylesheet" type="text/css" href="../../sidebar_css.css">
    <title>DrawnTogether</title>
</head>
<body>
    <?php include('../../sidebar.php'); ?>
    <div class="content">
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
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['modification'])) {
                    $modification = $_POST['modification'];
                    $nouvelle_valeur = $_POST['nouvelle_valeur'];
                    
                    $id = $_SESSION['user_id'];
                    $lineToUpdate = get_user_data($file, $id);
                    $data = explode(',', $lineToUpdate);

                    if ($lineToUpdate !== null) {
                        if ($modification === 'pseudo') {
                            $data[2] = $nouvelle_valeur;
                        } 
                        elseif ($modification === 'mail') {
                            $data[0] = $nouvelle_valeur;
                        }
                        elseif ($modification === 'mot_de_passe') {
                            $data[3] = password_hash($nouvelle_valeur, PASSWORD_DEFAULT);
                        } 
                        elseif ($modification === 'ville') {
                            $data[8] = $nouvelle_valeur;
                        }
                    }

                    $nouvelleLigne = implode(',', $data);

                    $content = file_get_contents($file);

                    $nouveauContenu = str_replace($lineToUpdate, $nouvelleLigne, $content);

                    file_put_contents($file, $nouveauContenu);

                    echo "<p style=\"color:green;\">Les modifications ont été enregistrées avec succès pour l'utilisateur $nouveauPseudo</p>";

                } 
                    else {
                    echo "<p style=\"color:red;\">Erreur : L'utilisateur avec l'identifiant $id n'existe pas</p>";
                }
            }
        ?>

        <h1>Modifier le profil</h1>
                <form method="post" action="">
                    <p>Que voulez-vous modifier ? </p>
                    <input type="radio" id="pseudo" name="modification" value="pseudo">
                    <label for="pseudo">Pseudo</label><br>
                    <input type="radio" id="mail" name="modification" value="mail">
                    <label for="mail">Adresse e-mail</label><br>
                    <input type="radio" id="mot_de_passe" name="modification" value="mot_de_passe">
                    <label for="mot_de_passe">Mot de passe</label><br>
                    <input type="radio" id="ville" name="modification" value="ville">
                    <label for="ville">Ville</label><br><br>

                    <label for="nouvelle_valeur">Nouvelle valeur :</label><br>
                    <input type="text" id="nouvelle_valeur" name="nouvelle_valeur"><br><br>

                    <input type="submit" value="Modifier">
                </form>

                <form action="utilisateur.php" method="post">
                    <button type="submit" name="retour_profil">Retour au profil</button>
                </form>
                
    </div>
</body>
</html>