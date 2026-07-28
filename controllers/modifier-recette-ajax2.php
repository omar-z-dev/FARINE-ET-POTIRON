<?php

//role : afficher la page de modif d'une recette

//recuperer l id de la recette
$id = $_GET["id"];

/*echo "<pre>"; echo "id de la recette : ";
print_r($id);
echo "</pre>";*/

//instancier un objet recette pour récupérer les informations de la recette
$recette = new recette();
$recette->load($id);


//instaciierr un objet reccete ingredient pour récupérer les ingrédients de la recette
$recetteAllIngredients = new recette_ingredient();

//recuperer la liste des ingrédients de la recette
$recetteAllIngredients=$recetteAllIngredients->getIngredientsByRecette($id);



//recuperer la liste des farines de la recette

$recetteAllFarines = new recette_ingredient();
$listeFarines = $recetteAllFarines->getFarinesByRecette($id);

/*$api = new api();
$catalogueFarines = $api->getCatalogueFarineByCurl();*/


/*echo "<pre>"; echo "///----liste des AUTRE ingrédients ((((recetteAllIngredients))) de la recette : ";
print_r($recetteAllIngredients);
echo "</pre>";

echo "<pre>"; echo "++++++---liste des farines de la recette ((((listeFarines)))) : ";
print_r($listeFarines);
echo "</pre>";*/

require "templates/fragments/form-modifier-recette2.php";
