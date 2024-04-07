<?php 
/* 1- Connexion à la BDD */
$pdoVenusia = new PDO(/* php data object (object qui permet de connecter a la bdd) */
    'mysql:host=localhost;dbname=venusia',
    'root',/* NOM D'UTILISATEUR */
    '',/* POUR LES MOTS DE PASSE // vide sur PC */
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,//demande l'affichage des erreurs sql dans la page sous forme de warning
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',//précise le jeu de caractères à utiliser lors de l'affichage de ces erreurs
    )
    );

    /* 2- Ouverture de session */
    session_start();/* intitaliser la session */

    /* 3- initialisation de la variable contenu qui va vous servire pour afficher des erreurs sur plusieurs pages */
    $contenu = "";
    // /!\ Attention, pas d'espaces !! 

    /* 4- on inclue le fichier functions */
    require('inc/functions.inc.php');
?>