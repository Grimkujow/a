<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $mdp_admin = 'admin2024';
    $mdp_admin_user = $_POST['mdp_admin_user'];
    if ($mdp_admin_user == $mdp_admin){
        header('Location: administrateur.php');
    }
    else{
        header('Location: verif_admin.php');
    }
}
?>