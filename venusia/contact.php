<?php
require "inc/header.inc.php";

if (isset($_POST['send'])) {/* vérifie si le formulaire a été soumis */
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $insert = $pdoVenusia->prepare('INSERT INTO contact (nom, prenom, email, message) VALUES (:nom, :prenom, :email, :message)');

    $insert->execute(array(
        ':nom' => $_POST['nom'],
        ':prenom' => $_POST['prenom'],
        ':email' => $_POST['email'],
        ':message' => $_POST['message'],
    )); {
        echo '<div class="alert alert-success" role="alert">Votre message a été envoyé avec succès !</div>';
    }
}

?>

<!-- DEBUT DU MAIN -->
<main class="main-contact ">
    <div class="imagefond">
        <img src="assets/img/Rihanna-Photoshoot-for-Savage-X-Fenty-Spring-Collection-2020-11.jpg" alt="">
    </div><!-- fin div imagefond -->

    <div class="contact mt-0 pt-0 mb-2"> <!-- Réduction des marges supérieure et inférieure -->

        <div class="titreh1">
            <h1>Contactez-nous</h1>
        </div>
        <form method="POST" action="">
            <div class="container-contact">
                <div class="row">
                    <div class="col-6"><input type="text" name="nom" placeholder="Nom" class="form-control"></div>
                    <div class="col-6"><input type="text" name="prenom" placeholder="Prénom" class="form-control"></div>
                    <div class="col-12"><input type="email" name="email" placeholder="Email" class="form-control"></div>
                    <div class="col-12">
                        <textarea rows="4" name="message" placeholder="Votre message" class="form-control"></textarea>
                        <div class="btnenv mt-2"> <!-- Réduction de la marge supérieure -->
                            <input type="submit" name="send" value="Envoyer" class="btn btn-secondary">
                        </div><!-- fin div btnenv -->
                    </div><!-- fin div col-12 -->
                </div><!-- fin div row -->
            </div><!-- fin div container -->
        </form><!-- fin de form -->
    </div><!-- fin div contact -->

    <div class="infomarque text-center mt-2">
        <p>Le service client est ouvert du lundi au vendredi.</p>
        <p>de 9h30 à 13h, et de 14h à 17h, hors jours fériés.</p>
        <h4><i class="bi bi-envelope-at-fill"></i> venusiaacountservicelingerie@gmail.com</h4>
        <p><i class="bi bi-telephone-fill"> </i>02 00 00 00 02</p>
    </div><!-- fin div infomarque -->
</main><!-- fin du main -->

<!-- FOOTER -->
<?php
require "inc/footer.inc.php";
?>