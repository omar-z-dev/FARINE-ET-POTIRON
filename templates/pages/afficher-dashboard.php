
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
          
        <div class ="container-principal">  
        
            <h2>Bienvenue sur votre dashboard <?= $user->html("pseudo") ?> 👋</h2>                
              
            <div>
                <!-- liste de mes recettes -->
                <h2> liste de mes recettes </h2>

                <table border="1" cellpadding="8">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Durée</th>
                            <th>Difficulté</th>
                            <th>Date de mise à jour</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (empty($mesRecettes)): ?>

                            <tr>
                                <td colspan="5">
                                    Vous n'avez encore créé aucune recette.
                                </td>
                            </tr>

                        <?php else: ?>

                            <?php foreach ($mesRecettes as $recette): ?>

                                <tr>
                                    <td><?= $recette->html("titre") ?></td>

                                    <td><?= $recette->html("description") ?></td>

                                    <td><?= $recette->html("duree") ?> min</td>

                                    <td><?= $recette->html("difficulte") ?></td>

                                    <td><?= $recette->html("date_maj") ?></td>

                                    <td>
                                        <a href="voir-recette.php?id=<?= $recette->id() ?>">
                                        Voir
                                        </a>

                                        |

                                        <a href="modifier-recette.php?id=<?= $recette->id() ?>">
                                        Modifier
                                        </a>
                                    </td>
                                </tr>

                            <?php endforeach; ?>

                        <?php endif; ?>

                         <!-- bouton ajouter une recette : -->
                                <tr>
                                    <td colspan="7" style="text-align:center;">
                                        <button type="button" onclick="afficherFormAjout()">
                                            Ajouter une recette ➕
                                        </button>
                                    </td>
                                </tr>
                    </tbody>
                </table>


                <!-- formulaire ajouter une recette -->
                <div id="zone-ajout-recette"></div>

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

                <!--bouton de deconnexion : -->
                <div>
                    <a href="logout.php">
                        <button id="disconnect" style ="font-weight:800;padding: 10px; border-radius: 5px; cursor: pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M288 0c0-17.7-14.3-32-32-32S224-17.7 224 0l0 256c0 17.7 14.3 32 32 32s32-14.3 32-32L288 0zM146.3 98.4c14.5-10.1 18-30.1 7.9-44.6s-30.1-18-44.6-7.9C43.4 92.1 0 169 0 256 0 397.4 114.6 512 256 512S512 397.4 512 256c0-87-43.4-163.9-109.7-210.1-14.5-10.1-34.4-6.6-44.6 7.9s-6.6 34.4 7.9 44.6c49.8 34.8 82.3 92.4 82.3 157.6 0 106-86 192-192 192S64 362 64 256c0-65.2 32.5-122.9 82.3-157.6z"/></svg>
                        </button>
                    </a>
                </div>
            </div>
        </div> 


        <script src="js/fonctions.js"></script>


    </body>
</html>
