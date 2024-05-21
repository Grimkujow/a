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
        <div class="content-header">
            <h4 class="my-0 font-weight-normal">Inscription</h4>
        </div><br>
<form action="inscription.php" method="post" onsubmit="return verifierForm()">
    Email : <input type="email" name="email" placeholder="Email" required><br>
    Mot de passe : <input type="password" name="mot_de_passe" placeholder="Mot de passe" required><br>
    Pseudo : <input type="pseudo" name="pseudo" placeholder="Pseudo" required><br>
    <label for="age">Âge :</label>
    <input type="number" id="age" name="age" min="0" required><br>
    Ville : <input type="ville" name="ville" placeholder="Ville" required><br>
    Sexe : <input type="radio" name="genre" value="homme" checked>Homme
    <input type="radio" name="genre" value="femme">Femme
    <input type="radio" name="genre" value="autre">Autre<br>
    <button type="submit">S'inscrire</button>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) && isset($_POST["mot_de_passe"])) {
    $email = $_POST["email"];
    $pseudo = $_POST["pseudo"];
    $age = $_POST["age"];
    $ville = $_POST["ville"];
    $id = uniqid('user_', true);
    $mot_de_passe = $_POST["mot_de_passe"];
    $genre = $_POST["genre"];
    $date = date("d-m-Y H:i:s");
    $permission = 0;

    $banned_email = file("../../dataU/ban_users.txt", FILE_IGNORE_NEW_LINES);
    if (in_array($email, $banned_email)) {
        echo "<span style='color: red;'>Cette adresse e-mail est bannie.</span>";
        exit();
    }

    if (strlen($mot_de_passe) < 8) {
        echo "<span style='color: red;'> Le mot de passe doit contenir au moins 8 caractères.</span>";
        exit();
    }
    else{
        $mot_de_passe = password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT);
    }

    // Vérifier si l'email existe déjà dans le fichier
    $utilisateurs_connexion = file_get_contents("../../dataU/utilisateurs.txt");
    $utilisateurs_lignes_connexion = explode("\n", $utilisateurs_connexion);
    $email_existe = false;
    $pseudo_existe = false;

    foreach ($utilisateurs_lignes_connexion as $ligne) {
        $infos_utilisateur = explode(",", $ligne);

        // Vérifier que le tableau contient au moins 3 éléments
        if (count($infos_utilisateur) < 3) {
            continue; // Passer à la ligne suivante si le format est incorrect
        }

        // Vérifier si l'email ou le pseudo existe déjà
        if ($infos_utilisateur[0] == $email) {
            $email_existe = true;
        }
        if ($infos_utilisateur[2] == $pseudo) {
            $pseudo_existe = true;
        }

        // Sortir de la boucle si l'un des deux existe
        if ($email_existe || $pseudo_existe) {
            break;
        }
    }

    if ($email_existe) {
        echo "L'email est déjà utilisé. Veuillez en choisir un autre.";
    } elseif ($pseudo_existe) {
        echo "Le pseudonyme est déjà utilisé. Veuillez en choisir un autre.";
    } else {
        // Code pour ajouter le nouvel utilisateur
        $id = uniqid();
        $genre = $_POST['genre'];
        $permission = 0;
        $date = date('Y-m-d');
        $nouvelle_ligne = "$email,$id,$pseudo,$mot_de_passe,$genre,$permission,$date,$age,$ville\n";
        file_put_contents("../../dataU/utilisateurs.txt", $nouvelle_ligne, FILE_APPEND);
        echo "Inscription réussie!";
        echo '<script>window.location.href = "identifier.php";</script>';
        exit();
    }
}
?>
    <script>
        function verifierForm() {
            var age = document.getElementById("age").value;
            if (age < 18) {
                alert("Vous devez avoir plus de 18 ans pour accéder à ce contenu.");
                return false;
            }
            return true;
        }
    </script>
        <a href="identifier.php" class="custom-link">Connexion</a>
    </div>
</body>
</html>