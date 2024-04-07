<?php 
/* 1- Création de la fonction de debug: debug() */
function debug($mavar){
    echo "<pre class=\"alert alert-warning\">";
    var_dump($mavar);
    echo "</pre>";
}

/* 2- création de la fonction pour vérifier qu'un utilisateur est connecté */
 function estConnecte(){
     if(isset($_SESSION['membres'])){/* $_SESSION permet de récuperer des informations sur la session de la personne se trouvant sur le site actuellment. Ici je precise que $_SESSION doit aller chercher les infos concernant la tablles membres */
         return true; //la personne est connectée

     }else{
         return false; //la personne n'est pas connectée
     }
 }

/* Fonction estAdmin() pour vérifier qu'un utilisateur est admin */

 function estAdmin(){
     if(estConnecte() && $_SESSION['membres']['statue'] == 1){#on verifie que l'utilisateur rempli les conditions de notre fonction estConnecte() ET que sont statut en BDD correspond à 1 (admin) 0 (utilisateur)
         return true;#connecté et admin
     }else{
        return false;#pas admin 
    }
 }