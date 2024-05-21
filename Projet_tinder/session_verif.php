<?php 

if ($_SESSION['loggedin'] === true) {
} else {
    echo "L'utilisateur n'est pas connecté.";
    echo '<script>window.location.href = "/Projet_tinder/sidebar/sidebar_identifier/identifier.php";</script>';
}
?>