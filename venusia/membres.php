<?php
/* 1- Require du fichier init: connexion à la BDD */
require "inc/headeradmin.inc.php";

if (estAdmin()){

if (isset($_GET['action']) && $_GET['action'] == 'suppression' && isset($_GET['id_membre'])) {/* Je verifie que toutes les infos ci-dessus  (action, action qui correspond à la suppression et id_articles) sont bien présentes dans l'URL */

    $delete = $pdoVenusia->prepare("DELETE FROM membres WHERE id_membre = :id_membre");

    $delete->execute(array(
        ':id_membre' => $_GET['id_membre'],
    ));
    if ($delete->rowCount() == 0) { //On verifie si SQL renvoie 0 rangée.
        $contenu .= "<div class=\"alert alert-danger\"> Erreur de suppression de l'article ayant l'id $_GET[id_membre]</div>";
    } else {/* La suppression s'execute  */
        $contenu .= "<div class=\"alert alert-success\">L'article n° $_GET[id_membre] a bien été supprimé.</div>";
    }
}

?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
<link rel="stylesheet" href="assets/css/style.css" />
<nav class="navbar bg-body-tertiary fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="assets/img/logovenusia.png" alt="logo vénusia" width="100" height="100"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Catégorie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
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
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tous
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex mt-3" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- lien css -->

<main class="main-articles">
    <div class="row">
        <div class="col-12 titrearticle">
            <h1>Membres</h1>
        </div>
        <?php
        // Requête SQL pour récupérer les produits de la catégorie 'Soutiens-gorges'
        $requete = $pdoVenusia->query("SELECT * FROM membres");  

        // Boucle pour afficher les produits
        while ($produit = $requete->fetch(PDO::FETCH_ASSOC)) {

        ?>
            <!-- membres.php -->
            <div class="col-md-4 mb-3"> <!-- Ajout de la classe mb-3 pour la marge en bas -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Nom :<?php echo $produit['nom'] ?></h5>
                <h5 class="card-title">Prénom :<?php echo $produit['prenom'] ?></h5>
                <p class="card-text">Genre :<?php echo $produit['civilite'] ?></p>
                <p class="card-text">Email :<?php echo $produit['email'] ?></p>
                <p class="card-text">Statut :<?php echo $produit['statue'] ?></p>
                <a href="membres.php?action=suppression&id_membre=<?php echo "$produit[id_membre]"; ?>" class="btn btn-danger" onclick="return(confirm('Êtes vous sûr de vouloir supprimer cet article ?'))"><i class="bi bi-trash3"></i></a>
            </div>
        </div>
    </div>
        <?php
        } // Fin de la boucle while
        ?>

    </div>
</main><!-- fin main -->
<script src="assets/js/script.js"></script>

<?php

require "inc/footer.inc.php";}
?>
</body>

</html>