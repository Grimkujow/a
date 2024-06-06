<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destiné</title>
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
                          <li>Jusqu'à 4 dessins par profil !</li>
                          <li>Messagerie améliorée</li>
                          <li>Vues du profil</li>
                          <li>Une contribution à notre site</li>
                      </ul>
                        <span class="button-content">
                            <a href="paiement.php" class="btn btn-lg btn-block btn-primary">Acheter</a>
                        </span>
                  </div>
              </div>
              <div class="card mb-4">
                  <div class="card-header">
                      <h4 class="my-0 font-weight-normal">Normal card</h4>
                  </div>
                  <div class="card-body">
                      <h1 class="card-title pricing-card-title">90€ <small class="text-muted">/ an</small></h1>
                      <ul class="list-unstyled mt-3 mb-4">
                          <li>tous les avantages ci-dessus</li>
                          <li>seulement 7€50/mois</li>
                          <li>.</li>
                          <li>.</li>
                      </ul>
                      <span class="button-content">
                          <a href="paiement2.php" class="btn btn-lg btn-block btn-primary">Acheter</a>
                      </span>
                  </div>
              </div>
              </div>
          </div></div>
        
</body>
</html>
