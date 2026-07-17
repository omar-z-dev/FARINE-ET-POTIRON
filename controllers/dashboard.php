<?php
// message de deconnection de l'utilisateur

//recuperer l'utilisateur connecté

$user = userConnected();

//instancier une recette
$recette = new recette();

//recuperer mes recettes
$mesRecettes = $recette->mesRecettes($user->id());

// Afficher le template  
require "templates/pages/afficher-dashboard.php";