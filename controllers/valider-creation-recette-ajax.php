<?php

// recup er les données du formulaire
$utilisateur_id = $_SESSION["id"];
 //recette base
$titre       = $_POST["titre"];
$description = $_POST["description"];
$duree       = $_POST["duree"];
$difficulte  = $_POST["difficulte"];
$date_maj = date("Y-m-d H:i:s");

//farines
// recu en un tableau associatif
$farines             = $_POST["farines"];
$quantiteFarines     = $_POST["quantite_farines"];
$uniteFarines        = $_POST["unite_farines"];

// autres ingredients
// recu en un tableau associatif
$ingredients         = $_POST["ingredients"];
$quantiteIngredients = $_POST["quantite_ingredients"];
$uniteIngredients    = $_POST["unite_ingredients"];


// Vérifier qu'aucun champ n'est vide
/*if (empty($titre)|| 
    empty($description)|| 
    empty($duree)|| 
    empty($difficulte)|| 
    empty($farines)|| 
    empty($quantiteFarines)|| 
    empty($uniteFarines)|| 
    empty($ingredients)|| 
    empty($quantiteIngredients)|| 
    empty($uniteIngredients)) {

    echo "<p style='color:red; font-weight:bold'>
            ❌ Veuillez remplir tous les champs.
          </p>";
    exit;
}*/

//instancier une recette
$recette = new recette();

$recette->set("utilisateur_id", $utilisateur_id);
$recette->set("titre", $titre);
$recette->set("description", $description);
$recette->set("duree", $duree);
$recette->set("difficulte", $difficulte);
$recette->set("date_maj", $date_maj);

//ajouter la recette
$recette->insert();
//envoyer un message de confirmation ( sera recup en java pour affichage du messge succes insertion et suppression du formulaire d'ajout de recette)


//ajouter les farines
for ($i = 0; $i < count($farines); $i++) {

    $farine = new ingredient();
    
    $farine->set("recette_id", $recette->id());
    $farine->set("nom", $farines[$i]);
    $farine->set("quantite", $quantiteFarines[$i]);
    $farine->set("unite", $uniteFarines[$i]);
    $farine->insert();
}



//ajouter ds la bdd les ingredients 
foreach ($ingredients as $i => $nom) {

    $quantite = $quantiteIngredients[$i];
    $unite    = $uniteIngredients[$i];

    // récupérer ou créer ingredient
    $ingredient = new ingredient();
    $exist = $ingredient->findBy("nom", $nom);

    if (!$exist) {
        $ingredient->set("nom", $nom);
        $ingredient->set("type", "autre");
    
        $ingredient->insert();
    }

    $ingredientId = $ingredient->id();

//ajouter ds la bdd ingredient recette
    $recetteIng = new recette_ingredient();
    $recetteIng->set("recette_id", $recette->id());
    $recetteIng->set("ingredient_id", $ingredientId);
    $recetteIng->set("quantite", $quantite);
    $recetteIng->set("unite", $unite);

    $recetteIng->insert();
}






echo "SUCCESS";

