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
<!-- FIN DEBUT DU MAIN -->
<main class="main-articles">
    <div class="row">
        <div class="col-12 titrearticle">
            <h1>Membres</h1>
        </div><!-- fin div titrearticle -->
        <?php
        // Requête SQL pour récupérer les produits de la catégorie 'Soutiens-gorges'
        $requete = $pdoVenusia->query("SELECT * FROM membres");  

        // Boucle pour afficher les produits
        while ($produit = $requete->fetch(PDO::FETCH_ASSOC)) {

        ?>
            <!-- membres.php -->
            <div class="col-md-4 mb-3"> 
                <!-- Ajout de la classe mb-3 pour la marge en bas -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Nom :<?php echo $produit['nom'] ?></h5>
                <h5 class="card-title">Prénom :<?php echo $produit['prenom'] ?></h5>
                <p class="card-text">Genre :<?php echo $produit['civilite'] ?></p>
                <p class="card-text">Email :<?php echo $produit['email'] ?></p>
                <p class="card-text">Statut :<?php echo $produit['statue'] ?></p>
                <a href="membres.php?action=suppression&id_membre=<?php echo "$produit[id_membre]"; ?>" class="btn btn-danger" onclick="return(confirm('Êtes vous sûr de vouloir supprimer cet article ?'))"><i class="bi bi-trash3"></i></a>
            </div>
        </div><!-- fin div card -->
    </div><!-- fin div col-md-4 mb-3  -->
        <?php
        } // Fin de la boucle while
        ?>

    </div><!-- fin div row -->
</main><!-- fin main -->
<script src="assets/js/script.js"></script>

<!-- footer -->
<?php
require "inc/footer.inc.php";}
?>
