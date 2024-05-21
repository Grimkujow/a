<!DOCTYPE html>
<html>
<head>
<title>Envoyer un message</title>
  <meta charset="UTF-8">
</head>

<body>
  

    <form action="/Projet_tinder/messagerie/choixdisc.php" method="post">
      <label for="destinataire">Avec qui discuter?</label>
      <select name="destinataire" id="destinataire">
        <?php 
          $nfich ='../dataU/utilisateurs.txt';//chemin du fichier des données
        if (file_exists($nfich)) {
            $fichier = fopen($nfich, 'r');
            function couper($line, $fieldNumber) {
              //renvoie nULL si erreur
              // Diviser la ligne en champs à l'aide de la virgule comme délimiteur
                $fields = explode(',', $line);

              // Vérifier si le numéro de champ demandé est valide
                if (isset($fields[$fieldNumber])) {
                   return $fields[$fieldNumber];
                } else {
                   return null;
                }
            }
            $tableau = [''];//initi tableau
            $compte =0; //compte les tours de boucle
            while (($ligne = fgets($fichier)) !== false) {
              
        
                
                $colonne = couper($ligne, 2);
                
                $compte+=1;
                $tableau[$compte]=$colonne;
                //echo $colonne . "<br>"; // Afficher chaque ligne du fichier  
                //echo $tableau[$compte] . "<br>";
            }
          foreach ($tableau as $option) {
              echo "<option value=\"$option\">$option</option>";
          }
          
        } else {
            echo 'Le fichier utilisateurs.txt n\'existe pas.';
        }
        
        
        ?>
        
      </select>
      <br><br><br>
        <input type="submit" value="Envoyer">
      </form>
      <br><br><br>
      
      
</body>

</html>