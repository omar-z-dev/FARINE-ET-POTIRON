<?php
/*controleur : rechercher un recette par type et region
param : type : type de l'artiste et region : region de l'artiste */

// Initialisations diverses
require_once "lib/init.php";

//recuperer les parametres de recherche
$titre      = $_GET["titre"] ?? "";
$difficulte = $_GET["difficulte"] ?? "";
$duree_max  = $_GET["duree"] ?? "";
$farine     = $_GET["farine"] ?? "";

//instancier un recette
$recette = new recette();

$listeRecettes = $recette->getRecette(
    $titre,
    $difficulte,
    $duree_max,
    $farine
);


// Afficher le template  
require "templates/fragments/recherche-liste-recettes.php";

