<?php 
require "inc/header.inc.php";


if (isset($_POST['action']) && $_POST['action'] === 'effacer_panier') {
    // Effacer le panier en supprimant la variable de session
    unset($_SESSION['panier']);
}

if (!isset($_SESSION["panier"])) {

    // SI LE PANIER N'EXISTE PAS

    $cle_produit = $_GET["id_produit"]. '_' . $_POST["nom_produit"]. '_' . $_POST["image1"] . '_' . $_POST["couleur"] . '_' . $_POST["taille"]. '_' . $_POST["taille_bonnet"]. '_' . $_POST["quantite"];

    $_SESSION["panier"] = [
        $cle_produit => [
            "nom_produit" => $_POST["nom_produit"],
            "image1" => $_POST["image1"],
            "quantite" => $_POST["quantite"],
            "taille" => $_POST["taille"],
            "taille_bonnet" => $_POST["taille_bonnet"],
            "couleur" => $_POST["couleur"]
        ]
    ];
} else {

    $produit_existe = false;

    // SI LE PRODUIT EXISTE AVEC MEME PARAMETRES

    foreach ($_SESSION["panier"] as $id_produit_panier => $details_produit) {

        if ($id_produit_panier == $_GET["id_produit"] && $details_produit["nom_produit"] == $_POST["nom_produit"] && $details_produit["image1"] == $_POST["image1"] && $details_produit["couleur"] == $_POST["couleur"] && $details_produit["taille"] == $_POST["taille"]&& $details_produit["taille_bonnet"] == $_POST["taille_bonnet"]) {

            $cle_produit = $_GET["id_produit"]. '_' . $_POST["nom_produit"]. '_' . $_POST["image1"] . '_' . $_POST["couleur"] . '_' . $_POST["taille"]. '_' . $_POST["taille_bonnet"];

            $_SESSION["panier"][$cle_produit]["quantite"] += $_POST["quantity"];
            $produit_existe = true;
            break;
        }
    }

    // SI LE PRODUIT EXISTE SANS MEME PARAMETRE

    $cle_produit = $_GET["id_produit"] . '_' . $_POST["couleur"] . '_' . $_POST["taille"];

    if (!$produit_existe) {

        $_SESSION["panier"][$cle_produit] = [
            "quantite" => $_POST["quantite"],
            "taille" => $_POST["taille"],
            "couleur" => $_POST["couleur"]
        ];
    }
}
?>

<div class="row container mx-auto">

        <?php
        // Vérifier si le panier existe et n'est pas vide
        if (isset($_SESSION["panier"]) && !empty($_SESSION["panier"])) {
        ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID Produit</th>
                        <th scope="col">Nom produit</th>
                        <th scope="col">Image</th>
                        <th scope="col">Quantité</th>
                        <th scope="col">Taille</th>
                        <th scope="col">Taille_bonnet</th>
                        <th scope="col">Couleur</th>
                        <th scope="col">Prix</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Parcourir tous les produits dans le panier
                    foreach ($_SESSION["panier"] as $id_produit => $details_produit) {
                    ?>
                        <tr>
                            <td><?php echo $id_produit; ?></td>
                            <td><?php echo $details_produit['nom_produit']; ?></td>
                            <td><?php echo $details_produit['image1']; ?></td>
                            <td><?php echo $details_produit['quantite']; ?></td>
                            <td><?php echo $details_produit['taille']; ?></td>
                            <td><?php echo $details_produit['taille_bonnet']; ?></td>  
                            <td><?php echo $details_produit['couleur'];?></td>
                            <td><?php echo $details_produit['prix']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

            <form action="#" method="POST" class="d-flex justify-content-center mt-5">
                <input type="hidden" name="action" value="effacer_panier">
                <button type="submit" class="btn custom-button-2">Effacer le panier</button>
            </form>
        <?php
        } else {

            echo "<p>Le panier est vide.</p>";
        }
        ?>
    </div>








    <?php

$title = "FitWithBoxing - Produits";
$active = "";

require("../inc/init.inc.php");

$products = $fwbBDD->query("SELECT * FROM produits WHERE id_produit = $_GET[id_produit]");

$productInformations = $products->fetch(PDO::FETCH_ASSOC);

$comments = $fwbBDD->query("SELECT * FROM commentaires WHERE id_produit = $_GET[id_produit]");

// COMMENTAIRES

if (isset($_POST["action"]) && $_POST["action"] === "ajouter_commentaire") {

    // VERIFICATIONS

    if (empty($_POST["commentaire"]) || empty($_POST["titre"])) {
        $contenu .= "<div class=\"alert alert-danger\">" . MISS_FIELD . "</div>";
    }

    if (!isOnline()) {
        $contenu .= "<div class=\"alert alert-danger\">" . NEED_ONLINE . "</div>";
    }

    // AJOUT DU COMMENTAIRE

    if (empty($contenu)) {

        $insertComment = $fwbBDD->prepare("INSERT INTO commentaires (id_produit, id_membre, titre, commentaire, date_commentaire, note) VALUES (:id_produit, :id_membre, :titre, :commentaire, :date_commentaire, :note)");

        $insertComment->execute([
            ":id_produit" => $_GET["id_produit"],
            ":id_membre" => $_SESSION["membres"]["id_membre"],
            ":titre" => $_POST["titre"],
            ":commentaire" => $_POST["commentaire"],
            ":date_commentaire" => getCurrentDate(),
            ":note" => $_POST["note"],
        ]);

        if ($insertComment) {
            $contenu .= "<div class=\"alert alert-success\">" . COMMENT_ADD . "</div>";
            header("location:product.php?id_produit={$_GET['id_produit']}");
            exit();
        } else {
            $contenu .= "<div class=\"alert alert-danger\">" . ERROR . "</div>";
        }
    }
}

// SUPPRESSION COMMENTAIRE

if (isset($_GET['id_commentaire'])) {

    $delete = $fwbBDD->query("DELETE FROM commentaires WHERE id_commentaire = $_GET[id_commentaire]");

    if ($delete) {
        $contenu .= "<div class=\"alert alert-success\">" . SUCCESS_DELETE . "</div>";
        header("location:product.php?id_produit={$_GET['id_produit']}");
        exit();
    } else {
        $contenu .= "<div class=\"alert alert-danger\">" . ERROR . "</div>";
    }
}

// PANIER

if (isset($_POST["action"]) && $_POST["action"] === "ajouter_panier") {

    if (!isOnline()) {
        $contenu .= "<div class=\"alert alert-danger\">" . NEED_ONLINE . "</div>";
    } else {

        if (!isset($_SESSION["panier"])) {

            // SI LE PANIER N'EXISTE PAS

            $cle_produit = $_GET["id_produit"] . '_' . $_POST["couleur"] . '_' . $_POST["taille"];

            $_SESSION["panier"] = [
                $cle_produit => [
                    "quantite" => $_POST["quantity"],
                    "taille" => $_POST["taille"],
                    "couleur" => $_POST["couleur"]
                ]
            ];

            $contenu .= "<div class=\"alert alert-success\">" . PRODUCT_ADD . "</div>";
        } else {

            // SI LE PRODUIT EXISTE AVEC LES MEMES PARAMETRES

            $produit_existe = false;

            foreach ($_SESSION["panier"] as $id_produit_panier => $details_produit) {

                if ($id_produit_panier == $_GET["id_produit"] && $details_produit["couleur"] == $_POST["couleur"] && $details_produit["taille"] == $_POST["taille"]) {

                    $cle_produit = $_GET["id_produit"] . '_' . $_POST["couleur"] . '_' . $_POST["taille"];

                    $_SESSION["panier"][$cle_produit]["quantite"] += $_POST["quantity"];
                    $produit_existe = true;

                    $contenu .= "<div class=\"alert alert-success\">" . PRODUCT_ADD . "</div>";
                    break;
                }
            }

            // SI LE PRODUIT EXISTE SANS LES MEMES PARAMETRE

            $cle_produit = $_GET["id_produit"] . '_' . $_POST["couleur"] . '_' . $_POST["taille"];

            if (!$produit_existe) {

                $_SESSION["panier"][$cle_produit] = [
                    "quantite" => $_POST["quantity"],
                    "taille" => $_POST["taille"],
                    "couleur" => $_POST["couleur"]
                ];

                $contenu .= "<div class=\"alert alert-success\">" . PRODUCT_ADD . "</div>";
            }
        }
    }
}

require("../inc/utils.inc.php");

?>

<main>

    <!-- AFFICHAGE DES ERREURS -->

    <?php echo $contenu; ?>

    <!-- PRODUIT -->

    <div class="py-5 container mx-auto row">

        <!-- IMAGE DU PRODUIT -->

        <aside class="col-lg-6 d-flex justify-content-center">
            <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="<?php echo $productInformations["image"] ?>" />
        </aside>

        <!-- INFORMATIONS DU PRODUIT -->

        <div class="col-lg-6">
            <img class="mb-4" src="../medias/logos/logo.png" alt="logo de marque" class="img-fluid" />

            <div class="ps-lg-3">
                <h3 class="fw-bold mb-3">
                    <?php echo $productInformations["nom"] ?> </h3>
                <div class="d-flex flex-row my-3 mb-4">
                    <div class="mb-1 me-2">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <span class="ms-1">
                            1.0
                        </span>
                    </div>
                    <span class="text-success ms-2">En stock (<?php echo $productInformations["stock"] ?>)</span>
                </div>

                <div class="mb-3 d-flex">
                    <h4 class="<?php if (!is_null($productInformations["prix_promotion"])) {
                                    echo "text-decoration-line-through";
                                } ?>"><?php echo $productInformations["prix"] ?>€</h4>
                    <?php if (!is_null($productInformations["prix_promotion"])) { ?>
                        <h4>‎ <?php echo $productInformations["prix_promotion"] ?>€</h4>
                    <?php } ?>
                </div>

                <p class="mb-3 fs-5">
                    <?php echo $productInformations["description"] ?>
                </p>

                <div class="row mt-5">
                    <p class="col-3 fw-bold fs-5">Marque :</p>
                    <p class="col-9 fs-5"><?php echo $productInformations["marque"] ?></p>
                    <p class="col-3 fw-bold fs-5">Matiere :</p>
                    <p class="col-9 fs-5"><?php echo $productInformations["matiere"] ?></p>
                    <p class="col-3 fw-bold fs-5">Genre :</p>
                    <p class="col-9 fs-5"><?php echo $productInformations["genre"] ?></p>

                    <p class="mt-4 fw-bold fs-5">Date de publication : <?php echo $productInformations["date"] ?></p>
                </div>

                <hr class="custom-hr w-100 my-3">

                <form action="#" method="POST">
                    <div class="row mb-4">
                        <div class="col-md-4 col-6">
                            <label class="mb-2">Taille</label>
                            <select name="taille" class="form-select border border-secondary">
                                <option value="XS">XS</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="TU">TU</option>
                            </select>
                        </div>

                        <div class="col-md-4 col-6">
                            <label class="mb-2">Couleur</label>
                            <select name="couleur" class="form-select border border-secondary">
                                <option value="Rouge">Rouge</option>
                                <option value="Vert">Vert</option>
                                <option value="Noir">Noir</option>
                                <option value="Blanc">Blanc</option>
                                <option value="Bleu">Bleu</option>
                                <option value="Beige">Beige</option>
                            </select>
                        </div>

                    </div>

                    <div class="row mb-5">
                        <div class="col-md-8 col-6">
                            <label class="mb-2">Quantité</label>

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary" type="button" id="btnMin">-</button>
                                </div>
                                <input type="text" class="form-control text-center h-auto" value="1" id="quantity" name="quantity">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="btnPlus">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-cart-plus-fill fs-3 text-black"></i></span>
                        <input type="hidden" name="action" value="ajouter_panier">
                        <button type="submit" class="custom-button-2">AJOUTER AU PANIER</button>
                    </div>
                </form>

            </div>

        </div>

        <hr class="custom-hr mt-5 w-100">

        <!-- FORM DU COMMENTAIRE -->

        <form action="#" method="POST">
            <div class="col-md-12 mt-5 mb-3 pb-2">

                <div class="form-outline">
                    <label class="form-label" for="titre">Titre du commentaire</label>
                    <input type="text" id="titre" name="titre" class="form-control form-control-lg" />
                </div>

            </div>
            <div class="col-md-12 mb-4 pb-2">
                <div class="form-outline">
                    <label class="form-label">Commentaire</label>
                    <textarea id="commentaire" name="commentaire" class="form-control form-control-lg" rows="6"></textarea>
                </div>
            </div>

            <div class="col-md-12 fs-1">
                <div class="rating">
                    <span class="star" number="1">&#9733;</span>
                    <span class="star" number="2">&#9733;</span>
                    <span class="star" number="3">&#9733;</span>
                    <span class="star" number="4">&#9733;</span>
                    <span class="star" number="5">&#9733;</span>
                </div>
            </div>

            <input type="hidden" id="note" name="note" value="1">
            <input type="hidden" name="action" value="ajouter_commentaire">

            <button type="submit" class="btn custom-button-1 mt-4 ms-4">AJOUTER UN COMMENTAIRE</button>
        </form>

        <h2 class="my-5 text-center">Commentaires du produit</h2>


        <!-- AFFICHAGE DES COMMENTAIRES -->

        <?php

        if ($comments->rowCount() === 0) {
            echo "<p class=fs-3>" . NO_COMMENT . "</p>";
        } else {

            while ($commentInformations = $comments->fetch(PDO::FETCH_ASSOC)) { ?>>

        <div class="row d-flex justify-content-center">
            <div class="border col-md-8 my-5 pb-2">
                <h3 class="p-3"><?php echo $commentInformations["titre"] ?> - <?php echo $commentInformations["date_commentaire"] ?> </h3>
                <p class="p-3 fs-3"><?php echo $commentInformations["commentaire"] ?></p>

                <!-- AFFICHER LES ETOILES -->

                <div class="p-3">
                    <?php
                    $note = $commentInformations["note"];
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $note) {
                            echo '<i class="bi bi-star-fill text-warning fs-2"></i>';
                        } else {
                            echo '<i class="bi bi-star text-warning fs-2"></i>';
                        }
                    }
                    ?>
                </div>

                <?php if (isAdmin()) { ?>

                    <?php $idProduct = $_GET["id_produit"]; ?>

                    <a href="product.php?id_produit=<?php echo $idProduct ?>&id_commentaire=<?php echo $commentInformations["id_commentaire"] ?>" class="btn custom-button-2 mt-2">SUPPRIMER LE COMMENTAIRE</a>
                <?php } ?>
            </div>
        </div>


<?php }
        } ?>
    </div>

</main>

<?php

require("../inc/footer.inc.php");

?>



<?php

$title = "FitWithBoxing - Produits";
$active = "";

require("../inc/init.inc.php");

$products = $fwbBDD->query("SELECT * FROM produits WHERE id_produit = $_GET[id_produit]");

$productInformations = $products->fetch(PDO::FETCH_ASSOC);

$comments = $fwbBDD->query("SELECT * FROM commentaires WHERE id_produit = $_GET[id_produit]");

// COMMENTAIRES

if (isset($_POST["action"]) && $_POST["action"] === "ajouter_commentaire") {

    // VERIFICATIONS

    if (empty($_POST["commentaire"]) || empty($_POST["titre"])) {
        $contenu .= "<div class=\"alert alert-danger\">" . MISS_FIELD . "</div>";
    }

    if (!isOnline()) {
        $contenu .= "<div class=\"alert alert-danger\">" . NEED_ONLINE . "</div>";
    }

    // AJOUT DU COMMENTAIRE

    if (empty($contenu)) {

        $insertComment = $fwbBDD->prepare("INSERT INTO commentaires (id_produit, id_membre, titre, commentaire, date_commentaire, note) VALUES (:id_produit, :id_membre, :titre, :commentaire, :date_commentaire, :note)");

        $insertComment->execute([
            ":id_produit" => $_GET["id_produit"],
            ":id_membre" => $_SESSION["membres"]["id_membre"],
            ":titre" => $_POST["titre"],
            ":commentaire" => $_POST["commentaire"],
            ":date_commentaire" => getCurrentDate(),
            ":note" => $_POST["note"],
        ]);

        if ($insertComment) {
            $contenu .= "<div class=\"alert alert-success\">" . COMMENT_ADD . "</div>";
            header("location:product.php?id_produit={$_GET['id_produit']}");
            exit();
        } else {
            $contenu .= "<div class=\"alert alert-danger\">" . ERROR . "</div>";
        }
    }
}

// SUPPRESSION COMMENTAIRE

if (isset($_GET['id_commentaire'])) {

    $delete = $fwbBDD->query("DELETE FROM commentaires WHERE id_commentaire = $_GET[id_commentaire]");

    if ($delete) {
        $contenu .= "<div class=\"alert alert-success\">" . SUCCESS_DELETE . "</div>";
        header("location:product.php?id_produit={$_GET['id_produit']}");
        exit();
    } else {
        $contenu .= "<div class=\"alert alert-danger\">" . ERROR . "</div>";
    }
}

// PANIER

if (isset($_POST["action"]) && $_POST["action"] === "ajouter_panier") {

    if (!isOnline()) {
        $contenu .= "<div class=\"alert alert-danger\">" . NEED_ONLINE . "</div>";
    } else {

        if (!isset($_SESSION["panier"])) {

            // SI LE PANIER N'EXISTE PAS

            $cle_produit = $_GET["id_produit"] . '_' . $_POST["couleur"] . '_' . $_POST["taille"];

            $_SESSION["panier"] = [
                $cle_produit => [
                    "quantite" => $_POST["quantity"],
                    "taille" => $_POST["taille"],
                    "couleur" => $_POST["couleur"]
                ]
            ];

            $contenu .= "<div class=\"alert alert-success\">" . PRODUCT_ADD . "</div>";
        } else {

            // SI LE PRODUIT EXISTE AVEC LES MEMES PARAMETRES

            $produit_existe = false;

            foreach ($_SESSION["panier"] as $id_produit_panier => $details_produit) {

                if ($id_produit_panier == $_GET["id_produit"] && $details_produit["couleur"] == $_POST["couleur"] && $details_produit["taille"] == $_POST["taille"]) {

                    $cle_produit = $_GET["id_produit"] . '_' . $_POST["couleur"] . '_' . $_POST["taille"];

                    $_SESSION["panier"][$cle_produit]["quantite"] += $_POST["quantity"];
                    $produit_existe = true;

                    $contenu .= "<div class=\"alert alert-success\">" . PRODUCT_ADD . "</div>";
                    break;
                }
            }

            // SI LE PRODUIT EXISTE SANS LES MEMES PARAMETRE

            $cle_produit = $_GET["id_produit"] . '_' . $_POST["couleur"] . '_' . $_POST["taille"];

            if (!$produit_existe) {

                $_SESSION["panier"][$cle_produit] = [
                    "quantite" => $_POST["quantity"],
                    "taille" => $_POST["taille"],
                    "couleur" => $_POST["couleur"]
                ];

                $contenu .= "<div class=\"alert alert-success\">" . PRODUCT_ADD . "</div>";
            }
        }
    }
}

require("../inc/utils.inc.php");

?>

<main>

    <!-- AFFICHAGE DES ERREURS -->

    <?php echo $contenu; ?>

    <!-- PRODUIT -->

    <div class="py-5 container mx-auto row">

        <!-- IMAGE DU PRODUIT -->

        <aside class="col-lg-6 d-flex justify-content-center">
            <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="<?php echo $productInformations["image"] ?>" />
        </aside>

        <!-- INFORMATIONS DU PRODUIT -->

        <div class="col-lg-6">
            <img class="mb-4" src="../medias/logos/logo.png" alt="logo de marque" class="img-fluid" />

            <div class="ps-lg-3">
                <h3 class="fw-bold mb-3">
                    <?php echo $productInformations["nom"] ?> </h3>
                <div class="d-flex flex-row my-3 mb-4">
                    <div class="mb-1 me-2">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <span class="ms-1">
                            1.0
                        </span>
                    </div>
                    <span class="text-success ms-2">En stock (<?php echo $productInformations["stock"] ?>)</span>
                </div>

                <div class="mb-3 d-flex">
                    <h4 class="<?php if (!is_null($productInformations["prix_promotion"])) {
                                    echo "text-decoration-line-through";
                                } ?>"><?php echo $productInformations["prix"] ?>€</h4>
                    <?php if (!is_null($productInformations["prix_promotion"])) { ?>
                        <h4>‎ <?php echo $productInformations["prix_promotion"] ?>€</h4>
                    <?php } ?>
                </div>

                <p class="mb-3 fs-5">
                    <?php echo $productInformations["description"] ?>
                </p>

                <div class="row mt-5">
                    <p class="col-3 fw-bold fs-5">Marque :</p>
                    <p class="col-9 fs-5"><?php echo $productInformations["marque"] ?></p>
                    <p class="col-3 fw-bold fs-5">Matiere :</p>
                    <p class="col-9 fs-5"><?php echo $productInformations["matiere"] ?></p>
                    <p class="col-3 fw-bold fs-5">Genre :</p>
                    <p class="col-9 fs-5"><?php echo $productInformations["genre"] ?></p>

                    <p class="mt-4 fw-bold fs-5">Date de publication : <?php echo $productInformations["date"] ?></p>
                </div>

                <hr class="custom-hr w-100 my-3">

                <form action="#" method="POST">
                    <div class="row mb-4">
                        <div class="col-md-4 col-6">
                            <label class="mb-2">Taille</label>
                            <select name="taille" class="form-select border border-secondary">
                                <option value="XS">XS</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="TU">TU</option>
                            </select>
                        </div>

                        <div class="col-md-4 col-6">
                            <label class="mb-2">Couleur</label>
                            <select name="couleur" class="form-select border border-secondary">
                                <option value="Rouge">Rouge</option>
                                <option value="Vert">Vert</option>
                                <option value="Noir">Noir</option>
                                <option value="Blanc">Blanc</option>
                                <option value="Bleu">Bleu</option>
                                <option value="Beige">Beige</option>
                            </select>
                        </div>

                    </div>

                    <div class="row mb-5">
                        <div class="col-md-8 col-6">
                            <label class="mb-2">Quantité</label>

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary" type="button" id="btnMin">-</button>
                                </div>
                                <input type="text" class="form-control text-center h-auto" value="1" id="quantity" name="quantity">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="btnPlus">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-cart-plus-fill fs-3 text-black"></i></span>
                        <input type="hidden" name="action" value="ajouter_panier">
                        <button type="submit" class="custom-button-2">AJOUTER AU PANIER</button>
                    </div>
                </form>

            </div>

        </div>

        <hr class="custom-hr mt-5 w-100">

        <!-- FORM DU COMMENTAIRE -->

        <form action="#" method="POST">
            <div class="col-md-12 mt-5 mb-3 pb-2">

                <div class="form-outline">
                    <label class="form-label" for="titre">Titre du commentaire</label>
                    <input type="text" id="titre" name="titre" class="form-control form-control-lg" />
                </div>

            </div>
            <div class="col-md-12 mb-4 pb-2">
                <div class="form-outline">
                    <label class="form-label">Commentaire</label>
                    <textarea id="commentaire" name="commentaire" class="form-control form-control-lg" rows="6"></textarea>
                </div>
            </div>

            <div class="col-md-12 fs-1">
                <div class="rating">
                    <span class="star" number="1">&#9733;</span>
                    <span class="star" number="2">&#9733;</span>
                    <span class="star" number="3">&#9733;</span>
                    <span class="star" number="4">&#9733;</span>
                    <span class="star" number="5">&#9733;</span>
                </div>
            </div>

            <input type="hidden" id="note" name="note" value="1">
            <input type="hidden" name="action" value="ajouter_commentaire">

            <button type="submit" class="btn custom-button-1 mt-4 ms-4">AJOUTER UN COMMENTAIRE</button>
        </form>

        <h2 class="my-5 text-center">Commentaires du produit</h2>


        <!-- AFFICHAGE DES COMMENTAIRES -->

        <?php

        if ($comments->rowCount() === 0) {
            echo "<p class=fs-3>" . NO_COMMENT . "</p>";
        } else {

            while ($commentInformations = $comments->fetch(PDO::FETCH_ASSOC)) { ?>>

        <div class="row d-flex justify-content-center">
            <div class="border col-md-8 my-5 pb-2">
                <h3 class="p-3"><?php echo $commentInformations["titre"] ?> - <?php echo $commentInformations["date_commentaire"] ?> </h3>
                <p class="p-3 fs-3"><?php echo $commentInformations["commentaire"] ?></p>

                <!-- AFFICHER LES ETOILES -->

                <div class="p-3">
                    <?php
                    $note = $commentInformations["note"];
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $note) {
                            echo '<i class="bi bi-star-fill text-warning fs-2"></i>';
                        } else {
                            echo '<i class="bi bi-star text-warning fs-2"></i>';
                        }
                    }
                    ?>
                </div>

                <?php if (isAdmin()) { ?>

                    <?php $idProduct = $_GET["id_produit"]; ?>

                    <a href="product.php?id_produit=<?php echo $idProduct ?>&id_commentaire=<?php echo $commentInformations["id_commentaire"] ?>" class="btn custom-button-2 mt-2">SUPPRIMER LE COMMENTAIRE</a>
                <?php } ?>
            </div>
        </div>


<?php }
        } ?>
    </div>

</main>

<?php

require("../inc/footer.inc.php");

?>
<div class="p-3">
                <?php
                $note = $commentInformations["note"];
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $note) {
                        echo '<i class="bi bi-star-fill text-warning fs-2"></i>';
                    } else {
                        echo '<i class="bi bi-star text-warning fs-2"></i>';
                    }
                }
                ?>
            </div>