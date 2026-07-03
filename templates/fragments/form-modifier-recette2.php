<div class="container-modif-recette">

    <span id="fermer-profil" onclick="fermerModifRecette()">
        ✖
    </span>

    <h2>
        Modifier la recette :
        <span style="color:#7c400e">
            <?= $recette->html("titre") ?>
        </span>
    </h2>

    <form id="form-modif-recette">

        <input type="hidden" name="id" value="<?= $recette->id() ?>">

        <h3>Informations générales</h3>

        <label>Titre</label><br>
        <input
            type="text"
            name="titre"
            value="<?= $recette->html("titre") ?>"
        ><br><br>

        <label>Description</label><br>

        <textarea
            name="description"
            rows="8"><?= $recette->html("description") ?></textarea><br><br>

        <label>Durée (minutes)</label><br>

        <input type="number" name="duree" value="<?= $recette->html("duree") ?>"
        ><br><br>

        <label>Difficulté</label><br>

        <select name="difficulte">
            <option
                value="très facile"
                <?= $recette->get("difficulte")=="très facile" ? "selected" : "" ?>>Très facile
            </option>

            <option
                value="facile"
                <?= $recette->get("difficulte")=="facile" ? "selected" : "" ?>>Facile
            </option>

            <option
                value="difficile"
                <?= $recette->get("difficulte")=="difficile" ? "selected" : "" ?>>Difficile
            </option>

        </select>

        <hr>

        <h3>Farines</h3>

        <div id="liste-farines">

            <?php foreach($listeFarines as $farine): ?>

            <!-- liste des farines -->
            <div class="ligne-farine"> 
                <select
                    name="farines[]"
                    class="select-farine"
                    data-selected="<?= $farine["nom"] ?>">
                    <option value=""></option>
                </select>

                <input
                    type="number"
                    name="quantite_farines[]"
                    value="<?= $farine["quantite"] ?>">

                <select name="unite_farines[]">

                    <option  value="g" <?= $farine["unite"]=="g" ? "selected" : "" ?>>g
                    </option>

                    <option value="kg" <?= $farine["unite"]=="kg" ? "selected" : "" ?>>kg
                    </option>

                </select>

                <button type="button"  onclick="supprimerLigne(this)">
                    ✖
                </button>

            </div>

            <?php endforeach; ?>

        </div>

        <button type="button"  onclick="ajouterFarine()">+ Ajouter une farine
        </button>

        <hr>

        <h3>Autres ingrédients</h3>

        <!-- liste des ingrédients -->
        <div id="liste-ingredients">

            <?php foreach($listeIngredients as $ingredient): ?>

            <div class="ligne-ingredient">

                <input type="text" name="ingredients[]"
                    value="<?= $ingredient["nom"] ?>">

                <input type="number" name="quantite_ingredients[]"
                    value="<?= $ingredient["quantite"] ?>">

                <input type="text" name="unite_ingredients[]"
                    value="<?= $ingredient["unite"] ?>">

                <button type="button" onclick="supprimerLigne(this)">
                    ✖
                </button>

            </div>

            <?php endforeach; ?>

        </div>

        <button type="button" onclick="ajouterIngredient()">
            + Ajouter un ingrédient
        </button>

        <hr>

        <button type="button" onclick="validerModificationRecette()">
            ✔ Valider les modifications
        </button>

    </form>

    <div id="msg-modif"></div>

</div>