<?php
//controleur : valider une note
//param : recette_id, type


//recupere les parametres
$recetteId = $_POST["recette_id"];
$type      = $_POST["type"];
$userId    = userConnected()->id();



//verifier si pas de note deja sur la recette

$userId = userConnected()->id();

$ancienNote = new note();

$ancienNote = $ancienNote->findByRecetteUtilisateur($recetteId, $userId);


if ($ancienNote) {
    $_SESSION["error_note"] = "Vous avez deja noté cette recette ❌";
        header("Location:index.php?page=dashboard");
        exit;
}




//instancier une note
$note = new note();

//assigner les nouvelles valeurs
$note->set("recette_id", $recetteId);
$note->set("utilisateur_id", $userId);
$note->set("type", $type);
$note->set("date_maj", date("Y-m-d H:i:s"));

$note->insert();