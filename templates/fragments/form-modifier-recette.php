
<!-- Formulaire de modification d'une recette -->

<div class="container-modif-recette">
    <span id="fermer-profil" onclick="fermerProfil()">
        ✖
    </span>

    <h2>Modifier la recette : <span style="color: #7c400e;"><?= $recette->html("titre") ?></span></h2>

    <form id="form-modif-recette">

        <input type="hidden" name="id" value="<?= $recette->id() ?>">

        <input type="text" name="titre" value="<?= $recette->html("titre") ?>"><br><br>

        <textarea name="description"><?= $recette->html("description") ?></textarea><br><br>

        <input type="number" name="duree" value="<?= $recette->html("duree") ?>"><br><br>

        <select name="difficulte">
            <option value="très facile" <?= $recette->get("difficulte")=="très facile"?"selected":"" ?>>
                Très facile
            </option>
            <option value="facile" <?= $recette->get("difficulte")=="facile"?"selected":"" ?>>
                Facile
            </option>
            <option value="difficile" <?= $recette->get("difficulte")=="difficile"?"selected":"" ?>>
                Difficile
            </option>
        </select><br><br>


        <button type="button" onclick="validerModificationRecette()">
            Valider modification
        </button>

    </form>

    <div id="msg-modif"></div>

</div>