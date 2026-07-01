<?php

require_once "lib/init.php";

$id          = $_POST["id"];
$titre       = $_POST["titre"];
$description = $_POST["description"];
$duree       = $_POST["duree"];
$difficulte  = $_POST["difficulte"];

if (empty($titre) || empty($description) || empty($duree) || empty($difficulte) ) {
    echo "<p style='color:red; font-weight:bold'>
            ❌ Veuillez remplir tous les champs.
          </p>";
    exit;
}

$recette = new recette();
//charger la recette à modifier
$recette->load($id);

//mettre à jour les champs de la recette
$recette->set("titre", $titre);
$recette->set("description", $description);
$recette->set("duree", $duree);
$recette->set("difficulte", $difficulte);

//mettre à jour la recette dans la base de données
$recette->update();

echo "SUCCESS";