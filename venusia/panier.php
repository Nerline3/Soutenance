<?php

require 'inc/header.inc.php';

// vérifie si la variable $_POST['action'] est définie dans le tableau
if (isset($_POST['action']) && $_POST['action'] === 'effacer_panier') {
    // conditions précédentes sont remplies cette instruction supprime la variable de session 'panier'.
    unset($_SESSION['panier']);
}

// vérifie d'abord si un paramètre "action" est passé via la methode $_GET 
// réinitialiser le contenu du panier
if (isset($_GET["action"])) {
    $_SESSION["panier"] = [];
}

?>

<!--  DEBUT DU MAIN -->
<main>

    <div class="d-flex justify-content-center align-items-center">
        <a href="articles1.php" class="btn btn-xs btn-primary">Retour</a>
    </div><!-- fin div -->


    <div class="row container">
    <?php
    // Vérifier si le panier existe et n'est pas vide
    if (isset($_SESSION["panier"]) && !empty($_SESSION["panier"])) {
    ?>
    <div class="col-12 mx-auto"> <!-- Utilisation de la classe mx-auto pour centrer le contenu et le décaler légèrement vers la gauche -->
        <div class="table-responsive">
            <table class="table table-striped table-sm"> <!-- Utilisation de la classe table-sm pour un tableau plus compact -->
                <thead>
                    <tr>
                        <th scope="col">Nom produit</th>
                        <th scope="col" class="d-none d-md-table-cell">Image</th> <!-- Cacher la colonne image sur mobile -->
                        <th scope="col">Qte</th> <!-- Réduction du texte -->
                        <th scope="col">Taille</th>
                        <th scope="col">Taille bonnet</th>
                        <th scope="col">Couleur</th>
                        <th scope="col">Prix</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Parcourir tous les produits dans le panier verifier si existe par on id
                    foreach ($_SESSION["panier"] as $id_produit => $details_produit) {
                        $produit = $pdoVenusia->query("SELECT * FROM produits WHERE id_produit = $details_produit[id_produit]");
                        $informationsProduit = $produit->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <tr>
                        <td><?php echo $informationsProduit['nom_produit']; ?></td>
                        <td class="d-none d-md-table-cell"><img src="<?php echo $informationsProduit['image2']; ?>" alt="" width="50" height="50"></td> <!-- Cacher la colonne image sur mobile -->
                        <td><?php echo $details_produit['quantite']; ?></td>
                        <td><?php echo $details_produit['taille']; ?></td>
                        <td><?php echo $details_produit['taille_bonnet']; ?></td>
                        <td><?php echo $details_produit['couleur']; ?></td>
                        <td><?php echo $informationsProduit['prix']; ?>€</td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-12 d-flex justify-content-center mt-3"> <!-- Réduction de la marge -->
    <form action="#" method="POST" class="d-flex justify-content-center mt-5">
                <a type="submit" href="panier.php?action=suppression" class="btn custom-button-2">Effacer le panier</a>
            </form><!-- fin de form -->
    </div>
    <?php
    } else {
        echo "<p>Le panier est vide.</p>";
    }
    ?>
</div>
    <!-- FIN DU MAIN -->
</main>

<!-- FOOTER -->
<?php 
require "inc/footer.inc.php";
?>
