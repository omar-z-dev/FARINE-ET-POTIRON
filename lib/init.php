<?php

// Lignes de code pour l'initialisation des contrôleurs
//heure paris 
date_default_timezone_set('Europe/Paris');

// gestion des erreurs
ini_set('display_errors',1);
error_reporting(E_ALL);

// Ouvrir la BDD (dans la variable globale $bdd)
global $bdd;        // déclarer la varianle $bdd comme globale
$bdd = new PDO("mysql:host=172.18.0.1;dbname=fep-omar;charset=UTF8", "fep-omar", "T?59jpyytk");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING) ;  // En mise au point seulement


// Inclure les classes et les fonctions
require_once __DIR__ . "/../modele/utilisateur.php";
require_once __DIR__ . "/../lib/session.php";

require_once __DIR__ . "/../modele/note.php";
require_once __DIR__ . "/../modele/commentaire.php";
require_once __DIR__ . "/../modele/recette.php";
require_once __DIR__ . "/../modele/ingredient.php";
require_once __DIR__ . "/../modele/recette_ingredient.php";


// Initialisation de la session en chargeant la fonction (presente ds session.php) qui inclut session_start

// crée / lit un fichier de session côté serveur
// associé à un ID de session (cookie PHPSESSID)
sessionInit();

