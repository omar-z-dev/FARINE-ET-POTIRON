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

//*********ajouter la recette
$recette->update();

//envoyer un message de confirmation ( sera recup en java pour affichage du messge succes insertion et suppression du formulaire d'ajout de recette)


//recuperer id des recettes_ingredients
$idsRecetteIngredient = $_POST["id_recette_ingredient"];

//recuperer id des ingredients
$idIng = $_POST["id_ingredient"];

/*echo "<pre>"; echo "///----idsRecetteIngredient : ";
print_r($idsRecetteIngredient);
echo "</pre>";

echo "<pre>"; echo "///----idIng : ";
print_r($idIng);
echo "</pre>";*/

//********ajouter les farines
foreach ($farines as $i => $nom) {

    $idRecetteIngredient = $idsRecetteIngredient[$i];
    $idIng               = $idIng[$i];
    $quantite            = $quantiteFarines[$i];
    $unite               = $uniteFarines[$i];

    
    $farine = new ingredient();
    
    //charger l'ingrédient à modifier
    $farine->load($idIng);

    /*echo "<pre>"; echo "///----farine : ";
    print_r($farine);
    echo "</pre>";*/

    // verifier si la farine existe deja ds la bdd ingredient
    $exist = $farine->findBy("nom", $nom);
    
    if (!$exist) {
        $farine->set("nom", $nom);
        $farine->set("type", "farine");
        $farine->set("created_at", date("Y-m-d H:i:s"));
    
        $farine->update();
    }

    $farineId = $farine->id();


    //ajouter ds la bdd ingredient_recette
    $recetteFarine = new recette_ingredient();

    $recetteFarine->load($idRecetteIngredient);

    $recetteFarine->set("recette_id"     , $recette->id());
    $recetteFarine->set("ingredient_id"  , $farineId);
    $recetteFarine->set("quantite"       , $quantite);
    $recetteFarine->set("nom_ingredient" , $nom);
    $recetteFarine->set("unite"          , $unite);

    $recetteFarine->update();
}



//********ajouter ds la bdd les ingredients 

$Iding2= $_POST["id_ing"];

echo "<pre>"; echo "///----idIng  lui mmm : ";
print_r($Iding2);
echo "</pre>";

foreach ($ingredients as $i => $nom) {

    $Iding2    = $_POST["id_ing"][$i];

    $quantite = $quantiteIngredients[$i];
    $unite    = $uniteIngredients[$i];

    // verifier si l'ingredient existe deja ds la bdd ingredient
    $ingredient2 = new ingredient();
    
    //charger l'ingrédient à modifier
    $ingredient2->load($Iding2);

    echo "<pre>"; echo "///----ingredient OBJETTTTT lui meme : ";
    print_r($ingredient2);
    echo "</pre>";

    $exist = $ingredient2->findBy("nom", $nom);

    if (!$exist) {
        $ingredient2->set("nom", $nom);
        $ingredient2->set("type", "autre");
        $ingredient2->set("created_at", date("Y-m-d H:i:s"));
    
        $ingredient2->update();

        $ingredient2->load($ingredient2->id());

        echo "<pre>"; echo "///----vhager : ";
        print_r($ingredient2);
        echo "</pre>";

    
    }





    $ingredientId = $ingredient2->id();

    //modifier ds la bdd ingredient recette
    $recetteIng = new recette_ingredient();

    $recetteIng->load($idsRecetteIngredient[$i]);

    $recetteIng->set("recette_id"    , $recette->id());
    $recetteIng->set("ingredient_id" , $ingredientId);
    $recetteIng->set("quantite"      , $quantite);
    $recetteIng->set("nom_ingredient", $nom);
    $recetteIng->set("unite"         , $unite);

    $recetteIng->update();

    $recetteIng->load($recetteIng->id());

    echo "<pre>"; echo "///----recette ingredient moif : ";
    print_r($recetteIng);
    echo "</pre>";
    
}


echo "SUCCESS";

