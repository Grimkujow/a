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
    <h2>Bienvenue administrateur</h2>
    
        <?php
        
        $file = "../../dataU/utilisateurs.txt";

        $content = file_get_contents($file);

        $lines = explode(PHP_EOL, $content);

        $total_users = count($lines)-1;

        function get_user_data($file, $pseudo){
            $content = file_get_contents($file);
            $lines = explode(PHP_EOL, $content);
            foreach($lines as $line){
                $data = explode(',', $line);

                if (isset($data[2]) && $data[2] === $pseudo) {
                    return $line;
                }
            }    
        return null;
        }

        function remove_user_data($file, $pseudo){
            $lines = file($file, FILE_IGNORE_NEW_LINES);
            global $total_users;

            $email_ban = '';

            foreach ($lines as $key => $ligne) {
                $data = explode(",", $ligne);
                if ($data[2] == $pseudo) {
                    $email_ban = $data[0];
                    unset($lines[$key]);
                    $total_users--;
                }
            }
            if (!empty($email_ban)) {
                file_put_contents('../../dataU/ban_users.txt', $email_ban . PHP_EOL, FILE_APPEND);
            }
            file_put_contents($file, implode(PHP_EOL, $lines));
            file_put_contents($file, PHP_EOL, FILE_APPEND);

            echo "L'utilisateur $pseudo a bien été banni.";
        }

        function show_user_data($file, $pseudo){
            $user_ligne = get_user_data($file, $pseudo);
            if ($user_ligne !== null) {
                $data = explode(',', $user_ligne);
                $email = $data[0];
                $id = $data[1];
                $pseudo = $data[2];
                $mdp = $data[3];
                $sexe = $data[4];
                $date = $data[6];
                $age = $data[7];
                $ville = $data[8];
                echo "<p style='font-family: Arial, sans-serif; font-size: 20px;'> Voici les informations de $pseudo : </p>";
                echo "Adresse mail : $email<br>";
                echo "Id : $id<br>";
                echo "Pseudo : $pseudo<br>";
                echo "Mot de passe : $mdp<br>";
                echo "Sexe : $sexe<br>";
                echo "Date d'inscription : $date<br>";
                echo "Age : $age<br>";
                echo "Ville : $ville<br>";
            } 
            else {
                echo "<p style=\"color:red;\">Erreur : Aucun utilisateur a été sélectionné.</p>";
            }
        }

        function edit_user_data($file, $pseudo){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['modif'])) {
                    $modification = $_POST['modif'];
                    $nouvelle_valeur = $_POST['nouvelle_valeur'];

                    $lineToUpdate = get_user_data($file, $pseudo);
                    if ($lineToUpdate !== null) {
                        $data = explode(',', $lineToUpdate);
                        switch ($modification) {
                            case 'date':
                                $data[6] = $nouvelle_valeur;
                                break;
                            case 'pseudo':
                                $data[2] = $nouvelle_valeur;
                                break;
                            case 'mail':
                                $data[0] = $nouvelle_valeur;
                                break;
                            case 'mot_de_passe':
                                $data[3] = password_hash($nouvelle_valeur, PASSWORD_DEFAULT);
                                break;
                            case 'ville':
                                $data[8] = $nouvelle_valeur;
                                break;
                            default:
                                break;
                        }

                        $nouvelleLigne = implode(',', $data);

                        $content = file_get_contents($file);

                        $nouveauContenu = str_replace($lineToUpdate, $nouvelleLigne, $content);

                        file_put_contents($file, $nouveauContenu);

                        echo "<p style=\"color:green;\">Les modifications ont été enregistrées avec succès pour l'utilisateur $nouvelle_valeur</p>";
                    } 
                }
            }
                
                
        }

          
        
        if ($total_users !== 0) {
            echo '<form id="userForm" method="post" action="">';
            echo '<h3>Liste des ' . $total_users . ' utilisateurs :</h3>';
            echo '<select id="userSelect" name="application" required size="' . 15 . '">';
            foreach ($lines as $line) {
                $data = explode(',', $line);
                if (isset($data[2])) {
                    $pseudo = $data[2];
                    echo '<option value="' . $pseudo . '">' . $pseudo . '</option>';
                }
            }
            echo '</select>';
            echo '</form>';
        }
                    
        else{
            echo "Aucun utilisateur n'est enregistré !\n";
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['modification'])) {
                $modification = $_POST['modification'];
                $pseudo = $_POST['pseudo'];
                if ($modification === 'ban') {
                    remove_user_data($file, $pseudo);
                } 
                elseif ($modification === 'edit') {
                    echo '<form id="editForm" method="post" action="">';
                    echo "<p style='font-family: Arial, sans-serif; font-size: 20px;'> Que voulez-vous modifier chez $pseudo ? </p>";
                    echo '<input type="radio" id="modif_pseudo" name="modif" value="pseudo">';
                    echo '<label for="modif_pseudo">Pseudo</label><br>';
                    echo '<input type="radio" id="modif_date" name="modif" value="date">';
                    echo '<label for="modif_date">Date dinscription</label><br>';
                    echo '<input type="radio" id="modif_mail" name="modif" value="mail">';
                    echo '<label for="modif_mail">Adresse e-mail</label><br>';
                    echo '<input type="radio" id="modif_mot_de_passe" name="modif" value="mot_de_passe">';
                    echo '<label for="modif_mot_de_passe">Mot de passe</label><br>';
                    echo '<input type="radio" id="modif_ville" name="modif" value="ville">';
                    echo '<label for="modif_ville">Ville</label><br><br>';

                    echo '<label for="nouvelle_valeur">Nouvelle valeur :</label><br>';
                    echo '<input type="text" id="nouvelle_valeur" name="nouvelle_valeur"><br><br>';

                    echo '<input type="hidden" name="pseudo" value="' . $_POST['pseudo'] . '">';
                    echo '<input type="submit" value="Modifier">';
                    echo '</form> <br>';
                }
                elseif ($modification === 'show') {
                    show_user_data($file, $pseudo);
                } 
            }
            elseif (isset($_POST['modif'])) {
                $pseudo = $_POST['pseudo'];
                $modification = $_POST['modif'];
                $nouvelle_valeur = $_POST['nouvelle_valeur'];
                edit_user_data($file, $pseudo);
            }
        }
        
        ?>

        <form method="post" action="">
            <h4>Que voulez-vous faire ?</h4>
            <input type="radio" id="ban" name="modification" value="ban">
            <label for="ban">Bannir un membre</label><br>
            <input type="radio" id="edit" name="modification" value="edit">
            <label for="edit">Modifier les données d'un membre</label><br>
            <input type="radio" id="show" name="modification" value="show">
            <label for="show">Accéder à l'intégralité des données d'un membre</label><br><br>

            <input type="hidden" id="pseudoHidden" name="pseudo">

            <input type="submit" value="Accéder">
        </form>

            <script>
                document.getElementById('userSelect').addEventListener('change', function() {
                    var selectedUser = this.value;
                    var hiddenInput = document.getElementById('pseudoHidden');
                    hiddenInput.value = selectedUser;
                });

                document.getElementById('editForm').addEventListener('submit', function() {
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                });
            </script>
        
    </div>
</body>
</html>