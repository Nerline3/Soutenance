<?php

// vérifie si le formulaire a été soumis via la méthode POST
if (isset($_POST['sends'])) {
    $email = $_POST['email'];

    $insert = $pdoVenusia->prepare('INSERT INTO newsletter (email) VALUES (:email)');

    $insert->execute(array(
        ':email' => $_POST['email'],
    ));
    {
        echo '<div class="alert alert-success" role="alert">Votre inscription a bien été pris compte !</div>';
    }
}
?>
<!-- script JS -->
<script src="/assets/js/script.js"></script>
<footer><!-- debut du footer -->
    <div class="row mb-3 footer">
        <section class="col-3 aide">
            <h5>Aide</h5>
            <p><a href="contact.php">Contactez-nous</a></p>
            <p><a href="guidestailles.php">Guide des tailles</a></p>
            <p><a href="soinlingerie.php">Prendre soin de votre lingerie</a></p>
        </section>
        <!-- fin section -->
        <section class="col-3 decouvrir">
            <h5>Découvrir</h5>
            <a href="histoire.php">
                <p>Notre histoire</p>
            </a>
        </section><!-- fin section -->
        <section class="col-11 col-md-5 email">
            <div class="news">
                <h4 class="ms-3">INSCRIVEZ-VOUS À LA NEWSLETTER</h4>
                <!-- début du forme -->
                <form action="#" method="POST" class="d-flex align-items-center ms-3">
                    <label for="email"></label>
                    <input type="email" id="email" name="email" required placeholder="email">
                    <button type="submit" name="sends" class="btn btn-secondary">
                        <i class="bi bi-send"></i>
                    </button>
                </form><!-- fin div form -->
            </div><!-- fin div news -->

            <div class="reseaux">
                <a href="https://www.threads.net/login" target="_blank">
                    <p><i class="bi bi-threads"></i></p>
                </a>
                <a href="https://www.instagram.com/" target="_blank">
                    <p><i class="bi bi-instagram"></i></p>
                </a>

                <a href="https://twitter.com" target="_blank">
                    <p><i class="bi bi-twitter-x"></i></p>
                </a>
                <a href="https://www.pinterest.fr/" target="_blank">
                    <p><i class="bi bi-pinterest"></i></p>
                </a>
                <a href="https://www.tiktok.com" target="_blank">
                    <p><i class="bi bi-tiktok"></i></p>
                </a>
            </div><!-- fin div reseaux -->
        </section><!-- fin section -->
        <div class="row">
            <section class="col-12 col-md-3 aide d-md-flex flex-md-row flex-column">
                <p class="d-md-block">Tel : 02 00 00 00 02</p>
            </section>
            <section class="col-12 col-md-3 aide d-md-flex flex-md-row flex-column">
                <p class="d-md-block">Mail : venusiaacountservicelingerie@gmail.com</p>
            </section>
            <section class="col-12 col-md-3 aide d-md-flex flex-md-row flex-column">
                <p class="d-md-block">6 boulevard louis loucheur, Suresnes</p>
            </section>
        </div><!-- fin div row -->

    </div>
    <div class="container text-center">
        <p>&copy;Venusia product by Nerline Martinet, 2024</p>
        <p>
            <a href="mentionslegales.php" class="text-decoration-none me-3 text-dark">Mentions légales</a>
            <a href="chartreconfidentialite.php" class="text-decoration-none text-dark">Charte de confidentialité</a>
        </p>
    </div><!-- fin container -->
</footer><!-- fin du footer -->

<!-- Lien JS bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>