<form id="emailForm" method="post">
    <label for="pseudo">Pseudo :</label><br><br>
    <input type="pseudo" id="pseudo" name="pseudo" placeholder="Pseudo" required><br><form action="inscription.php" method="post">
    <small>Exemple : pseudo</small><br><br>
    Mot de passe : <br><br><input type="password" name="mot_de_passe" placeholder="Mot de passe" required><br><br>
    <input type="submit" value="Continuer">
</form>
    
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pseudo"]) && isset($_POST["mot_de_passe"])) {
$pseudo = $_POST["pseudo"];
$mot_de_passe = $_POST["mot_de_passe"];
$droits = 0; // 0 pour utilisateur, 1 pour abonné, 2 pour Admin;
$connexion_erreur = 1;
// Vérifier si l'email existe déjà dans le fichier
$utilisateurs_connexion = file_get_contents("../../dataU/utilisateurs.txt");
$utilisateurs_lignes_connexion = explode("\n", $utilisateurs_connexion);
    foreach ($utilisateurs_lignes_connexion as $ligne) {
        $infos_utilisateur = explode(",", $ligne);
        if ($infos_utilisateur[2] == $pseudo) {
            $vrai_pseudo = $infos_utilisateur[2];
            $vrai_mot_de_passe = $infos_utilisateur[3];
            if (password_verify($mot_de_passe, $vrai_mot_de_passe)) {
                $connexion_erreur = 0; // a voir quoi faire avec
                echo "Connexion verifiée \n";
                $_SESSION['user_id'] = $infos_utilisateur[1];
                $_SESSION['pseudo'] = $infos_utilisateur[2];
                $_SESSION['loggedin'] = true;
                exit();
            }
            $connexion_erreur = 2;
            echo " \n";
            echo "<p style=\"color:red;\">Mot de passe non reconnu, veuillez réessayer</p>";

        }
    }
    if($connexion_erreur == 1){
        echo "Pseudo non reconnu, veuillez vous inscrire\n";
    }
}

    ?>