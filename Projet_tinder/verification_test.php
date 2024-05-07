<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('verifier_email.php'); ?>
    <title>Page d'accueil</title>
</head>
<body>
    <h1>Veuillez vous identifier</h1>

    <form id="emailForm" method="post">
        <label for="email">Adresse e-mail :</label><br><br>
        <input type="email" id="email" name="email" placeholder="Entrez votre adresse e-mail" required><br>
        <small>Exemple : votreadresse@example.com</small><br><br>

        <input type="submit" value="Continuer">
    </form>

    <script>
        document.getElementById("emailForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Empêche le formulaire de se soumettre

            var email = document.getElementById("email").value;

            // Envoyer l'adresse e-mail au serveur pour vérification
            fetch("verifier_email.php", {
                method: "POST",
                body: JSON.stringify({ email: email }),
                headers: {
                    "Content-Type": "application/json"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.emailExist) {
                    // L'e-mail existe, affiche le formulaire de connexion
                    document.getElementById("loginForm").style.display = "block";
                } else {
                    // L'e-mail n'existe pas, affiche le formulaire d'inscription
                    document.getElementById("inscriptionForm").style.display = "block";
                }
            })
            .catch(error => console.error("Erreur lors de la vérification de l'e-mail:", error));
        });
    </script>

    <!-- Formulaire de connexion -->
    <div id="loginForm" style="display: none;">
        <h2>Connexion</h2>
        <form id="connexionForm" method="post">
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

    <!--<script>
       function afficherFormulaire(emailExist) {
            if (emailExist) {
                // L'e-mail existe, affiche le formulaire de connexion
                document.getElementById("loginForm").style.display = "block";
            } else {
                // L'e-mail n'existe pas, affiche le formulaire d'inscription
                document.getElementById("inscriptionForm").style.display = "block";
            }
        }

        // Appel de la fonction pour afficher le bon formulaire
        afficherFormulaire(<?php echo ($email_exist ? 'true' : 'false'); ?>);
        
    </script>-->

</body>
</html>