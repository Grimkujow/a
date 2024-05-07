<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
</head>
<body>
    <h1>Bienvenue sur notre site</h1>

    <!-- Formulaire de connexion -->
    <div id="loginForm" style="display: none;">
        <h2>Connexion</h2>
        <form id="connexionForm" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required><br>
            <input type="submit" value="Se connecter">
        </form>
    </div>

    <!-- Formulaire d'inscription -->
    <div id="inscriptionForm" style="display: none;">
        <h2>Inscription</h2>
        <form id="inscriptionForm" method="post">
            <label for="pseudo">Pseudo:</label>
            <input type="text" id="pseudo" name="pseudo" required><br>
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" required><br>
            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" required><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required><br>
            <input type="submit" value="S'inscrire">
        </form>
    </div>

    <script>
        // Affiche le formulaire de connexion ou d'inscription en fonction de l'existence de l'adresse e-mail
        function afficherFormulaire() {
            var email = document.getElementById("email").value;

            // Utilisation de PHP pour vérifier si l'e-mail existe dans le fichier texte
            <?php
            $fichier = 'utilisateurs.txt';
            $email_exist = false;
            if (file_exists($fichier)) {
                $lignes = file($fichier);
                foreach ($lignes as $ligne) {
                    $utilisateur = explode(';', $ligne);
                    if ($utilisateur[0] === $email) {
                        $email_exist = true;
                        break;
                    }
                }
            }
            ?>

            if (<?php echo ($email_exist ? 'true' : 'false'); ?>) {
                // L'e-mail existe, affiche le formulaire de connexion
                document.getElementById("loginForm").style.display = "block";
            } else {
                // L'e-mail n'existe pas, affiche le formulaire d'inscription
                document.getElementById("inscriptionForm").style.display = "block";
            }
        }

        // Appel de la fonction pour afficher le bon formulaire
        afficherFormulaire();
    </script>

    <?php
    // Traitement du formulaire d'inscription
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Vérifie si les données ont été soumises par le formulaire d'inscription
        if (isset($_POST['pseudo']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['password'])) {
            // Récupère les valeurs des champs du formulaire
            $pseudo = $_POST['pseudo'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Ajoute l'utilisateur au fichier texte des utilisateurs
            $fichier = 'utilisateurs.txt';
            $utilisateur = "$email;$pseudo;$nom;$prenom;$password" . PHP_EOL;
            file_put_contents($fichier, $utilisateur, FILE_APPEND);

            // Redirige vers une autre page après l'inscription
            header("Location: page_inscription_reussie.php");
            exit();
        }
    }
    ?>
</body>
</html>