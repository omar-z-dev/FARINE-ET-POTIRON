<?php
//role : afficher liste de mes recettes

//recuperer l'utilisateur connecté
$user = userConnected();

//instancier une recette
$recette = new recette();

//recuperer mes recettes
$mesRecettes = $recette->mesRecettes($user->id());
 // Afficher le template  
 require "templates/fragments/liste-recettes.php";