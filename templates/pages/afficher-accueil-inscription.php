
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
        /* Style global */
        body {
            display: flex;
            flex-direction: row;
            gap: 10rem;
            padding: 2rem;
            font-family: Arial, sans-serif;
            background: #e7dcdc;
        }
        </style>
    </head>
    <body>
        <div>
            <h1> Farine et potiron</h1>

            <!-- creer compte -->
            <h2>Connexion / Inscription</h2>

            <!--------------- user et mdp test ----------------------->
            <h3 style = "color: yellowgreen;">mot de passe test et email test</h3>
            <h3>EMAIL omar : r@gmail.com  MDP : 1234</h6>
            <h3>EMAIL doe : gr@gmail.com  MDP : 123</h6>
            <h3>EMAIL alex : grr@gmail.com  MDP : 12</h6>
            <h3>EMAIL jack : rty@gmail.com  MDP : 1</h6>

            <!-- message d'erreur email ou mdp incorrect  -->
            <?php if (!empty($_SESSION["error_login"])): ?>
                <p style="color:red; font-weight:bold;"><?= $_SESSION["error_login"] ?></p>
                <?php unset($_SESSION["error_login"]); ?>
            <?php endif; ?>

            <!-- login : connexion -->
            <form method="POST" action="index.php?page=login-register&action=login">
                <h3>Connexion</h3>
                <input type="text" name="identifiant" placeholder="Email ou pseudo"><br><br>
                <input type="password" name="password" placeholder="Mot de passe"><br><br>
                <button>Se connecter</button>
            </form><br><br>


            <!-- register : creation de compte-->
            <form method="POST" action="index.php?page=login-register&action=register" novalidate>
                <h3>Créer un compte</h3>

                <!-- message d'erreur creation de compte  -->

                <?php if (!empty($_SESSION["error_register"])): ?>
                    <p style="color:red; font-weight:bold;"><?= $_SESSION["error_register"] ?></p>
                    <?php unset($_SESSION["error_register"]); ?>
                <?php endif; ?>

                <!-- message succes de creation de compte  -->
                 
                <?php if (!empty($_SESSION["success_register"])): ?>
                    <p style="color:green; font-weight:bold;"><?= $_SESSION["success_register"] ?></p>
                    <?php unset($_SESSION["success_register"]); ?>
                <?php endif; ?>

                <!-- message errerir recaptcha  -->
                 
                <?php if (!empty($_SESSION["error_recaptcha"])): ?>
                    <p style="color:red; font-weight:bold;"><?= $_SESSION["error_recaptcha"] ?></p>
                    <?php unset($_SESSION["error_recaptcha"]); ?>
                <?php endif; ?>


                <input type="text" name="pseudo" placeholder="Votre pseudo" ><br><br>
                <input type="email" name="email" placeholder="Email" ><br><br>
                <input type="password" name="password" placeholder="Mot de passe" ><br><br>

                <!-- recaptcha -->

                <div 
                    class="g-recaptcha" data-sitekey="6LeudFAtAAAAAPQUtTevQqrRFn5eU8tPc6XHy1LC">
                </div>


                <br>



                <button>S'inscrire</button>

            </form>
        </div>

        <!-- rechercher recette formulaire -->
        <div>
            <h2>🔍 Rechercher une recette</h2>

            <form method="GET" action="recherche-recettes.php">

                <!-- titre -->
                <label for="titre">Nom de la recette :</label><br>
                <input type="text" name="titre" id="titre" placeholder="Ex : Crêpes"><br><br>

                <!-- difficulté -->
                <label for="difficulte">Difficulté :</label><br>
                <select name="difficulte" id="difficulte">
                    <option value="">-- Toutes --</option>
                    <option value="très facile">Très facile</option>
                    <option value="facile">Facile</option>
                    <option value="difficile">Difficile</option>
                </select><br><br>

                <!-- durée -->
                <label for="duree_max">Durée maximale (minutes) :</label><br>
                <input type="number" name="duree_max" id="duree_max" min="0"><br><br>

                <!-- farine -->
                <label for="farine">Type de farine :</label><br>
                <select name="farine" id="farine">
                    <option value="">-- Toutes les farines --</option>

                    <!-- remplir dynamiquement depuis la BDD -->
                    <option value="blé">Farine de blé</option>
                    <option value="seigle">Farine de seigle</option>
                    <option value="maïs">Farine de maïs</option>

                </select><br><br>

                <button type="submit">
                    Rechercher
                </button>

            </form>
        </div>

        <!--liste des recettes  -->
        <div>
            <h1> Liste des recettes</h1>
            <ul>
                <?php foreach($allRecettes as $recette): ?>
                    <li>
                        <a href="afficher-recette.php?id=<?= $recette->id() ?>"><?= $recette->html("titre") ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
       
    </body>
</html>
