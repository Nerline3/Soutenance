<?php
/* 1- Require du fichier init: connexion à la BDD */
require "inc/headeradmin.inc.php";

if (estAdmin()) {/* si c'est un admin il peut acceder à la page */
   

/* 3- Inscription sur le site & la BDD */
if (!empty($_POST)) {

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

            $insert = $pdoVenusia->prepare('INSERT INTO membres (nom, prenom, email, mdp, statue) VALUES (:nom, :prenom, :email, :mdp, :statue)');/* Ici le 0 représente le statut de la personne qui s'inscrit, par défaut c'est un utilisateur lambda. */

            $insert->execute(array(
                ':prenom' => $_POST['prenom'],
                ':nom' => $_POST['nom'],
                ':email' => $_POST['email'],
                ':mdp' => $mdp,
                ':statue' => $_POST['statue']
            ));

            if ($insert) {
                $contenu .= "<div class=\"alert alert-success\">Le membre a bien été ajouter ! <br></div>";
            } else {
                $contenu .= "<div class=\"alert alert-danger\">Erreur lors de l'inscription</div>";
            }
        }
    }
}

 
?>

    <main class="container">
        <?php echo $contenu; ?>
        <!-- Formulaire pour ajouter un membre  -->

        <h1 class="text-center">Ajout d'un membres</h1>

        <form action="#" method="POST" class="border border-black p-2">
            <div class="col-12 col-md-8">
                <label for="civilite">Votre Civilité</label>
                <input type="radio" name="civilite" id="civilite" value="f" class="form-check-input">Madame
                <input type="radio" name="civilite" id="civilite" value="m" class="form-check-input">Monsieur
            </div><!-- CIVILITE/GENRE -->

            <div class="mb-5 mx-auto">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control" required>
            </div><!--   NOM   -->

            <div class="mb-5 mx-auto">
                <label for="nom">Prénom</label>
                <input type="text" name="prenom" id="prenom" class="form-control" required>
            </div><!--   PRENOM   -->


            <div class="mb-3">
                <label for="email">Email</label>
                <input type="text" name="email" id="mail" class="form-control" required>
            </div><!--   EMAIL   -->

            <div class="mb-3">
                <label for="ref">Mot de passe</label>
                <input type="text" name="mdp" id="mdp" class="form-control" required>
            </div><!--   MDP   -->

            <div class="mb-3">
                <label for="statue">Statut</label>
                <select name="statue" id="statue">
                <option value="1">Administrateur</option>
                            <option value="0" <?php if(isset($ajoutMembre['statue']) && $ajoutMembre['statue'] == ''){echo "selected";} ?>>Utilisateur</option>
                </select>
            </div><!--   STATUT   -->

            <input type="submit" value="Ajouter" class="btn btn-primary" name="majMe">
        </form><!-- fin de form -->


    </main><!-- fin du main -->


</body>

<!-- FOOTER  -->
<?php
}
require "inc/footer.inc.php";
?>