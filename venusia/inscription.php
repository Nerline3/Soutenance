<?php
/* 1- Require du fichier init: connexion à la BDD */
require "inc/header.inc.php";

/* 3- Inscription sur le site & la BDD */
if (!empty($_POST)) {
    /* Vérification du formulaire */
    if (!isset($_POST['civilite']) || $_POST['civilite'] != 'm' && $_POST['civilite'] != 'f' && $_POST['civilite'] != 'a') {
        $contenu .= "<div class=\"alert alert-danger\">Cette civilité n'est pas valable</div>";
    }

    if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 20) {
        $contenu .= "<div class=\"alert alert-danger\">Votre prénom doit faire entre 2 et 20 caractères</div>";
    }

    if (!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20) {
        $contenu .= "<div class=\"alert alert-danger\">Votre nom doit faire entre 2 et 20 caractères</div>";
    }

    if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $contenu .= "<div class=\"alert alert-danger\">Votre email n'est pas conforme</div>";
    }

    if (empty($contenu)) {
        /* si la variable $contenu est vide ça signifie qu'il n'y a pas d'erreur et on peut lancer la requete */
        $verifEmail = $pdoVenusia->prepare("SELECT * FROM membres WHERE email = :email");
        $verifEmail->execute([
            ':email' => $_POST['email']
        ]);
        /* Etant donné que la connexion se fera à partir du pseudo, nous vérifions ici que le pseudo entré par l'utilisateur voulant s'inscrire n'existe pas déjà dans la BDD. S'il existe déjà alors on lui mettra un message d'erreur, lui demandant de changer son pseudo. */

        if ($verifEmail->rowCount() > 0) {/* Si on récupère des résultats en BDDc'est que ce pseudo existe deja */
            $contenu .= "<div class=\"alert alert-danger\">Cette
             email est indisponible, veuillez en choisir un autre.</div>";
        } else {/* Le pseudo est disponible, la personne peut donc s'inscrire, on entre les infos en BDD */
            $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
            /* Grace a la fonction prédéfinie PASSORD_hash() on defini que l'on veut hashé un mdp. Cette fonction prend 2 arguments: 1- la chaine de caractère, 2- la façon de hasher(ici avec PASSWORD_DEFAULT) */

            $insert = $pdoVenusia->prepare('INSERT INTO membres (nom, prenom, email, mdp, statue) VALUES (:nom, :prenom, :email, :mdp, 0)');/* Ici le 0 représente le statut de la personne qui s'inscrit, par défaut c'est un utilisateur lambda. */

            $insert->execute(array(
                ':prenom' => $_POST['prenom'],
                ':nom' => $_POST['nom'],
                ':email' => $_POST['email'],
                ':mdp' => $mdp,/* Je récupère le mdp déjà hashé grace a ma variable(l.41) */
            ));

            if ($insert) {
                $contenu .= "<div class=\"alert alert-success\">Vous êtes bien inscrit sur le site, bienvenue ! <br><a href=\"connexion.php\">Cliquez ici pour vous connecter !</a></div>";
            } else {
                $contenu .= "<div class=\"alert alert-danger\">Erreur lors de l'inscription</div>";
            }
        }
    }
}
?>

<main class="container">
    <?php echo $contenu; ?>

    <!-- prenom/ nom/ email/ mdp -->

    <div class="row my-3">
        <div class="col-12 col-md-8 alert p-5">
            <h2 class="text-center">Inscrivez-vous</h2>
            <form action="#" method="POST">
                <!-- /!\ Il est essentiel lorsque l'on fait un formulaire de mise à jour de passer en value les données existantes : cela permet de voir ce qui existe et ce que l'on veut modifier -->

                <div class="col-12 col-md-8">
                    <label for="civilite">Votre Civilité</label>
                    <div class="form-check">
                        <input type="radio" name="civilite" id="civilite" value="f" class="form-check-input"> <label class="form-check-label" for="civilite">Madame</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="civilite" id="civilite" value="m" class="form-check-input"> <label class="form-check-label" for="civilite">Monsieur</label>
                    </div>
                </div><!-- CIVILITE/GENRE -->

                <div class="mb-3">
                    <label for="prenom">Votre Prénom</label>
                    <input type="text" name="prenom" id="prenom" class="form-control">
                </div><!-- PRENOM -->

                <div class="mb-3">
                    <label for="nom">Votre Nom</label>
                    <input type="text" name="nom" id="nom" " class=" form-control">
                </div><!-- NOM -->


                <div class="mb-3">
                    <label for="email">Votre Email</label>
                    <input type="text" name="email" id="emaill" class="form-control">
                </div><!-- EMAIL -->

                <div class="mb-3">
                    <label for="mdp">Votre Mot de passe</label>
                    <input type="password" name="mdp" id="mdp" class="form-control">
                </div><!-- MDP -->

                <div class="mb-3">
                    <label for="adresse_livraison">Adresse de livraison</label>
                    <input type="text" name="adresse_livraison" id="adresse_livraison" class="form-control">
                </div><!-- adresse_livraison -->

                <div class="mb-3">
                    <label for="adresse_facturation">Adresse de facturation</label>
                    <input type="text" name="adresse_facturation" id="adresse_facturation" class="form-control">
                </div><!-- adresse_facturation -->

                <input type="submit" value="S'inscrire" class="btn btn-outline-info"><!-- BOUTON -->

                <a href="connexion.php">
                    <p class="text-center">Déja un compte ?</p>
                </a><!-- lien page connexion -->

            </form><!-- fin du formulaire -->
        </div><!-- fin de la colonne -->
    </div><!-- fin du row -->
</main>
<!-- FIN DU MAIN -->

<!-- FOOTER -->
<?php
require "inc/footer.inc.php";
?>
