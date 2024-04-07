<?php 
// appel du  fichier init 
/* 1- Require du fichier init: connexion à la BDD */
require "inc/headeradmin.inc.php";

// Verifier la connexion
if(!$pdoVenusia) die('Erreur :'  .mysqli_connect_errno());
if(!isset($_SESSION)){
    // demarer la session
}

if(!isset($_SESSION['panier'])){
    $_SESSION['panier']=array();
    if(isset($_GET['id_produit'])){
        $id=$_GET['id_produit'];
        $article = $pdoVenusia->query("SELECT * FROM produits WHERE id_produit=$id");
        if(empty(mysqli_fetch_assoc($article))){
            die("Ce produit n'existe pas ");
        }
        if(empty($article)){
            die ("Ce produit n'existe pas");
        }
        if(isset($_SESSION['panier'][$id])){
            $_SESSION['panier'][$id]++;
        }else{
            $_SESSION['panier'][$id]=1;
        }
        header("Location:index.php");
    }
}
?>