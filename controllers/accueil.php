<?php
// ---------------------------
// Initialisations diverses
require_once "lib/init.php";


//ttes les recettes 
$recette = new recette();
$allRecettes = $recette->listAll();

// Afficher le template  
require "templates/pages/afficher-accueil-inscription.php";

