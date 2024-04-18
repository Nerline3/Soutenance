<?php
/* 1- Require du fichier init: connexion à la BDD */
require "inc/header.inc.php";
?>


<main class="main-articles">
    <div class="row">
        <div class="col-12 titrearticle">
            <h1>MAILLOTS DE BAIN FEMME</h1>
        </div>
        <?php
        $requete = $pdoVenusia->query("SELECT DISTINCT * FROM produits WHERE id_categorie = (SELECT id_categorie FROM categorie WHERE nom_categorie = 'maillot de bain')");

        while ($produit = $requete->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <!-- PAGE ARTICLES 5 -->
        <div class="col-12 col-sm-6 col-md-3 mb-4">
    <div class="card border-0">
        <a href="ficheproduit.php?id_produit=<?php echo $produit['id_produit']; ?>" class="text-decoration-none">
            <div class="infos">
                <div id="images">
                    <img src="<?php echo $produit['image1']; ?>" alt="image d'illustration" class="img-fluid mainImage" id="mainImage1">
                    <img src="<?php echo $produit['image2']; ?>" alt="image d'illustration" class="img-fluid mainImage d-none" id="mainImage2">
                </div><!-- fin div images -->
                <div class="card-body">
                    <p class="text-dark mb-1"><?php echo $produit['nom_produit']; ?></p>
                    <p class="card-text text-dark mb-1"><?php echo $produit['couleur']; ?></p>
                    <p class="card-text text-dark mb-0"><?php echo $produit['prix']; ?>€</p>
                </div><!-- fin div card-body -->
            </div><!-- fin div infos -->
        </a>
    </div><!-- div card  -->
</div><!-- fin div col-12 -->

        <?php
        } // Fin de la boucle while
        ?>

    </div>
</main>

<script src="assets/js/script.js"></script>
<?php
require "inc/footer.inc.php";
?>
</body>

</html>