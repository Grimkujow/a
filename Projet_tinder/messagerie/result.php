<?php session_start(); ?>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Vérifier si le champ texte est défini et non vide
    if (isset($_POST['texte']) && !empty($_POST['texte'])) {
        // Récupérer et sécuriser le texte saisi par l'utilisateur
        $texte = htmlspecialchars($_POST['texte'], ENT_QUOTES, 'UTF-8');

        // Exécuter du code PHP en fonction de l'option sélectionnée
        // Ici, nous affichons simplement l'option sélectionnée, mais vous pouvez exécuter n'importe quel code PHP
        $_SESSION['destinataire'] = $texte;
        //envoie sur l'autre page
        echo '<script type="text/javascript">

                  window.location.href = "systeme.php";

                </script>';
        echo "test";
    } else {
        // Cas champ vide
        echo "Aucune option sélectionnée.";
    }
}
?>