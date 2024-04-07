<?php
/* 1- Require du fichier init: connexion à la BDD */
require "inc/header.inc.php";

/* 3- Verification de l'id de la personne connecté et récupération de ses infos */
if (isset($_GET['id_membre']) && $_SESSION['membres']['id_membre'] == $_GET['id_membre'] || estAdmin()) { //je vérifie qu'il ya un id dans l'URL et que cet id correspond à celui de la personne connecté
    $infoUser = $pdoVenusia->prepare("SELECT * FROM membres WHERE id_membre = :id_membre");
    $infoUser->execute(array(
        'id_membre' => $_GET['id_membre'],
    ));

    if ($infoUser->rowCount() == 0) {
        header('location:index.php');
        exit();
    }
    $fiche = $infoUser->fetch(PDO::FETCH_ASSOC);
} else {
    header('location:index.php');
    exit();
}

/* Traitement du formulaire */

if (!empty($_POST['modif'])) {
    //a) protection contre les injections de SQL
    $_POST['prenom'] = htmlspecialchars($_POST['prenom']);
    $_POST['nom'] = htmlspecialchars($_POST['nom']);
    $_POST['email'] = htmlspecialchars($_POST['email']);

    /* b) verification des diff. champs */
    if (empty($contenu)) {
        if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $contenu .= "<div class=\"alert alert-danger\">Votre email n'est pas conforme</div>";
        }

        /* c) si pas d'erreurs vérification du email*/
        if (empty($contenu)) {
            if ($_POST['email'] != $_SESSION['membres']['email']) {

                $verifPseudo = $pdoVenusia->prepare("SELECT * FROM membres WHERE email = :email");

                $verifPseudo->execute([
                    'email' => $_POST['email']
                ]);

                if ($verifPseudo->rowCount() > 0) {
                    $contenu .= "<div class=\"alert alert-danger\">Cet email est déjà utilisé, choisissez-en un autre !</div>";
                }
            }
        }

        /* d) update du profil */
        $modif = $pdoVenusia->prepare("UPDATE membres SET nom = :nom, prenom = :prenom, civilite = :civilite, email = :email WHERE id_membre = :id_membre");

        $modif->execute([
            ':prenom' => $_POST['prenom'],
            ':nom' => $_POST['nom'],
            ':civilite' => $_POST['civilite'],
            ':email' => $_POST['email'],
            ':id_membre' => $_GET['id_membre'],/* ou => $_SESSION['membres']['id_membres'] */
        ]);
        if ($modif) {
            header('location:profil.php');
            exit();
        } else {
            $contenu .= "<div class=\"alert alert-danger\">Erreur lors de la modification</div>";
        }
    }
}

?>
<?php echo $contenu ?>
<main class="container">

    <div class="col-12 col-mb-5 mx-auto alert ">
        <h1 class="text-center">Mise à jour du profil</h1>
        <form action="#" method="POST">

            <div class="mb-3">
                <label for="nom">Votre nom</label>
                <input type="text" name="nom" id="nom" value="<?php echo $fiche['nom']; ?>" class="form-control">
            </div>

            <div class="mb-3">
                <label for="prenom">Votre prénom</label>
                <input type="text" name="prenom" id="prenom" value="<?php echo $fiche['prenom']; ?>" class="form-control">
            </div>

            <div class="mb-3">
                <label for="civilite">Votre Civilité</label>
                <select name="civilite" id="civilite" class="form-control">
                    <option value="Femme">Madame</option>
                    <option value="Homme">Monsieur</option>
                </select><!-- Ici nous sélectionnons de façon dynamique l'option correspondante à l'information en BDD -->
            </div>

            <div class="mb-3">
                <label for="email">Votre email</label>
                <input type="email" name="email" id="emaill" class="form-control" value="<?php echo $fiche['email']; ?>">
            </div>

            <div class="text-center">
                <input type="submit" value="Modifier le profil" class="btn btn-outline-info mt-3" name="modif">
            </div>

        </form><!-- fin du formulaire -->
    </div><!-- fin de la colonne -->
    </section><!-- fin rangée -->

</main>


<?php
require "inc/footer.inc.php";
?>
</body>

</html>