<?php

//recuperer l id de la recette
$id = $_GET["id"];

echo "<pre>";
print_r($id);
echo "</pre>";

//instaciierr un objet reccete ingredient pour récupérer les ingrédients de la recette
$recetteAllIngredients = new recette_ingredient();

//recuperer la liste des ingrédients de la recette
$recetteAllIngredients = $recetteAllIngredients->getIngredientsByRecette($id);


echo "<pre>";
print_r($recetteAllIngredients);
echo "</pre>";



/*require "templates/fragments/form-modifier-recette.php";*/

