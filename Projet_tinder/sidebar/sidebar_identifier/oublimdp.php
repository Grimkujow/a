<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>déestinés</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="shortcut icon" href="../../main_image/logo.png">
    <link rel="stylesheet" type="text/css" href="../../sidebar_css.css">
</head>
<body>
    <?php include('../../sidebar.php'); ?>
    <div class="content">
        <?php
            $file = '../../dataU/utilisateurs.txt';

            function exist_email($file, $mail){
                $content = file_get_contents($file);
                $lines = explode(PHP_EOL, $content);
                foreach($lines as $line){
                    $data = explode(',', $line);

                    if (isset($data[0]) && $data[0] === $mail) {
                        return true;
                    }
                }    
                return false;
            }

        function get_user_data($file, $mail){
            $content = file_get_contents($file);
            $lines = explode(PHP_EOL, $content);
            foreach($lines as $line){
                $data = explode(',', $line);

                if (isset($data[0]) && $data[0] === $mail) {
                    return $line;
                }
            }    
            return null;
        }

            function generate_password() {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomPassword = '';

                for ($i = 0; $i < 9; $i++) {
                    $randomPassword .= $characters[rand(0, $charactersLength - 1)]; //opérateur de concaténation 
                }

                return $randomPassword;
            }

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                if (isset($_POST['forgotten'])) {
                    $email = $_POST['forgotten'];
                    if(exist_email($file, $email)){
                        $newmdp = generate_password();
                        $hashedPassword = password_hash($newmdp, PASSWORD_DEFAULT);
                        $lineToUpdate = get_user_data($file, $email);
                        $data = explode(',', $lineToUpdate);
                        $data[3] = $hashedPassword;
                        $nouvelleLigne = implode(',', $data);
                        $content = file_get_contents($file);
                        $nouveauContenu = str_replace($lineToUpdate, $nouvelleLigne, $content);
                        file_put_contents($file, $nouveauContenu);

                        echo "<p>Votre nouveau mot de passe est : $newmdp</p> <br>";
                    } 
                    else {
                            echo "<p style=\"color:red;\">L'adresse e-mail fournie n'existe pas dans la base de données actuelle. </p><br>";
                        }
                }
            }
        ?>
        
        <div class="content-header">
            <h4 class="my-0 font-weight-normal">Vérification de l'adresse mail</h4>
        </div><br>
        <form action="" method="post" > 
              <label for="texte">Saisissez votre adresse-mail :</label>
              <input type="text" id="mailforgotten" name="forgotten">
              <input type="submit" value="Envoyer">
        </form><br>
        <a class="btn" href="identifier.php" class="custom-link">Retour à la page de connexion</a>
    </div>
</body>
</html>