
<div class="container-ajout-recette">

    <span id="fermer-profil" onclick="fermerAjoutRecette()">
        ✖
    </span>

    <h2>Ajouter une recette</h2>

    <form id="form-recette">

        <h3>Informations générales</h3>

        <label>Titre</label><br>
        <input type="text" name="titre" placeholder="Titre de la recette"><br><br>

        <label>Description détaillée</label><br>
        <textarea
            name="description"
            rows="8"
            placeholder="Décrivez ..."
        ></textarea><br><br>

        <label>Durée estimée (minutes)</label><br>
        <input type="number" name="duree" min="1"><br><br>

        <label>Difficulté</label><br>

        <select name="difficulte">
            <option value="très facile">Très facile</option>
            <option value="facile">Facile</option>
            <option value="difficile">Difficile</option>
        </select>

        <hr>

        <h3>Farines </h3>
        <!-- liste des farines -->
        <div id="liste-farines">

            <div class="ligne-farine">

                <select name="farines[]">

                    <option value="">
                        -- Choisir une farine --
                    </option>

                    <?php foreach($catalogueFarines as $reference => $nom): ?>

                        <option value="<?= $reference ?>">
                            <?= $nom ?>
                        </option>

                    <?php endforeach; ?>

                </select>
                
                <input type="number" name="quantite_farines[]"placeholder="Quantité">

                <select name="unite_farines[]">
                    <option>g</option>
                    <option>kg</option>
                </select>
            </div>

        </div>
        <!-- btn ajout d une farine -->
        <button class ="btn" type="button" onclick="ajouterFarine()">
            + Ajouter une farine
        </button>

        <hr>
        <!-- liste des ingrédients -->
        <h3>Autres ingrédients</h3>

        <div id="liste-ingredients">

            <div class="ligne-ingredient">

                <input type="text" name="ingredients[]"
                    placeholder="Nom de l'ingrédient">

                <input type="number" name="quantite_ingredients[]"
                    placeholder="Quantité">

                <input type="text" name="unite_ingredients[]"
                    placeholder="g, ml...">
            </div>
        </div>
        <!-- btn ajout d un ingrédient -->
        <button class ="btn" type="button" onclick="ajouterIngredient()">+ Ajouter un ingrédient
        </button>

        <hr>
        <!----- btn valider ----->
        <button class ="btn"
            type="button" onclick="validerRecette()">Publier la recette
        </button>

    </form>

    <div id="msg-ajout-recette"></div>

</div>
