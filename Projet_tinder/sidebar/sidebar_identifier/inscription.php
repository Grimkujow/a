
<form action="inscription.php" method="post">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
    <
    <button type="submit">S'inscrire</button>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) && isset($_POST["mot_de_passe"])) {
    $email = $_POST["email"];
    $mot_de_passe = password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT);

    // Vérifier si l'email existe déjà dans le fichier
    $utilisateurs = file_get_contents("../../dataU/utilisateurs.txt");
    $utilisateurs_lignes = explode("\n", $utilisateurs);
    $email_existe = false;
    foreach ($utilisateurs_lignes as $ligne) {
        $infos_utilisateur = explode(",", $ligne);
        if ($infos_utilisateur[0] == $email) {
            $email_existe = true;
            break;
        }
    }

    // Si l'email n'existe pas déjà, enregistrer les informations de l'utilisateur dans le fichier texte
    if (!$email_existe) {
        $nouvelle_ligne = "$email,$mot_de_passe\n"; // Crée une ligne CSV avec email et mot de passe
        file_put_contents("../../dataU/utilisateurs.txt", $nouvelle_ligne, FILE_APPEND);
        echo "Les informations de l'utilisateur ont été enregistrées avec succès.";
        echo '<script>window.location.href = "identifier.php";</script>';
        exit();
    } else {
        echo "Cet email est déjà utilisé. Veuillez en choisir un autre.";
    }
}
?>
