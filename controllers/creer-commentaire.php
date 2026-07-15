<?php

//role : afficher la page de creation de commentaire
//param : id de la recette

// Initialisations diverses
$user = userConnected();

//recuperer l'id de la recette
$recetteTd = $_GET["id"] ?? 0;

//instancier une recette
$recette = new recette($recetteTd);

// Afficher le template  
require "templates/commentaire.php";