<?php
/* 1- Require du fichier init: connexion à la BDD */
require "inc/headeradmin.inc.php";

if (estAdmin()) { 

/* 3- Suppression d'un article */
if (isset($_GET['action']) && $_GET['action'] == 'suppression' && isset($_GET['id_produit'])) {/* Je verifie que toutes les infos ci-dessus  (action, action qui correspond à la suppression et id_articles) sont bien présentes dans l'URL */

    $delete = $pdoVenusia->prepare("DELETE FROM produits WHERE id_produit = :id_produit");

    $delete->execute(array(
        ':id_produit' => $_GET['id_produit'],
    ));
    if ($delete->rowCount() == 0) { //On verifie si SQL renvoie 0 rangée.
        $contenu .= "<div class=\"alert alert-danger\"> Erreur de suppression de l'article ayant l'id $_GET[id_produit]</div>";
    } else {/* La suppression s'execute  */
        $contenu .= "<div class=\"alert alert-success\">L'article n° $_GET[id_produit] a bien été supprimé.</div>";
    }
}

// 3-la deconnexion
if(isset($_GET['action']) && $_GET['action'] == 'deconnexion'){
    session_destroy();
    header('location:index.php');
    exit();
}
?>

<br><br><br><br><br><br>
    <main class="main-articles">
        <div class="row">
            <div class="col-12 titrearticle">
                <h1>Tous les articles </h1>
            </div>
            <?php
            // Requête SQL pour récupérer les produits de la catégorie 'Soutiens-gorges'
            $requete = $pdoVenusia->query("SELECT * FROM produits");

            $counter = 1;

            // Boucle pour afficher les produits
            while ($produit = $requete->fetch(PDO::FETCH_ASSOC)) {


            ?>
                <!-- articles1.php -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card" style="width: 18rem;">
                        <a href="ficheproduit.php?id_produit=<?php echo $produit['id_produit']; ?>">
                            <div class="infos">
                                <div id="images">
                                    <img src="<?php echo $produit['image1']; ?>" alt="image d'illustration" class="img-fluid mainImage" id="mainImage1">
                                    <img src="<?php echo $produit['image2']; ?>" alt="image d'illustration" class="img-fluid mainImage d-none" id="mainImage2">
                                </div>
                                <div class="card-body">
                                    <p><?php echo $produit['nom_produit']; ?></p>
                                    <p class="card-text"><a href="#" style="text-decoration: none;"><?php echo $produit['couleur']; ?></a></p>
                                    <p class="card-text"><a href="#" style="text-decoration: none;"><?php echo $produit['prix']; ?></a></p>
                                </div>
                            </div>
                        </a>
                        <form method="POST" action="panier.php">                           
                                <a href="articles.php?action=suppression&id_produit=<?php echo "$produit[id_produit]"; ?>" class="btn btn-danger" onclick="return(confirm('Êtes vous sûr de vouloir supprimer cet article ?'))"><i class="bi bi-trash3"></i></a>
                                
                        </form>

                    </div>
                </div>
            <?php
            } // Fin de la boucle while
            ?>

        </div>
    </main><!-- fin main -->
    <script src="assets/js/script.js"></script>

    <?php
       }  
    require "inc/footer.inc.php";
    ?>