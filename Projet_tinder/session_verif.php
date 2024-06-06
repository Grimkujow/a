<?php 

if ($_SESSION['loggedin'] === true) {
} else {
    echo '<script>window.location.href = "/Projet_tinder/sidebar/sidebar_identifier/identifier.php";</script>';
    echo "L'utilisateur n'est pas connecté.";
}
?>