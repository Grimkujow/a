<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
<title>Envoyer un message</title>
        <meta charset="UTF-8">
      <link rel="shortcut icon" href="main_image/logo.png">
      <link rel="stylesheet" type="text/css" href="../sidebar_css.css">
      <script src="script.js"></script>
    </head>
    <body>
      <?php include('../sidebar.php'); ?>




  <style>
      .margin-example {
          margin-left: 200px;
      }
      .padding-example {
          padding-left: 200px;
      }
      .pre-example {
          white-space: pre;
      }
      .pre-line-example {
          white-space: pre-line;
      }
      .pre-wrap-example {
          white-space: pre-wrap;
      }
  </style>


  

</head>

<body>

    <div class="content">
      <div class="content-header">
          <h4 class="my-0 font-weight-normal">Messagerie</h4>
      </div><br>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Restaure les valeurs des champs du formulaire
            const inputs = document.querySelectorAll("input, textarea");
            inputs.forEach(input => {
                const savedValue = localStorage.getItem(input.name);
                if (savedValue) {
                    input.value = savedValue;
                }

                // Sauvegarde les valeurs des champs à chaque changement
                input.addEventListener("input", function() {
                    localStorage.setItem(input.name, input.value);
                });
            });
        });

        // Fonction pour nettoyer le localStorage lors de l'envoi du formulaire
        function clearLocalStorage() {
            const inputs = document.querySelectorAll("input, textarea");
            inputs.forEach(input => {
                localStorage.removeItem(input.name);
            });
        }
    </script>


    
<?php

  $resultat = "";
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
      // Vérifier si le champ texte est défini et non vide
      if (isset($_POST['texte']) && !empty($_POST['texte'])) {
         
          // Récupérer et sécuriser le texte saisi par l'utilisateur
          $texte = htmlspecialchars($_POST['texte'], ENT_QUOTES, 'UTF-8');

          // Stocker le texte saisi dans une variable de session si nécessaire
          $_SESSION['texte'] = $texte;

          // Utiliser le texte (par exemple, afficher le texte saisi)
          $resultat = $texte;
      } else {//cas champ vide
        
          
      }
  }




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
    function couper1($line, $fieldNumber) {
      //renvoie nULL si erreur
      // Diviser la ligne en champs à l'aide de ##1 comme délimiteur
        $fields = explode('##1', $line);

      // Vérifier si le numéro de champ demandé est valide
        if (isset($fields[$fieldNumber])) {
           return $fields[$fieldNumber];
        } else {
           return null;
        }}
    function couper2($line, $fieldNumber) {
      //renvoie nULL si erreur
      // Diviser la ligne en champs à l'aide de ##2 comme délimiteur
        $fields = explode('##2', $line);

      // Vérifie si le numéro de champ demandé est valide
        if (isset($fields[$fieldNumber])) {
           return $fields[$fieldNumber];
        } else {
           return null;
        }}

  function trierChaines($chaine1, $chaine2) {
      // Compare les chaînes
      if (strcmp($chaine1, $chaine2) < 0) {
          // chaine1 est avant chaine2
          return [$chaine1, $chaine2];
      } else {
          // chaine2 est avant chaine1
          return [$chaine2, $chaine1];
      }
  }

//echo("<br> $resultat <br>");
  
  $expediteur =  $_SESSION['user_id']; //correction
  $destinataire = $_SESSION['destinataire']; // destinataire
    //$destdexu = $_SESSION['destinataire'];
    
  //hna 664b6f4e1c237
  //sjui 664b784f0695b
  //on crée le fichier de discussion avec les deux pseudo impliqués par ordre alphabétique
  $numutilisateur=1;
  $changement=0;//cette variable est modifié s'il y a changement de ##num 
  $nomabc = trierChaines($expediteur,$destinataire) ;
    if (strcmp($expediteur, $nomabc[0]))
         {
        
         $numutilisateur=1;
         }
    else 
         {
         $numutilisateur=2;
         }
  
  $ndata ='../dataU/utilisateurs.txt';//chemin du fichier des données
  $ndiscu ="../dataU/$nomabc[0]_$nomabc[1].txt";
  $fichier = fopen($ndiscu, 'c+');
  fwrite($fichier,"");
  //echo "$expediteur <br> $destinataire <br>";



    function retrouvenom($id) {
      $data ='../dataU/utilisateurs.txt';//chemin du fichier des données
      $fichier = fopen ($data,'r');
      if ($fichier){
      while (($ligne = fgets($fichier)) !== false) {
        if (estContenue($id,$ligne)){
            $nom=couper($ligne,2);
            fclose($fichier);
            return $nom;}

      }

        fclose($fichier);
        return false;
      }
       echo("ERREUR ouverture fichier<br>");
      return false;

      }
    
    $ndest = retrouvenom($destinataire);
    
  echo "Votre discussion avec $ndest :<br>";
  //les messages de chque personne seront délimités par "##1" pour la personne 1 (selon l'ordre alphabétique) et ""##2" pr la personne 2
  // les messages de l'autre utilisateur seront affiché à gauche
  // il sera impossible d'écrire ces caractères dans les messages -> renvoie une erreur
  while (($ligne = fgets($fichier)) !== false) {
    // cas ou  ##1 delimite
      if (estContenue("##1",$ligne)){
          $lignepropre=couper1($ligne,1);
        if ($numutilisateur==1){//messages de l'utilisateurs donc affichés à droite 
                echo '<div class="margin-example">'.$lignepropre.'</div>';          
       }
        else {
          //messages de l'autre personne donc affichés à gauche 
                  echo "$lignepropre<br>";          
        }}
  else if(estContenue("##2",$ligne)) {// cas ##2
                                      $lignepropre=couper2($ligne,1);
                                      if ($numutilisateur==2){//messages de l'utilisateurs donc affichés à droite 

                                              echo '<div class="padding-example">'.$lignepropre.'</div>';

                                      }
                                      else {
                                        //messages de l'autre personne donc affichés à gauche 
                                                echo "$lignepropre<br>";          
                                      }}
  } 
    fclose($fichier);
          
  
      
      
  
  
    ?>
  <br>
  <form action="" method="post" onsubmit="clearLocalStorage()"> 
      <label for="texte">Saisissez un nouveau message :</label>
      <input type="text" id="texte" name="texte" value="<?php echo isset($_POST['texte']) ? htmlspecialchars($_POST['texte'], ENT_QUOTES, 'UTF-8') : ''; ?>">
      <input type="submit" value="Envoyer">
  </form>
  <div id="resultat">
   <?php 
      if (isset($_POST['texte']) && !empty($_POST['texte'])){
          if(estContenue("##1",$resultat) ||  estContenue("##2",$resultat)){
              echo "Impossible d'écrire ##1 ou ##2 dans vos messages!";
          }
          else{
    //echo " salut$resultat";
              $fichier = fopen($ndiscu, 'c+');
              while (($ligne = fgets($fichier)) !== false){}
    fwrite($fichier,"##$numutilisateur$resultat##$numutilisateur\n");
          fclose($fichier);}
      
      //rafraichi la discussion
          
          echo '<script type="text/javascript">
                    
                  window.location.href = "https://07c68c8e-e21b-49ff-9bb6-5e6cf661bb11-00-1ags24xyja8yh.kirk.replit.dev/Projet_tinder/messagerie/systeme.php";
                  
                </script>';
          exit();
      
      }
      
  //$texto=$_SESSION['msgenvoi'];
  //echo "$texto";
    ?> 
<br><br>
          <button class="btn">
            <span class="button-content">
          <a href="../index.php" class="custom-link">Revenir en arrière</a>
                      </span>
                  </button>

          </div>
</body>