<?php
require "inc/header.inc.php";

if (isset($_POST['send'])) {
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
    ));

    // Exécutez la requête préparée

}

?>

<main class="main-contact">
    <div class="imagefond">
        <img src="assets/img/ashley-graham-bikinis-at-home-photo-shoot.jpg" alt="">
    </div>


    <div class="contact">
        <div class="titreh1">
            <h1>Contactez-nous</h1>
        </div>
        <form method="POST" action="">
            <div class="container-contact">
                <div class="row">
                    <div class="col-6"><input type="text" name="nom" placeholder="Nom" /></div>
                    <div class="col-6"><input type="text" name="prenom" placeholder="Prénom" /></div>
                    <div class="col-12"><input type="email" name="email" placeholder="Email" /></div>
                    <div class="col-12">
                        <textarea rows="4" cols="50" name="message" placeholder="Votre message"></textarea>
                        <div class="btnenv">
                            <input type="submit" name="send" value="Envoyer" class="btn btn-secondary">
                        </div>
                    </div>
                </div>
            </div>
        </form>
       
</div>
 <div class="infomarque text-center mt-2">
    <p>Le service client est ouvert du lundi au vendredi.</p>
    <p>de 9h30 à 13h, et de 14h à 17h, hors jours fériés.</p>
    <h4><i class="bi bi-envelope-at-fill"></i> venusiaacountservicelingerie@gmail.com</h4>
    <p><i class="bi bi-telephone-fill">  </i>02 00 00 00 02</p>
</main><!-- fin du main -->

<?php
require "inc/footer.inc.php";
?>
</body>

</html>