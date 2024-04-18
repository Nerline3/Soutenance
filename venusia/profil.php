<?php
/* 1- appel de la variable*/
require 'inc/header.inc.php';

/* 2- requête pour récéperer les infos de mon utilisateur connecter */
$requete = $pdoVenusia->prepare("SELECT * FROM membres WHERE id_membre = :id_membre");
$requete->execute([
    ':id_membre' => $_SESSION['membres']['id_membre'],
]);
$userInfo = $requete->fetch(PDO::FETCH_ASSOC);

estAdmin() ? $paragraphe = "" : $paragraphe = "";


// 3-la deconnexion
if (isset($_GET['action']) && $_GET['action'] == 'deconnexion') {
    session_destroy();
    header('location:index.php');
    exit();
}
?>

<!-- Debut du main -->
<main class="container">
<?php echo $contenu ?>
    <div class="row">
        <div class="card text-bg-light mx-auto mb-3" style="max-width: 24rem;">
            <div class="card-header">
                <h5 class="card-title">Votre profil <img src="assets/img/pointrose.png" alt="" class="img-fluid" style="max-width: 20px;"></h5>
            </div>
            <div class="card-body">
                <p class="card-text">Prenom : <?php echo $userInfo['prenom'] ?></p>
                <p>Nom : <?php echo $userInfo['nom'] ?> </p>
                <p>Genre : <?php echo $userInfo['civilite'] ?> </p>
                <p>Mail : <?php echo $userInfo['email'] ?> </p>
                <a href="modifprofil.php?id_membre=<?php echo $userInfo['id_membre']; ?>" class="btn btn-primary">Mettre à jour</a>
                <a href="profil.php?action=deconnexion" class="btn btn-danger">Se déconnecter</a>
            </div><!-- fin card body -->
        </div><!-- fin de card -->
    </div><!-- fin de row -->

</main><!-- fin du main -->


<!-- Footer -->
<?php
require "inc/footer.inc.php";
?>
