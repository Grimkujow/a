<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
        <meta charset="UTF-8">
        <title>Choisir une discussion</title>
      <link rel="shortcut icon" href="main_image/logo.png">
      <link rel="stylesheet" type="text/css" href="../sidebar_css.css">
      <script src="script.js"></script>
    </head>
    <body>
      <?php include('../sidebar.php'); ?>

  <div class="content">
      <div class="content-header">
          <h4 class="my-0 font-weight-normal">Messagerie</h4>
      </div><br>
    <?php
    
    
    $expediteure =  $_SESSION['user_id'];
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
               $nb=0;


            $fichier = fopen($ndata, 'r');
               while (($ligne = fgets($fichier)) !== false) {
                   if(estContenue($resultat,couper($ligne,2))){
                       if(!(estContenue($expediteure,couper($ligne,1)))){
                           
                                   
                        $_SESSION['destinataire'] = couper($ligne,1);
                        //envoie sur l'autre page
                        
                           
                    $_SESSION['destinataire'] = couper($ligne,1);
                    //envoie sur l'autre page
                    echo '<script type="text/javascript">

                              window.location.href = "systeme.php";

                            </script>';
                       fclose($fichier);
                      exit();
                       }
                       else {//on ne discute pas avec soi meme
                               echo "Impossible de discuter avec soi même!";
                                  $nb=1;
                                break;
                            }

             }}
              fclose($fichier);
              if ($nb==0){
                 echo "Personne n'a ce pseudo!";}
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
        <button class="btn"><input type="submit" value="Envoyer"></button>
      </form>
    <br>
      <button class="btn">
          <span class="button-content">
              <a href="../index.php" class="custom-link">Revenir en arrière</a>
          </span>
      </button>

</body>
  </div>
</html>
