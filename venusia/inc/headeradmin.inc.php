<?php
require "inc/init.inc.php";
if (estAdmin()) { 
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
     <!-- lien css -->
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    
</head>

<body>
    <nav class="navbar bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="indexadmin.php"><img src="assets/img/logovenusia.png" alt="logo vénusia" width="100" height="100"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Membres</h5>
                        </div>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Navigation
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="index.php">Acceuil</a></li>
                                <li><a class="dropdown-item" href="contact.php">Contact</a></li>
                                <li>
                                <li><a class="dropdown-item" href="guidestailles.php">Guide taille</a></li>
                                <li><a class="dropdown-item" href="soinlingerie.php">Soin lingerie</a></li>
                                <li><a class="dropdown-item" href="histoire.php">Histoire</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                    <li><a class="dropdown-item" href="mentionslegales.php">Mentions légales</a></li>
                                    <li><a class="dropdown-item" href="charteconfidentialite.php">Charte de confidentialité</a></li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="profil.php">Profil</a></li>
                                <li><a class="dropdown-item" href="profil.php?action=deconnexion">Déconnexion</a></li>
                            </ul>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="articles1.php">Soutiens-gorges</a>
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
                            <a class="nav-link" href="articles.php">Tous les produits</a>
                        </li>
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Membres</h5>
                        </div>
                        <li class="nav-item">
                        <a class="nav-link" href="membres.php">Membre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="commentaires.php">Commentaires</a>
                    </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Tous
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="ajoutmembre.php">Ajouter un membres</a></li>
                                <li><a class="dropdown-item" href="ajoutarticle.php">Ajouter un produit</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            </ul>
                        </li>
                    </ul>                   
                    </div>
                </div>
            </div><!-- fin div container -->
    </nav>

    <?php  } ?> <!-- fin if (estAdmin()) -->