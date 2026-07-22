<?php

//recuperer les parametres

$recetteId       = $_POST["recette_id"];
$commentaireText = trim($_POST["commentaire"]);



//verifier si pas de commentaire deja sur la recette

$userId = userConnected()->id();

$ancienCommentaire = new commentaire();

$ancienCommentaire = $ancienCommentaire->findByRecetteUtilisateur($recetteId, $userId);


if ($ancienCommentaire) {
    $_SESSION["error_commentaire"] = "Vous avez deja commenté cette recette ❌";
        header("Location:index.php?page=creer_commentaire&id=" . $recetteId);
        exit;
}


//verifier le com n 'est pas vide 
if (empty($commentaireText)) {
    $_SESSION["error_commentaire"] = "Le commentaire ne peut pas être vide ❌";
    header("Location:index.php?page=creer_commentaire&id=" . $recetteId);
    exit;
}

//ajouter le commentaire
//instancier une commentaire
$commentaire = new commentaire();

//assigner les valeur
$commentaire->set("recette_id", $recetteId);
$commentaire->set("commentaire", $commentaireText);
$commentaire->set("utilisateur_id", userConnected()->id());
$commentaire->set("date_maj", date("Y-m-d H:i:s"));

//inserer la recette dans la BDD
$commentaire->insert();

// Message de succès
$_SESSION["success_commentaire"] = "✅ Votre commentaire a été ajouté avec succès.";

// Redirection
header("Location:index.php?page=creer_commentaire&id=" . $recetteId);
exit;