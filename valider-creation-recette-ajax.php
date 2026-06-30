<?php

require_once "lib/init.php";

$utilisateur_id = $_SESSION["id"];
$titre          = $_POST["titre"];
$description    = $_POST["description"];
$duree          = $_POST["duree"];
$difficulte     = $_POST["difficulte"];
$date_maj       = date("Y-m-d H:i:s");



// Vérifier qu'aucun champ n'est vide
if (empty($titre) || empty($description) || empty($duree) || empty($difficulte)) {
    echo "<p style='color:red; font-weight:bold'>
            ❌ Veuillez remplir tous les champs.
          </p>";
    exit;
}

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
//envoyer un message de confirmation (  sera recup en java pour affichage du messge succes insertion et suppression du formulaire d'ajout de recette)
echo "SUCCESS";

