<?php

require("inc/header.inc.php");

$products = $pdoVenusia->query("SELECT * FROM produits WHERE id_produit = $_GET[id_produit]");

// variable
$infosproduit = $products->fetch(PDO::FETCH_ASSOC);

$comments = $pdoVenusia->query("SELECT * FROM commentaires WHERE id_produit = $_GET[id_produit]");


// vérifie si un formulaire a été soumis avec une action spécifique "ajouter_panier"
if (isset($_POST["action"]) && $_POST["action"] === "ajouter_panier") {

    //  vérifie si la variable de session "panier" n'est pas définie
    if (!isset($_SESSION["panier"])) {

        // clé unique pour identifier un produit dans le panier en combinant l'ID
        // créer une clé unique qui combine l'ID du produit avec ses caractéristiques comme que la couleur, la taille et la taille du bonnet
        $cle_produit = $_GET["id_produit"] . '_' . $_POST["couleur"] . '_' . $_POST["taille"] . '_' . $_POST["taille_bonnet"];

        $_SESSION["panier"] = [
            $cle_produit => [
                "id_produit" => $_GET["id_produit"],
                "quantite" => $_POST["quantite"],
                "taille" => $_POST["taille"],
                "taille_bonnet" => $_POST["taille_bonnet"],
                "couleur" => $_POST["couleur"],

            ]
        ];

        // affiche un message d'alerte de succès qui indique que le produit a été ajouté au panier et déclare la variable $produit_existe comme false lorsque le produit n'est pas déjà dans le panier
        $contenu .= "<div class=\"alert alert-success\">" . 'Vous avez ajouté ce produit au panier' . "</div>";
    } else {

        $produit_existe = false;
        // chaque élément du panier stocké dans la variable de session $_SESSION["panier"]
        foreach ($_SESSION["panier"] as $id_produit_panier => $details_produit) {

            //chaque élément du panier, il vérifie si les détails du produit correspondent aux données (couleur, taille, taille du bonnet, et image)
            if ($id_produit_panier == $_GET["id_produit"] && $details_produit["couleur"] == $_POST["couleur"] && $details_produit["taille"] == $_POST["taille"] && $details_produit["taille_bonnet"] == $_POST["taille_bonnet"] && $details_produit["image1"] == $_POST["image1"]) {

                $cle_produit = $_GET["id_produit"] . '_' . $_POST["couleur"] . '_' . $_POST["taille"] . '_' . $_POST["taille_bonnet"];

                // Si les détails correspondent à ceux du produit actuel, la quantité du produit dans le panier est mise à jour en ajoutant la quantité postée à la quantité existante
                $_SESSION["panier"][$cle_produit]["quantite"] += $_POST["quantite"];
                // $produit_existe est définie sur true pour indiquer que le produit existe déjà dans le panier
                $produit_existe = true;

                $contenu .= "<div class=\"alert alert-success\">" . 'Vous avez ajouté ce produit au panier' . "</div>";
                break;
            }
        }

        $cle_produit = $_GET["id_produit"] . '_' . $_POST["couleur"] . '_' . $_POST["taille"] . '_' . $_POST["taille_bonnet"];

        if (!$produit_existe) {

            $_SESSION["panier"][$cle_produit] = [
                "id_produit" => $_GET["id_produit"],
                "quantite" => $_POST["quantite"],
                "taille" => $_POST["taille"],
                "taille_bonnet" => $_POST["taille_bonnet"],
                "couleur" => $_POST["couleur"],
            ];

            $contenu .= "<div class=\"alert alert-success\">" . 'Vous avez ajouté ce produit au panier' . "</div>";
        }
    }
}


// COMMENTAIRES
/*  - Publier un commentaire */

if (!empty($_POST['com'])) {
    // a. Protection contre les injections SQL, viter les attaques de sécurité 
    $_POST['commentaire'] = isset($_POST['commentaire']) ? htmlspecialchars($_POST['commentaire']) : '';
    $_POST['contenu_com'] = isset($_POST['contenu_com']) ? htmlspecialchars($_POST['contenu_com']) : '';

    // b. La requêt,  insère un nouveau commentaire dans la table "commentaires", en spécifiant l'ID du produit
    $ajoutCom = $pdoVenusia->prepare("INSERT INTO commentaires (id_produit, id_membre, commentaire, contenu_com) VALUES (:id_produit, :id_membre,  :commentaire, :contenu_com)");


    /* c. J'associe les marqueurs à leur valeurs */
    $ajoutCom->execute([
        ':id_produit' => $_GET['id_produit'],
        ':id_membre' => $_SESSION["membres"]["id_membre"],/*id_membres car on connais l'id*/
        ':commentaire' => $_POST['commentaire'],
        ':contenu_com' => $_POST['contenu_com'],
    ]);
}

// AFFICHER LES COMMENTAIRES - Afficher les commentaires de l'article sélectionné
$affichageCom = $pdoVenusia->prepare("SELECT * FROM commentaires WHERE commentaires.id_produit = :id_produit");

$affichageCom->execute([
    ':id_produit' => $_GET['id_produit'],
]);
?>
<main>

    <!-- AFFICHAGE DES ERREURS -->

    <?php echo $contenu; ?>

    <!-- PRODUIT -->

    <form action="#" method="POST" class="mt-4">
        <div class="card mb-3" style="max-width: 2000px;">
            <div class="row g-0">
                <div class="col-md-4">

                    <img src="<?php echo $infosproduit['image1']; ?>" class="img-fluid rounded-start" alt="image d'illustration" height="800px" width="800px">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo $infosproduit['nom_produit']; ?></h2>
                        <div class="d-flex flex-row my-3 mb-4">
                            <span class="text-success ms-2">En stock </span>
                        </div>
                        <p class="card-title"><?php echo $infosproduit['description']; ?></p>
                        <div class="row mb-4">
                            <div class="col-md-4 col-6">
                                <label class="mb-2">Taille</label>
                                <select name="taille" class="form-select border border-secondary">
                                <option value="">Sélectionner une taille</option>
                                    <option value="XS">XS</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                    <option value="3XL">3XL</option>
                                    <option value="80">80</option>
                                    <option value="85">85</option>
                                    <option value="90">90</option>
                                    <option value="95">95</option>
                                    <option value="100">100</option>
                                    <option value="105">105</option>
                                    <option value="110">110</option>
                                    <option value="115">115</option>
                                    <option value="120">120</option>
                                    <option value="125">125</option>
                                    <option value="130">130</option>
                                </select>
                            </div>

                            <div class="col-md-4 col-6">
                                <label class="mb-2">Taille de bonnet</label>
                                <select name="taille_bonnet" class="form-select border border-secondary">
                                    <option value="">Sélectionner une taille</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    <option value="F">F</option>
                                    <option value="G">G</option>
                                    <option value="H">H</option>
                                    <option value="I">I</option>
                                    <option value="J">J</option>
                                    <option value="K">K</option>
                                    <option value="L">L</option>
                                    <option value="M">M</option>
                                    <option value="N">N</option>
                                    <option value="O">O</option>
                                </select>
                            </div>
                            <a href="guidestailles.php" class="text-dark d-inline-block m-2">Guide des tailles</a>
                            <div class="col-md-4 col-6">
                                <label class="mb-2">Couleur</label>
                                <select name="couleur" class="form-select border border-secondary">
                                <option value="">Sélectionner une couleur</option>
                                    <option value="Blanc">Blanc</option>
                                    <option value="Noir">Noir</option>
                                    <option value="Nude">Nude</option>
                                    <option value="Bordeaux">Bordeaux</option>
                                    <option value="Rose Vif">Rose Vif</option>
                                    <option value="Corail">Corail</option>
                                    <option value="Rouge">Rouge</option>
                                    <option value="Menthe">Menthe</option>
                                    <option value="Rose">Rose</option>
                                    <option value="Myrtille">Myrtille</option>
                                    <option value="Lilas">Lilas</option>
                                    <option value="Jaune Citron">Jaune Citron</option>
                                    <option value="Rose poudré">Rose poudré</option>
                                    <option value="Pêche">Pêche</option>
                                    <option value="Rouge Foncé">Rouge Foncé</option>
                                    <option value="Olive">Olive</option>
                                    <option value="Champagne">Champagne</option>
                                    <option value="Café">Café</option>
                                    <option value="Vert Sapin">Vert Sapin</option>
                                    <option value="Beige">Beige</option>
                                </select>
                            </div>



                            <div class="row mb-5">
                                <div class="col-md-8 col-6">
                                    <label class="mb-2">Quantité</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary" type="button" id="btnMin">-</button>
                                        </div>
                                        <input type="text" class="form-control text-center h-auto" value="1" id="quantite" name="quantite">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="btnPlus">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="card-text">Prix : <?php echo $infosproduit['prix']; ?>€</p>


                            <?php $id_produit = $_GET['id_produit'] ?>
                            <div class="btn ">
                                <input type="hidden" name="action" value="ajouter_panier">
                                <button type="submit" class="btn custom-button-2">AJOUTER AU PANIER</button>
                            </div><!-- fin div btn -->

                        </div><!-- fin div row mb-4 -->
                    </div><!-- fin div card -->
                </div><!-- fin div col-md-8 -->
            </div><!-- fin de card -->
    </form><!-- fin de form -->
    <!-- card commentaires -->

    <hr class="custom-hr mt-5 w-100">




    <!-- Le formulaire pour ajouter un commentaire -->

    <!-- Si l'utilisateur est connecté alors il peut écrire et publier un commentaire sous n'importe quel articles -->
    <?php if (estConnecte()) { ?>


        <form action="#" method="POST" class="col-12 col-md-5  mx-auto p-3">

            <h2 class="text-center p-2">Laissez un petit mot doux</h2>

            <div class="mb-3 ">
                <label for="commentaire">Titre</label>
                <input type="text" name="commentaire" id="commentaire" class="form-control">
            </div>

            <div class="mb-3">
                <label for="contenu_com">Votre message</label>
                <br>
                <textarea name="contenu_com" id="contenu_com" class="form-control" rows="10"></textarea>

            </div>
            <div class="d-flex justify-content-center">
                <input type="submit" value="Publier" class="btn btn-primary" name="com">
            </div>

            <!--  formulaire -->
        </form>
    <?php } else { ?><!-- Sinon sa affiche un message d'alerte disant que l'utilisateur doit se connecter -->
        <p class="alert alert-danger">Vous devez être connecté pour laisser un commentaire</p>
    <?php } ?>
    </form><!-- fin du form -->



    <!-- AFFICHAGE DES COMMENTAIRES -->
    <!-- card commentaires -->
    <h2 class="my-5 text-center">Commentaires du produit</h2>
    <?php
    $requete = $pdoVenusia->query("SELECT * FROM commentaires WHERE id_produit = $_GET[id_produit]");



    // Boucle pour recup les infos du membres coresspondant à chaque commentaire
    while ($produit = $requete->fetch(PDO::FETCH_ASSOC)) {
        $requetedeux = $pdoVenusia->query("SELECT * FROM membres where id_membre = $produit[id_membre]");

        $fichemembre = $requetedeux->fetch(PDO::FETCH_ASSOC);
    ?>


        <div class="card p-2 mb-3 mx-3">
            <div class="card-header">
                <p><?php echo $produit['commentaire']; ?></p>
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p><?php echo $produit['contenu_com']; ?></p>
                </blockquote>
                <div class="nom position-absolute bottom-0 end-0 translate-middle-x">
                    <p><i class="bi bi-chat-heart"></i> <?php echo $fichemembre["nom"] ?></p>

                </div>
            </div><!-- fin card body -->
        </div><!-- fin div card -->


    <?php
    } // Fin de la boucle while
    ?>



    </div><!-- fin div card mb-3 -->

</main><!-- FIN DU MAIN -->

<script src="assets/js/script.js"></script>

<?php
require("inc/footer.inc.php");
?>