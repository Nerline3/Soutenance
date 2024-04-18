<?php
/* 1- Require du fichier init: connexion à la BDD */
require "inc/header.inc.php";


/* - Traitement du formulaire de connexion */
if (!empty($_POST)) {
    if (empty($_POST['email']) || empty($_POST['mdp'])) {
        $contenu .= "<div class=\"alert alert-danger\">L'email et le mot de passe sont requis</div>";
    }
    if (empty($contenu)) { //si la variable $contenu est vide alors je n'ai pas d'erreurs, je peut donc commencer à connecter mon utilisateur

        $verifEmail = $pdoVenusia->prepare("SELECT * FROM membres WHERE email = :email"); //Je verifie si le pseudo entré par l'utilisateur correspond à un pseudo dans ma BDD

        $verifEmail->execute([
            ':email' => $_POST['email'],
        ]); //J'associe le marqueur à l'information récupérée dans le formulaire

        if ($verifEmail->rowCount() == 1) {
            $membre = $verifEmail->fetch(PDO::FETCH_ASSOC);/* Je récupère les infos de la personnes dont le pseudo a été donné */

            if (password_verify($_POST['mdp'], $membre['mdp'])) {
                /* password_verify() est une fonction prédéfinie de PHP, elle permet de verifier que 2  chaines de caractères se correspondent. Elle prend donc 2 arguments:
                1- la chaîne entrée par l'utilisateur dans le formulaire
                2- la chaîne de caractère entrée lors de sont inscription
                elle compare les deux et renvoie le booléen TRUE ou FALSE */

                $_SESSION['membres'] = $membre; //J'assigne les informations de l'utilisateur qui se connecte (que j'ai récupéré grâce a ma requête $membre) à $_SESSION qui comme toutes les super globales va créer un tableau multidimentionnel qui contient les informations
                header('location:profil.php');
                exit();/* si on a récupéré les bonnes infos on redirige l'utilisateur vers la page profile.php */
            } else {
                /* $contenu .= "<div class=\"alert alert-danger\">Attention, mot de passe incorrect !</div>"; */
            }
        } else { //si on ne trouve pas le pseudo en BDD
            $contenu .= "<div class=\"alert alert-danger\">Attention, email incorrect !</div>";
        }
    }
}

/* - Traitement du formulaire de connexion */
if (!empty($_POST)) {
    if (empty($_POST['email']) || empty($_POST['mdp'])) {
        $contenu .= "<div class=\"alert alert-danger\">L'email et le mot de passe sont requis</div>";
    }
    if (empty($contenu)) { //si la variable $contenu est vide alors je n'ai pas d'erreurs, je peut donc commencer à connecter mon utilisateur

        $verifEmail = $pdoVenusia->prepare("SELECT * FROM membres WHERE email = :email"); //Je verifie si le pseudo entré par l'utilisateur correspond à un pseudo dans ma BDD

        $verifEmail->execute([
            ':email' => $_POST['email'],
        ]); //J'associe le marqueur à l'information récupérée dans le formulaire

        if ($verifEmail->rowCount() == 1) {
            $membre = $verifEmail->fetch(PDO::FETCH_ASSOC);/* Je récupère les infos de la personnes dont le pseudo a été donné */

            if ($_POST["mdp"] == $membre["mdp"]) {
                /*  // Vérification que le mot de passe saisi dans le formulaire correspond au mot de passe du membre dans la base de données */

                $_SESSION['membres'] = $membre; //J'assigne les informations de l'utilisateur qui se connecte (que j'ai récupéré grâce a ma requête $membre) à $_SESSION qui comme toutes les super globales va créer un tableau multidimentionnel qui contient les informations
                header('location:profil.php');
                exit();/* si on a récupéré les bonnes infos on redirige l'utilisateur vers la page profile.php */
            } else {
                /* $contenu .= "<div class=\"alert alert-danger\">Attention, mot de passe incorrect !</div>"; */
            }
        } else { //si on ne trouve pas le pseudo en BDD
            $contenu .= "<div class=\"alert alert-danger\">Attention, email incorrect !</div>";
        }
    }
}

?>


<main class="container">
    <h1>Connectez-vous !</h1>
    <!-- // Affiche les messages   -->
    <?php echo $contenu; ?>

    <form action="#" method="POST" class="p-5 my-2 border-primary">
        <div class="mb-3">
            <label for="email">Email</label>
            <input type="text" name="email" id="emaill" class="form-control">
        </div>

        <div class="mb-3">
            <label for="mdp">Mot de passe</label>
            <input type="password" name="mdp" id="mdp" class="form-control">
        </div>

        <input type="submit" value="Se connecter" class="btn btn-primary">

    </form><!-- fin de form -->


</main>
<!-- fin du main -->

<?php
require "inc/footer.inc.php";
?>