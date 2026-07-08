<?php

// recuperer les données du formulaire
$utilisateur_id = $_SESSION["id"];

 //recette base
$idRecette   = $_POST["id"];
$titre       = $_POST["titre"];
$description = $_POST["description"];
$duree       = $_POST["duree"];
$difficulte  = $_POST["difficulte"];
$date_maj    = date("Y-m-d H:i:s");


echo "<pre>"; echo "///----post : ";
print_r($_POST);
echo "</pre>";


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


//instancier une recette
$recette = new recette();

//charger la recette à modifier
$recette->load($idRecette);

$recette->set("utilisateur_id", $utilisateur_id);
$recette->set("titre"         , $titre);
$recette->set("description"   , $description);
$recette->set("duree"         , $duree);
$recette->set("difficulte"    , $difficulte);
$recette->set("date_maj"      , $date_maj);

//ajouter la recette
$recette->update();

//envoyer un message de confirmation ( sera recup en java pour affichage du messge succes insertion et suppression du formulaire d'ajout de recette)


//ajouter les farines
foreach ($farines as $i => $nom) {

    $quantite = $quantiteFarines[$i];
    $unite    = $uniteFarines[$i];

    
    $farine = new ingredient();
    $exist = $farine->findBy("nom", $nom);
    // verifier si la farine existe deja ds la bdd ingredient
    if (!$exist) {
        $farine->set("nom", $nom);
        $farine->set("type", "farine");
        $farine->set("created_at", date("Y-m-d H:i:s"));
    
        $farine->update();
    }

    $farineId = $farine->id();


    //ajouter ds la bdd ingredient_recette
    $recetteFarine = new recette_ingredient();
    $recetteFarine->set("recette_id"     , $recette->id());
    $recetteFarine->set("ingredient_id"  , $farineId);
    $recetteFarine->set("quantite"       , $quantite);
    $recetteFarine->set("nom_ingredient" , $nom);
    $recetteFarine->set("unite"          , $unite);

    $recetteFarine->update();
}



//ajouter ds la bdd les ingredients 
foreach ($ingredients as $i => $nom) {

    $quantite = $quantiteIngredients[$i];
    $unite    = $uniteIngredients[$i];

    // verifier si l'ingredient existe deja ds la bdd ingredient
    $ingredient = new ingredient();
    $exist = $ingredient->findBy("nom", $nom);

    if (!$exist) {
        $ingredient->set("nom", $nom);
        $ingredient->set("type", "autre");
        $ingredient->set("created_at", date("Y-m-d H:i:s"));
    
        $ingredient->update();
    }

    $ingredientId = $ingredient->id();

//ajouter ds la bdd ingredient recette
    $recetteIng = new recette_ingredient();
    $recetteIng->set("recette_id"    , $recette->id());
    $recetteIng->set("ingredient_id" , $ingredientId);
    $recetteIng->set("quantite"      , $quantite);
    $recetteIng->set("nom_ingredient", $nom);
    $recetteIng->set("unite"         , $unite);

    $recetteIng->update();
}


echo "SUCCESS";

