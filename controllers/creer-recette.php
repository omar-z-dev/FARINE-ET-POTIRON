<?php

//role : afficher le formulaire de création de recette
//param : neant

// Initialisations diverses
$api = new api();

//recuperer le catalogue de farine
$catalogueFarines = $api->getCatalogueFarineByCurl();

//afficher le template
require "templates/fragments/creer-recette2.php"; 