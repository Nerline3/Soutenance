<?php
/* -Appel du fichier init: connexion à la BDD */
require "inc/headeradmin.inc.php";

if (!empty($_POST['majP'])) {/* vérifie si des données ont été soumises via la méthode POST et si les champs ne sont pas vides */
    $_POST['nom_produit'] = htmlspecialchars($_POST['nom_produit']);
    $_POST['description'] = htmlspecialchars($_POST['description']);
    $_POST['image1'] = htmlspecialchars($_POST['image1']);
    $_POST['image2'] = htmlspecialchars($_POST['image2']);
    $_POST['ref_produit'] = htmlspecialchars($_POST['ref_produit']);
    $_POST['couleur'] = htmlspecialchars($_POST['couleur']);
    $_POST['taille'] = htmlspecialchars($_POST['taille']);
    $_POST['stock'] = htmlspecialchars($_POST['stock']);
    $_POST['prix'] = htmlspecialchars($_POST['prix']);

    // b-la requête d'insertion pour ajouter des données
    $ajout = $pdoVenusia->prepare("INSERT INTO produits (nom_produit, description, image1, image2, ref_produit, couleur, taille, taille_bonnet, stock, prix, id_categorie) VALUES (:nom_produit, :description, :image1, :image2, :ref_produit, :couleur, :taille, :taille_bonnet, :stock, :prix, :id_categorie)");

    //  insérer des données provenant d'un formulaire 
    $ajout->execute(array(
        ':nom_produit' => $_POST['nom_produit'],
        ':description' => $_POST['description'],
        ':image1' => $_POST['image1'],
        ':image2' => $_POST['image2'],
        ':ref_produit' => $_POST['ref_produit'],
        ':couleur' => $_POST['couleur'],
        ':taille' => $_POST['taille'],
        ':taille_bonnet' => $_POST['taille_bonnet'],
        ':stock' => $_POST['stock'],
        ':prix' => $_POST['prix'],
        ':id_categorie' => $_POST['id_categorie'],
    ));

}
?>

<main class="container">
    <?php echo $contenu; ?>

    <!-- Formulaire pour ajouter un articles -->
    <h1 class="text-center mt-4">Ajout d'un article</h1>
    <form action="#" method="POST" class="border border-black p-2">
        <div class="mb-5 mx-auto">
            <label for="nom_produit">Nom de l'article</label>
            <input type="text" name="nom_produit" id="nom_produit" class="form-control" required>
        </div><!--   NOM   -->

        <div class="mb-3">
            <label for="description">Description de l'article</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control" required></textarea>
        </div><!--   DESCRIPTION   -->

        <div class="mb-3">
            <label for="image1">URL de l'image 1</label>
            <input type="text" name="image1" id="image1" class="form-control" required>
        </div><!--   URL IMAGE1   -->

        <div class="mb-3">
            <label for="image2">URL de l'image 2</label>
            <input type="text" name="image2" id="image2" class="form-control" required>
        </div><!--   URL IMAGE2   -->

        <div class="mb-3">
            <label for="ref_produit">Référence du produit</label>
            <input type="text" name="ref_produit" id="ref_produit" class="form-control" required>
        </div><!--   REFERENCE   -->

        <div class="mb-3">
            <label for="couleur">Couleurs</label>
            <select name="couleur" id="couleur" class="form-select">
                <?php
                //  sélectionne toutes les couleurs distinctes de la table "produits" dans la BDD
                $requeteCouleur = $pdoVenusia->query("SELECT DISTINCT couleur FROM produits");
                while ($couleur = $requeteCouleur->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=\"$couleur[couleur]\">$couleur[couleur]</option>";
                }
                ?>
            </select>
        </div><!--   COULEUR   -->

        <div class="mb-3">
            <label for="taille">Taille</label>
            <select name="taille" id="taille" class="form-select">
                <?php
                $requetetaille = $pdoVenusia->query("SELECT DISTINCT taille FROM produits");
                while ($taille = $requetetaille->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=\"$taille[taille]\">$taille[taille]</option>";
                }
                ?>
            </select>
        </div><!--   TAILLE   -->

        <div class="mb-3">
            <label for="taille_bonnet">Taille bonnet</label>
            <select name="taille_bonnet" id="taille_bonnet" class="form-select">
                <?php
                $requetetailleb = $pdoVenusia->query("SELECT DISTINCT taille_bonnet FROM produits");
                while ($tailleb = $requetetailleb->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=\"$tailleb[taille_bonnet]\">$tailleb[taille_bonnet]</option>";
                }
                ?>
            </select>
        </div><!--   TAILLE BONNET  -->

        <div class="mb-3">
            <label for="stock">Stock</label>
            <input type="text" name="stock" id="stock" class="form-control" required>
        </div><!--   STOCK   -->

        <div class="mb-3">
            <label for="prix">Prix</label>
            <input type="text" name="prix" id="prix" class="form-control" required>
        </div><!--   PRIX   -->

        <div class="mb-3">
            <label for="id_categorie">Catégorie</label>
            <select name="id_categorie" id="id_categorie" class="form-select">
                <?php
                $requetecategorie = $pdoVenusia->query("SELECT DISTINCT id_categorie, nom_categorie FROM categorie");
                while ($categorie = $requetecategorie->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=\"$categorie[id_categorie]\">$categorie[nom_categorie]</option>";
                }
                ?>
            </select>
        </div><!-- CATEGORIE -->

        <input type="submit" value="Ajouter l'article" class="btn btn-primary" name="majP"><!-- bouton de soumission -->
    </form><!-- fin du formulaire -->
</main><!-- fin main -->

<!-- FOOTER -->
<?php
require "inc/footer.inc.php";
?>