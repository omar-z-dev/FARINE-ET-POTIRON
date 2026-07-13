<?php

// Récupération des paramètres pour differencier entre login ou register
$action = $_GET["action"] ?? "";

// Gestion des actions des deux cas : 
switch ($action){

// cas authentification de l'utilisateur
    case "login":

        //instancier un utilisateur
        $user = new utilisateur();
        //assigner les parametre de l'utilisateur
        $identifiant = $_POST["identifiant"] ?? "";
        $password    = $_POST["password"]    ?? "";


        //verifier si l'utilisateur existe ds la BDD
        $verifuser = $user->login($identifiant, $password);

        if ($verifuser){
            
            //creer la session pour stocker les info de l'utilisateur dans $_SESSION
            //var_dump($user);  exit;
            connection($user);

            //rediriger vers dashboard
            header("Location:index.php?page=dashboard"); 
            exit;
        }
            //message d'erreur a afficher sur la page d'accueil
            $_SESSION["error_login"] = "😱 Email ou mot de passe incorrect";
            require "index.php";
            break;

    // cas creation du compte

    case "register":

        //recaptchat 
        
        //clé secrète ($secret) est le moyen pour ton serveur de s'authentifier auprès de Google.
        $secret = "6LeudFAtAAAAAJ8-gVHyYLV1mBTrUrDyBZragxa4";

        //Le navigateur envoie au serveur un jeton (g-recaptcha-response). Ce jeton prouve que Google a vu l'utilisateur interagir avec le reCAPTCHA.
        $response = $_POST["g-recaptcha-response"];

        $url = "https://www.google.com/recaptcha/api/siteverify";

        // le serveur envoie ce jeton à Google
        $data = [
            "secret" => $secret,
            "response" => $response
        ];

        //Préparer la requête HTTP
        $options = [
            "http" => [
                "method"  => "POST",
                "header"  => "Content-type: application/x-www-form-urlencoded",
                "content" => http_build_query($data) // transforme un tableau en une chaîne de caractères
            ]
        ];

        //"Prépare une requête POST avec ces données
        $context = stream_context_create($options);

        //Envoyer la requête
        $result = file_get_contents($url, false, $context);

        /*Google vérifie plusieurs éléments :
        l'utilisateur a-t-il bien cliqué ?
        le jeton est-il valide ?
        le jeton n'a-t-il pas expiré ?
        le jeton provient-il bien de ton site ?
        le comportement ressemble-t-il à celui d'un humain ou d'un robot ?
        Google répond avec un JSON.*/

        $result = json_decode($result);

        if (!$result->success) {
        $_SESSION["error_recaptcha"] = "Veuillez valider le reCAPTCHA.";
        header("Location:index.php");
        exit;
        }


        $user = new utilisateur();

        $pseudo   = trim($_POST["pseudo"]   ?? "");
        $email    = trim($_POST["email"]    ?? "");
        $password = trim($_POST["password"] ?? "");

        // verifier si tous les champs sont remplis
        if (empty($pseudo) || empty($email) || empty($password)) {
            $_SESSION["error_register"] = "Tous les champs sont obligatoires ❌";
            header("Location: index.php");
            exit;
        }

        //verifier si email valide 

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $_SESSION["error_register"] = "Email invalide ❌";

            header("Location: index.php");
            exit;
        }

        //verifier pseudo valide avec regex
        if (!preg_match("/^[a-zA-ZÀ-ÿ -]{2,50}$/", $pseudo)) {

            $_SESSION["error_register"] = "pseudo invalide ❌";

            header("Location: index.php");
            exit;
        }

        //verifier si email est unique

        if ($user->findBy("email", $email)) {

            $_SESSION["error_register"] = "Cet email existe déjà ❌";

            header("Location: accueil.php");
            exit;
        }

        //assigner les parametre de l'utilisateur
        $user->set("pseudo", $pseudo);
        $user->set("email", $email);
        $user->set("mdp", $password);
        $user->set("date_creation", date("Y-m-d H:i:s"));

        $userRegister = $user->register();

        if ($userRegister){

            //message de confirmation de creation de compte
            $_SESSION["success_register"] = "✅ Compte créé avec succes";
            header("Location: index.php");
            exit;
        }
            //message d'erreur création compte
            $_SESSION["error_register"] = "😱 Erreur création compte";
            require "index.php";
            break;
    default:
    require "index.php";
}








