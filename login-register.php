<?php

require_once "lib/init.php";

// Récupération des paramètres pour differencier entre login ou register
$action = $_GET["action"] ?? "";

// Gestion des actions des deux cas : 
switch ($action){

// cas authentification de l'utilisateur
    case "login":

        //instancier un utilisateur
        $user = new utilisateur();
        //assigner les parametre de l'utilisateur
        $email    = $_POST["email"] ?? "";
        $password = $_POST["password"] ?? "";

        $user->set("email", $email);
        $user->set("mdp", $password);

        //verifier si l'utilisateur existe ds la BDD
        $verifuser = $user->login(
            $user->value("email"),
            $user->value("mdp")
        );

        if ($verifuser){
            
            //creer la session pour stocker les info de l'utilisateur dans $_SESSION
            //var_dump($user);  exit;
            connection($user);

            //rediriger vers dashboard
            header("Location: dashbord.php"); 
            exit;
        }
            //message d'erreur a afficher sur la page d'accueil
            $_SESSION["error_login"] = "😱 Email ou mot de passe incorrect";
            require "accueil.php";
            break;

    // cas creation du compte

    case "register":

        $user = new utilisateur();

        $pseudo   = trim($_POST["pseudo"] ?? "");
        $email    = trim($_POST["email"] ?? "");
        $password = trim($_POST["password"] ?? "");

        // verifier si tous les champs sont remplis
        if (empty($pseudo) || empty($email) || empty($password)) {
            $_SESSION["error_register"] = "Tous les champs sont obligatoires ❌";
            header("Location: accueil.php");
            exit;
        }

        //verifier si email valide 

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $_SESSION["error_register"] = "Email invalide ❌";

            header("Location: accueil.php");
            exit;
        }

        //verifier pseudo valide avec regex
        if (!preg_match("/^[a-zA-ZÀ-ÿ -]{2,50}$/", $pseudo)) {

            $_SESSION["error_register"] = "pseudo invalide ❌";

            header("Location: accueil.php");
            exit;
        }

        //verifier si email est unique

        if ($user->findBy("email", $email)) {

            $_SESSION["error_register"] = "Cet email existe déjà ❌";

            header("Location: accueil.php");
            exit;
        }

        //assigner les parametre de l'utilisateur
        $user->set("nom", $pseudo);
        $user->set("email", $email);
        $user->set("mdp", $password);

        $userRegister = $user->register();

        if ($userRegister){

            //message de confirmation de creation de compte
            $_SESSION["success_register"] = "✅ Compte créé avec succes";
            header("Location: accueil.php");
            exit;
        }
            //message d'erreur création compte
            $_SESSION["error_register"] = "😱 Erreur création compte";
            require "accueil.php";
            break;
    default:
    require "accueil.php";
}
