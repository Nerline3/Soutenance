<?php

require 'inc/header.inc.php';

if (isset($_POST['action']) && $_POST['action'] === 'effacer_panier') {
    // Effacer le panier en supprimant la variable de session
    unset($_SESSION['panier']);
}

if (isset($_GET["action"])) {
    $_SESSION["panier"] = [];
}

$totalPanier = 0; 
?>

<main>

    <div class="d-flex justify-content-center align-items-center">
        <a href="articles1.php" class="btn btn-xs btn-primary">Retour</a>
    </div>


    <div class="row container mx-auto">

        <?php
        // Vérifier si le panier existe et n'est pas vide
        if (isset($_SESSION["panier"]) && !empty($_SESSION["panier"])) {
        ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nom produit</th>
                        <th scope="col">Image</th>
                        <th scope="col">Quantité</th>
                        <th scope="col">Taille</th>
                        <th scope="col">Taille bonnet</th>
                        <th scope="col">Couleur</th>
                        <th scope="col">Prix</th>

                    </tr>
                </thead>
                
                <tbody>
                    <?php
                    // Parcourir tous les produits dans le panier
                    foreach ($_SESSION["panier"] as $id_produit => $details_produit) {

                        // MODIFIE LE NOM VARIABLE

                        $produit = $pdoVenusia->query("SELECT * FROM produits WHERE id_produit = $details_produit[id_produit]");
                        $informationsProduit = $produit->fetch(PDO::FETCH_ASSOC);
                    ?>
                        <tr>

                            <td><?php echo $informationsProduit['nom_produit']; ?></td>
                            <td><img src="<?php echo $informationsProduit['image2']; ?>" alt="" width="50" height="50"></td>
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

            <form action="#" method="POST" class="d-flex justify-content-center mt-5">
                <a type="submit" href="panier.php?action=suppression" class="btn custom-button-2">Effacer le panier</a>
            </form>
        <?php
        } else {

            echo "<p>Le panier est vide.</p>";
        }
        ?>
    </div>


</main>