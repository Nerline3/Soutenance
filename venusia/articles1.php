<?php
/* Require du fichier init: connexion à la BDD */
require "inc/header.inc.php";


?>

<main class="main-articles">
    <div class="row">
        <div class="col-12 titrearticle">
            <h1>Soutiens-gorges</h1>
        </div>
        <?php
        // Requête SQL pour récupérer les produits de la catégorie 'Soutiens-gorges'
        $requete = $pdoVenusia->query("SELECT * FROM produits WHERE id_categorie = (SELECT id_categorie FROM categorie WHERE nom_categorie = 'Soutiens-gorges')");

        //  initialisation la variable à la valeur 1
        $counter = 1;

        // Boucle pour afficher les produits
        while ($produit = $requete->fetch(PDO::FETCH_ASSOC)) {

        ?>
            <!-- PAGE ARTICLES 1 -->
            <div class="col-12 col-sm-6 col-md-3 mb-4">
                <div class="card" style="width: 18rem;">
                    <a href="ficheproduit.php?id_produit=<?php echo $produit['id_produit']; ?>" class="text-decoration-none text-dark">
                        <div class="infos">
                            <div id="images">
                                <!-- affiche la valeur d'un produit à l'intérieur d'une cellule -->
                                <img src="<?php echo $produit['image1']; ?>" alt="image d'illustration" class="img-fluid mainImage" id="mainImage1">
                                <img src="<?php echo $produit['image2']; ?>" alt="image d'illustration" class="img-fluid mainImage d-none" id="mainImage2">
                            </div>
                            <div class="card-body">
                                <p class="text-dark"><?php echo $produit['nom_produit']; ?></p>
                                <p class="card-text text-dark"><?php echo $produit['couleur']; ?></p>
                                <p class="card-text text-dark"><?php echo $produit['prix']; ?>€</p>
                            </div><!-- fin div card body -->
                        </div><!-- fin div infos -->
                    </a>
                </div><!-- fin div card -->
            </div><!-- fin div col-12 -->


        <?php
        } // Fin de la boucle while
        ?>
    </div><!-- fin div row -->

</main><!-- fin main -->
<script src="assets/js/script.js"></script>

</body>

<?php
require "inc/footer.inc.php";
?>