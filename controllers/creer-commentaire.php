<?php


$user = userConnected();


$recetteTd = $_GET["id"] ?? 0;

$recette = new recette($recetteTd);

// Afficher le template  
require "templates/commentaire.php";