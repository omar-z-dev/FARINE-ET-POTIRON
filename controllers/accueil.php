<?php
// ---------------------------


//ttes les recettes 
$recette = new recette();
$allRecettes = $recette->listAll();

// Afficher le template  
require "templates/pages/afficher-accueil-inscription.php";

