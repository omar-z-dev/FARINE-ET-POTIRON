<?php

//recuperer les parametres

$recetteId       = $_POST["recette_id"];
$commentaireText = $_POST["commentaire"];

//instancier une commentaire
$commentaire = new commentaire();

//assigner les valeur
$commentaire->set("recette_id", $recetteId);
$commentaire->set("commentaire", $commentaireText);
$commentaire->set("utilisateur_id", userConnected()->id());
$commentaire->set("date_maj", date("Y-m-d H:i:s"));

//inserer la recette dans la BDD
$commentaire->insert();