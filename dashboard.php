<?php
// ---------------------------
// Initialisations diverses
require_once "lib/init.php";

// message de deconnection de l'utilisateur

//recuperer l'utilisateur connecté


$user = userConnected();

//instancier une recette
$recette = new recette();

//recuperer mes recettes
$mesRecettes = $recette->mes_recettes($user->id());


// Afficher le template  
require "templates/pages/afficher-dashboard.php";