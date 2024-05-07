<?php
// Vérifie si l'adresse e-mail est soumise
if(isset($_POST['email'])) {
    $email = $_POST['email'];

    // Vérifie si l'adresse e-mail est présente dans la base de données
    // Ici, vous effectuerez votre propre logique pour vérifier l'adresse e-mail dans votre base de données

    // Exemple de vérification basique (à remplacer par votre propre logique)
    $utilisateurs_enregistres = array("utilisateur1@example.com", "utilisateur2@example.com");

    if(in_array($email, $utilisateurs_enregistres)) {
        // L'utilisateur est identifié, redirigez-le vers la page de connexion
        header("Location: page_de_connexion.php");
        exit();
    } else {
        // L'utilisateur n'est pas identifié, redirigez-le vers la page d'inscription
        header("Location: inscription.html");
        exit();
    }
} else {
    // Si aucune adresse e-mail n'est soumise, redirigez l'utilisateur vers la page précédente
    header("Location: page_precedente.php");
    exit();
}
?>