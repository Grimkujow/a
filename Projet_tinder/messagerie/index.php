<?php session_start(); ?>
<!DOCTYPE html>
<!--  cette page sera accessible depuis la page principale du site  -->
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Messagerie</title>
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" href="main_image/logo.png">
  <link rel="stylesheet" type="text/css" href="../sidebar_css.css">
  <script src="script.js"></script>
</head>
<body>
  <?php include('../sidebar.php'); ?>
  <?php include('../sidebar/sidebar_abonnement/session_abo.php'); ?>
  <div class="content">
      <div class="content-header">
          <h4 class="my-0 font-weight-normal">Messagerie</h4>
      </div><br>
  <?php

  $expediteure =  $_SESSION['user_id'];
  $_SESSION['destinataire'] = 'JeanDupont';
  $ndata ='../dataU/utilisateurs.txt';//chemin du fichier des données
  //$_SESSION['nomdest'] = 'JeanDupont';//nom en toutes lettres du destinataire
 
  



  





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

  function coupertiret($line, $fieldNumber) {
  //renvoie nULL si erreur
  // Diviser la ligne en champs à l'aide du tiret du bas comme délimiteur
    $fields = explode('_', $line);

  // Vérifier si le numéro de champ demandé est valide
    if (isset($fields[$fieldNumber])) {
       return $fields[$fieldNumber];
    } else {
       return null;
    }}

  function couperpoint($line, $fieldNumber) {
  //renvoie nULL si erreur
  // Diviser la ligne en champs à l'aide du . comme délimiteur
    $fields = explode('.', $line);

  // Vérifier si le numéro de champ demandé est valide
    if (isset($fields[$fieldNumber])) {
       return $fields[$fieldNumber];
    } else {
       return null;
    }}
  
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
  

   
    echo (" <br><br> <h4>Vos dicussions :</h4><br>");
  $directory = '../dataU'; // Remplacez par le chemin de votre répertoire

  // Ouvre le répertoire
  if (is_dir($directory)) {
      if ($dirHandle = opendir($directory)) {
          // Lit les fichiers et les dossiers dans le répertoire
          while (($file = readdir($dirHandle)) !== false) {
              // Ignore les entrées spéciales "." et ".."
              if ($file != '.' && $file != '..') {
                  if (estContenue($expediteure,$file)){// les dicussions nous concernent
                          $id1=coupertiret($file,0);
                          $id2=coupertiret($file,1);
                          $id2=couperpoint($id2,0);//enlève.txt
                           //echo("$nom $id1 $id2 $expediteure <br>");
                          $bonid=$id1;
                          if (!(estContenue($expediteure,$id2))){
                            
                            $bonid=$id2;
                          }//maintenant l'id a rechrcher est bonne
                          $nom=retrouvenom($bonid);//trouve le nom assoicé à l'id
                            if($nom == false){
                              
                              echo("ERREUR NOM INTROUVABLE LIGNE 118 <br>");
                              echo("$nom $id1 $id2 $expediteure <br>");
                            }
                          else {
                            //$_POST['texte']=$nom;
                            echo '<li><a href="#" onclick="executePHP(\''. htmlspecialchars($nom, ENT_QUOTES, 'UTF-8') . '\')">' . htmlspecialchars($nom, ENT_QUOTES, 'UTF-8') . '</a></li>';
                             
                          }                            
                          
                          
                  }
                
              }
            
          }
          // Ferme le répertoire
          closedir($dirHandle);
      } else {
          echo "Impossible d'ouvrir dataU.";
      }
  } else {
      echo "Le chemin spécifié vers dataU n'est pas un répertoire.";
  }

    // Code PHP pour traiter les données envoyées par AJAX
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['texte']) && !empty($_POST['texte'])) {
            $texte = htmlspecialchars($_POST['texte'], ENT_QUOTES, 'UTF-8');
            // Exemple de traitement PHP, ici nous affichons simplement l'option sélectionnée
          $_SESSION['destinataire'] = $nom;
          //envoie sur l'autre page
          echo '<script type="text/javascript">

                    window.location.href = "systeme.php";

                  </script>';
        } else {
            echo "<p>Aucune option sélectionnée.</p>";
        }
    }

?>
  <form id="hiddenForm" action="systeme.php" method="post" style="display: none;">
      <input type="hidden" name="texte" id="hiddenInput">
  </form>

    <script>
        function executePHP(option) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        document.getElementById("result").innerHTML = xhr.responseText;
                    } else {
                        console.error("Une erreur est survenue.");
                    }
                }
            };
            xhr.open("POST", "", true); // Envoie la requête à la même page
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("texte=" + encodeURIComponent(option));
        }
    </script>

  
  

  <br><br>

        <button class="btn">
            <span class="button-content">
                <a href="choixdisc.php" class="custom-link">Démarrer une nouvelle discussion</a>
            </span>
        </button>
        <br><br>
    <button class="btn">
        <span class="button-content">
          <a href="../index.php" class="custom-link">Revenir en arrière</a>
        </span>
    </button>
</body>
</html>