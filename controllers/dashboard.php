<?php
// message de deconnection de l'utilisateur

//recuperer l'utilisateur connecté

$user = userConnected();

//instancier une recette
$recette = new recette();

//recuperer mes recettes
$mesRecettes = $recette->mesRecettes($user->id());

//recup les commetaire de lutilisateur connecté

$commentaire = new commentaire();

$mesCommentaires = $commentaire->getCommentairesUtilisateur(
    userConnected()->id()
);

//recup les notes de lutilisateur connecté
$note = new note();

$mesNotes = $note->getNotesUtilisateur(
    userConnected()->id()
);

// Afficher le template  
require "templates/pages/afficher-dashboard.php";