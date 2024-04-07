<?php
/* 1- Require du fichier init: connexion à la BDD */
require "inc/headeradmin.inc.php";

if (estAdmin()){

if (isset($_GET['action']) && $_GET['action'] == 'suppression' && isset($_GET['id_commentaire'])) {/* Je verifie que toutes les infos ci-dessus  (action, action qui correspond à la suppression et id_articles) sont bien présentes dans l'URL */

    $delete = $pdoVenusia->prepare("DELETE FROM commentaires WHERE id_commentaire = :id_commentaire");

    $delete->execute(array(
        ':id_commentaire' => $_GET['id_commentaire'],
    ));
    if ($delete->rowCount() == 0) { //On verifie si SQL renvoie 0 rangée.
        $contenu .= "<div class=\"alert alert-danger\"> Erreur de suppression de l'article ayant l'id $_GET[id_commentaire]</div>";
    } else {/* La suppression s'execute  */
        $contenu .= "<div class=\"alert alert-success\">L'article n° $_GET[id_commentaire] a bien été supprimé.</div>";
    }
}

?>



<main class="main-articles">
    <div class="row">
        <div class="col-12 titrearticle">
            <h1>Commentaires</h1>
        </div>
        <?php
        // Requête SQL pour récupérer les produits de la catégorie 'Soutiens-gorges'
        $requete = $pdoVenusia->query("SELECT * FROM commentaires, membres WHERE commentaires.id_membre = membres.id_membre");  

        // Boucle pour afficher les produits
        while ($produit = $requete->fetch(PDO::FETCH_ASSOC)) {

        ?>
            <!-- affichage du commentaire en temps que membre -->
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title">L'id du produit :<?php echo $produit['id_produit'] ?></h5>
                    <h5 class="card-title">L'id du membre :<?php echo $produit['prenom']; echo $produit['nom'] ?></h5>
                    <p class="card-text">Titre commentaire :<?php echo $produit['commentaire'] ?></p>
                    <p class="card-text">Contenu :<?php echo $produit['contenu_com'] ?></p>
                    <a href="commentaires.php?action=suppression&id_commentaire=<?php echo "$produit[id_commentaire]"; ?>" class="btn btn-danger" onclick="return(confirm('Êtes vous sûr de vouloir supprimer cet article ?'))"><i class="bi bi-trash3"></i></a>
                </div>
            </div><!-- fin div card -->
        <?php
        } // Fin de la boucle while
        ?>

    </div><!-- fin div row -->
</main><!-- fin main -->
<script src="assets/js/script.js"></script>

<?php
}
require "inc/footer.inc.php";
?>
</body>

</html>