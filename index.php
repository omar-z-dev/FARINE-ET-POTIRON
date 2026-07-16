<?php
require_once "lib/init.php";

$page = $_GET["page"] ?? "accueil";

switch ($page) {

    case "dashboard":
        require "controllers/dashboard.php";
        break;

    //cas de l'affichage du formulaire de connexion et d'inscription    
    case "login-register":
        require "controllers/login-register.php";
        break;

    case "logout":
        require "controllers/logout.php";
        break;

    case "creer-recette-ajax":
        require "templates/fragments/creer-recette2.php";
        break;
        
    // cas de validation de la creation d'une recette
    case "valider-creation-recette-ajax":
        require "controllers/valider-creation-recette-ajax.php";
        break;

    case "liste-recettes-ajax":
        require "controllers/liste-recettes-ajax.php";
        break;
        
    // cas afficher form  modification d'une recette
    case "modifier-recette-ajax2":
        require "controllers/modifier-recette-ajax2.php";
        break;

    
    // cas de validation de la modification d'une recette
    case "valider-modif-recette-ajax":
        require "controllers/valider-modif-recette-ajax.php";
        break;

    case "recherche-recette-ajax":
        require "controllers/recherche-recette-ajax.php";
        break;
    //commentaire
    case "commentaire":
        require "controllers/creer-commentaire.php";
        break;

    case "valider-commentaire-ajax":
        require "controllers/valider-commentaire-ajax.php";
        break;
    
    case "creer_commentaire":
        require "controllers/creer-commentaire.php";
        break;

    //note
    case "valider-note":
        require "controllers/valider-note.php";
        break;

    //curl
    case "catalogue-farine":
        require "controllers/catalogue-farine.php";
        break;


    // par defaut : accueil
    default:
        require "controllers/accueil.php";
}























/*require_once "lib/init.php";

$page = $_GET["page"] ?? "accueil";

switch ($page) {

    case "dashboard":
        require_once "controllers/DashboardController.php";
        $controller = new DashboardController();
        $controller->index();
        break;

    case "login":
        require_once "controllers/AuthController.php";
        $controller = new AuthController();
        $controller->login();
        break;

    case "register":
        require_once "controllers/AuthController.php";
        $controller = new AuthController();
        $controller->register();
        break;

    case "logout":
        require_once "controllers/AuthController.php";
        $controller = new AuthController();
        $controller->logout();
        break;

    default:
        require_once "controllers/AccueilController.php";
        $controller = new AccueilController();
        $controller->index();
}*/