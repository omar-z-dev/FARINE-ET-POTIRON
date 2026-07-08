<?php

//recuperer l id de la recette
$id = $_GET["id"];


$recetteModel = new recette();
$recetteModel->load($id);

$recette = $recetteModel;


require "templates/fragments/form-modifier-recette.php";

