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

/*echo "<pre>"; echo "///----post : ";
print_r($_POST);
echo "</pre>";*/

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

//*********  Modifier la recette
$recette->update();

//envoyer un message de confirmation ( sera recup en java pour affichage du messge succes insertion et suppression du formulaire d'ajout de recette)

/*echo "<pre>"; echo "///----idsRecetteIngredient : ";
print_r($idsRecetteIngredient);
echo "</pre>";

echo "<pre>"; echo "///----idIng : ";
print_r($idIng);
echo "</pre>";*/

//*!======== Modifier ds la bdd les farines =======*//
//*!=================================================*/

//farines
// recu en un tableau associatif

//recuperer id des ingredients
$idIngs               = $_POST["id_ingredient"];

$farines              = $_POST["farines"]; //recup tableau des nom de farines

$quantiteFarines      = $_POST["quantite_farines"];
$uniteFarines         = $_POST["unite_farines"];   

foreach ($farines as $i => $nom) {
    $quantite            = $quantiteFarines[$i];
    $unite               = $uniteFarines[$i];

    $idIng = $idIngs[$i] ?? 0;

    $farine = new ingredient();

    if (!empty($idIng)) {

        // Farine existante
        $farine->load($idIng);

        $farine->set("nom", $nom);
        $farine->set("type", "farine");
        $farine->set("created_at", date("Y-m-d H:i:s"));

        $farine->update();

    } else {

        // Nouvelle farine
        $farine->set("nom", $nom);
        $farine->set("type", "farine");
        $farine->set("created_at", date("Y-m-d H:i:s"));

        $farine->insert();

        $idIngNew = $farine->id();
    }

    //*****Modifier dans ingredient_recette

    $recetteFarine = new recette_ingredient();

    if (!empty($idRecetteIngredient)) {

        // Farine existante
        $recetteFarine->load($idRecetteIngredient);
    } 

    $recetteFarine->set("recette_id", $recette->id());
    $recetteFarine->set("ingredient_id", $idIngNew);
    $recetteFarine->set("quantite", $quantite);
    $recetteFarine->set("nom_ingredient", $nom);
    $recetteFarine->set("unite", $unite);

    if (!empty($idRecetteIngredient)) {
        // Farine existante ds la table recette_ingredient
        $recetteFarine->update();

    } else {
        // Nouvelle farine ds la table recette_ingredient
        $recetteFarine->insert();
    }
}

//*!======== Modifier ds la bdd les ingredients =======*//
//*!=================================================*/

// autres ingredients
// recu en un tableau associatif
$ingredients         = $_POST["ingredients"]; //nom ing
$quantiteIngredients = $_POST["quantite_ingredients"];
$uniteIngredients    = $_POST["unite_ingredients"];

$Iding2= $_POST["id_ing"];  //id ingredient

$idRecetteIng = $_POST["id_recette_ingredient_ing"]; //id ingredient_id

foreach ($ingredients as $i => $nom) {

    $Iding2s  = $Iding2[$i];
    $idRecetteIngredient = $idRecetteIng[$i];
    $quantite = $quantiteIngredients[$i];
    $unite    = $uniteIngredients[$i];

    // verifier si l'ingredient existe deja ds la bdd ingredient
    $ingredient2 = new ingredient();
    
    //charger l'ingrédient à modifier

    $ingredient2->load($Iding2s);

    // update
    //assigner les nouvelles valeurs
    $ingredient2->set("nom", $nom);
    $ingredient2->set("type", "autre");
    $ingredient2->set("created_at", date("Y-m-d H:i:s"));

    $ingredient2->update();

    //modifier ds la bdd ingredient recette
    $recetteIng = new recette_ingredient();

    $recetteIng->load($idRecetteIngredient);

    $recetteIng->set("recette_id"    , $recette->id());
    $recetteIng->set("ingredient_id" , $idRecetteIngredient);
    $recetteIng->set("quantite"      , $quantite);
    $recetteIng->set("nom_ingredient", $nom);
    $recetteIng->set("unite"         , $unite);

    $recetteIng->update();
}

echo "SUCCESS";

