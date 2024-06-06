<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Choisir une discussion</title>
</head>
<body>
    <?php
    

    $_SESSION['destinataire'] = 'JeanDupont';
    $ndata ='../dataU/utilisateurs.txt';//chemin du fichier des données

    







    function estContenue($sousChaine, $chaine) {//fonction explicite

          if (strpos($chaine, $sousChaine) !== false) {
              return true;
          } else {
              return false;
          }
      }

      function couper($line, $fieldNumber) {
      //renvoie nULL si erreur
      // Diviser la ligne en champs à l'aide de la virgule comme délimiteur
        $fields = explode(',', $line);

      // Vérifier si le numéro de champ demandé est valide
        if (isset($fields[$fieldNumber])) {
           return $fields[$fieldNumber];
        } else {
           return null;
        }}


    $resultat = "";
      if ($_SERVER["REQUEST_METHOD"] === "POST") {
          // Vérifie si le champ texte est défini et non vide
          if (isset($_POST['texte']) && !empty($_POST['texte'])) {

              // Récupére et sécuriser le texte saisi par l'utilisateur
              $texte = htmlspecialchars($_POST['texte'], ENT_QUOTES, 'UTF-8');


              
              $resultat = $texte;


            $fichier = fopen($ndata, 'r');
               while (($ligne = fgets($fichier)) !== false) {
             if(estContenue($resultat,couper($ligne,2))){
                 $_SESSION['destinataire'] = couper($ligne,1);
                 //envoie sur l'autre page
                 echo '<script type="text/javascript">

                           window.location.href = "https://07c68c8e-e21b-49ff-9bb6-5e6cf661bb11-00-1ags24xyja8yh.kirk.replit.dev/Projet_tinder/messagerie/systeme.php";

                         </script>';
                    fclose($fichier);
                   exit();
                    }}
              fclose($fichier);
                 echo "Personne n'a ce pseudo!";
          }
            
           else {//cas champ vide
        echo "Vous n'avez rien écrit.";

          }
      }
    ?>
    <h1></h1>
    <form action="" method="post" onsubmit="clearLocalStorage()"> 
          <label for="texte">Saisissez le pseudo de votre coup de coeur :</label>
          <input type="text" id="texte" name="texte" value="<?php echo isset($_POST['texte']) ? htmlspecialchars($_POST['texte'], ENT_QUOTES, 'UTF-8') : ''; ?>">
          <input type="submit" value="Envoyer">
      </form>
</body>
</html>
