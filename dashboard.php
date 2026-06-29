<?php
// ---------------------------
// Initialisations diverses
require_once "lib/init.php";

// message de deconnection de l'utilisateur

//recuperer l'utilisateur connecté
$user = userConnected();

//instancier un message
$message= new message();

//recuperer le tableau d objets des conversations (tous les messages ou l'utilisateur connecté est impliqué) 
$resultMessage = $message->getConversation($user->id());


//recup ts les utilisateur 
$utilisateur = new utilisateur();
$allUsers = $utilisateur->listAll();
//debug
/*echo "<pre>";
print_r($resultMessage);
echo "</pre>";*/

//debug
/*echo "<pre>"; echo "conversations : ";
print_r($conversations);
echo "</pre>";*/


// Afficher le template  
require "templates/pages/afficher-dashboard.php";