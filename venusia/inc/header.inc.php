<?php
require "inc/init.inc.php";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vénusia- Accueil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- lien css -->
    <link rel="stylesheet" href="assets/css/style.css" />

    <link rel="shortcut icon" href="assets/img/iconlogo.png" type="image/x-icon">
    <link href="https://unpkg.com/css.gg@2.0.0/icons/css/arrow-right.css" rel="stylesheet" />
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand logo" href="index.php">
            <img src="assets/img/logovenusia.png" alt="Venusia Logo" style="width: 100px; height: auto;">

            </a>
            <div class="collapse navbar-collapse liens" id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="liens" aria-current="page" href=""></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="articles1.php">Soutiens-gorges</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="articles2.php">Bas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="articles3.php">Intima</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="articles4.php">Nuit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="articles5.php">Bain</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=""></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=""></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=""></a>
                    </li>

                    <?php

                    if (estConnecte()) {  ?>
                        <li class="nav-item">
                            <a class="nav-link" href="profil.php?id_membre=<?php echo $_SESSION['membres']['id_membre'] ?>">
                                <img src="assets/img/pointrose.png" alt="" class="img-fluid" style="max-width: 20px;">
                            </a>

                        </li>
                    <?php }

                    if (estConnecte() && estAdmin()) { ?>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="articles.php">Tous les produits</a>
                        </li>
                    <?php  } ?>

                    <li class="nav-item">
                        <a href="inscription.php"><i class="bi bi-person-fill"></i></a>
                    </li>
                    <li class="nav-item">
                        <a href="panier.php"><i class="bi bi-bag-fill"></i></a>
                    </li><!-- fin li -->
                </ul><!-- fin ul -->
            </div>
        </div>

    </nav>