<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>déestinés</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="shortcut icon" href="../../main_image/logo.png">
    <link rel="stylesheet" type="text/css" href="../../sidebar_css.css">
    <link rel="stylesheet" type="text/css" href="abonnement.css">
</head>
<body>
    <?php include('../../sidebar.php'); ?>

    <div class="content">
        <div class="content-header">
            <h4 class="my-0 font-weight-normal">Abonnements</h4>
        </div><br>
        <?php include('session_abo.php'); ?>
      <?php include('../../session_verif.php'); ?>
      <div class="card-container" id="page-content">
          <div class="card-deck mb-3 text-center">
              <div class="card square mb-4">
                  <div class="card-header">
                      <h4 class="my-0 font-weight-normal">Square card</h4>
                  </div>
                  <div class="card-body">
                      <h1 class="card-title pricing-card-title">9€ <small class="text-muted">/ mois</small></h1>
                      <ul class="list-unstyled mt-3 mb-4">
                          <li>Plus de dessin par profil !</li>
                          <li>Messagerie amélioré</li>
                          <li>Voir qui a visité votre profil</li>
                          <li>un support pour notre site, merci.</li>
                      </ul>
                        <span class="button-content">
                            <a href="payement.php" class="btn btn-lg btn-block btn-primary">Acheter</a>
                        </span>
                  </div>
              </div>
              <div class="card mb-4">
                  <div class="card-header">
                      <h4 class="my-0 font-weight-normal">Normal card</h4>
                  </div>
                  <div class="card-body">
                      <h1 class="card-title pricing-card-title">90€ <small class="text-muted">/ ans</small></h1>
                      <ul class="list-unstyled mt-3 mb-4">
                          <li>toutes les avantages si dessus</li>
                          <li>seulement 7€50 par mois</li>
                          <li>.</li>
                          <li>.</li>
                      </ul>
                      <span class="button-content">
                          <a href="payement.php" class="btn btn-lg btn-block btn-primary">Acheter</a>
                      </span>
                  </div>
              </div>
              </div>
          </div></div>
        
</body>
</html>
