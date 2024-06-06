<?php

// Désactiver l'affichage des erreurs à l'écran
ini_set('display_errors', 'Off');

// Activer la journalisation des erreurs
ini_set('log_errors', 'On');

// Spécifier un fichier de journalisation relatif dans l'environnement Replit
ini_set('error_log', 'errors.log');

// Définir un gestionnaire d'erreurs personnalisé
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    // Logique de gestion des erreurs personnalisée
    error_log("Erreur [$errno] : $errstr dans le fichier $errfile à la ligne $errline", 3, 'errors.log');
    return true; // Indique que l'erreur a été gérée
});

// Pour le débogage : afficher la valeur de $_SESSION['loggedin']
error_log('$_SESSION[\'loggedin\']: ' . (isset($_SESSION['loggedin']) ? $_SESSION['loggedin'] : 'non défini'));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de la barre latérale</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <ul>
            <li>
                <a href="/Projet_tinder/index.php">
                    <img src="/Projet_tinder/main_image/logo.png" alt="Logo déestinée" class="logosite">
                </a>
            </li>
            <li>
                <button class="btn">
                    <span class="button-content">
                        <a href="/Projet_tinder/sidebar/sidebar_abonnement/abonnement.php" class="custom-link">Abonnements</a>
                    </span>
                </button>
            </li>
            <li>
                <button class="btn <?php echo (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) ? 'hidden' : ''; ?>">
                    <span class="button-content">
                        <a href="/Projet_tinder/sidebar/sidebar_identifier/identifier.php" class="custom-link">S'identifier</a>
                    </span>
                </button>
            </li>
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?> 
            <li>
                <button class="btn">
                    <span class="button-content">
                        <a href="/Projet_tinder/sidebar/sidebar_galerie/galerie.php" class="custom-link">Galerie</a>
                    </span>
                </button>
            </li>
    <?php endif; ?>
            <li>
                <button class="btn">
                    <span class="button-content">
                        <a href="/Projet_tinder/sidebar/sidebar_utilisateur/utilisateur.php" class="custom-link">Utilisateur</a>
                    </span>
                </button>
            </li>
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?> 
            <li>
                <button class="btn">
                    <span class="button-content">
                        <a href="/Projet_tinder/sidebar/sidebar_administrateur/verif_admin.php" class="custom-link">Administrateur</a>
                    </span>
                </button>
            </li>
    <?php endif; ?>
            <li>
                <button class="btn">
                    <span class="button-content">
                        <a href="/Projet_tinder/sidebar/sidebar_contact/contact.php" class="custom-link">Nous contacter</a>
                    </span>
                </button>
            </li>
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?> 
            <li>
                <button class="btn">
                    <span class="button-content">
                        <a href="/Projet_tinder/messagerie/index.php" class="custom-link">Messagerie</a>
                    </span>
                </button>
            </li> 
    <?php endif; ?>
        </ul>
    </div>
</body>
</html>
