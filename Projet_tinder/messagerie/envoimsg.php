<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire</title>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("formulaire").addEventListener("submit", function(event) {
                event.preventDefault(); // Empêche la soumission normale du formulaire

                let form = event.target;
                let formData = new FormData(form);

                fetch("traitement.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    document.getElementById("resultat").innerHTML = data;
                })
                .catch(error => console.error('Erreur:', error));
            });
        });
    </script>
</head>
<body>
    <form id="formulaire">
        <label for="texte">Saisissez du texte :</label>
        <input type="text" id="texte" name="texte">
        <input type="submit" value="Envoyer">
    </form>
    <div id="resultat"></div>
</body>
</html>
