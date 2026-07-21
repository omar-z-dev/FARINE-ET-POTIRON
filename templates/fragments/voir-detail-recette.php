<div class="container-modif-recette">

    <h2>
        Détail de la recette :
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

        <input
            type="text"
            value="<?= $recette->html("difficulte") ?>"
            readonly
        >
        <!----------------- liste des farines ---------------->

        <h3>Farines</h3>
        <div id="liste-farines">
            <?php foreach ($listeFarines as $farine): ?>
                <div class="ligne-farine">

                    <input
                        type="text"
                        name="farines[]"
                        value="<?= $farine["nom"] ?>"
                        readonly
                    >
                    <input
                        type="number"
                        name="quantite_farines[]"
                        value="<?= $farine["quantite"] ?>"
                        readonly
                    >
                    <input
                        type="text"
                        name="unite_farines[]"
                        value="<?= $farine["unite"] ?>"
                        readonly
                    >
                </div>
            <?php endforeach; ?>
        </div>
        <h3>Autres ingrédients</h3>

        <!-- liste des ingrédients -->

        <div id="liste-ingredients">
            <?php foreach($recetteAllIngredients as $ingredient): ?>

                <div class="ligne-ingredient">

                    <!----- nom de ingredient -------> 
                    <input type="text" name="ingredients[]"
                        value="<?= $ingredient["nom"] ?>">
                    <!----- quantité ------->
                    <input type="number" name="quantite_ingredients[]"
                        value="<?= $ingredient["quantite"] ?>"readonly>
                        
                    <!----- unite ------->
                    <input type="text" name="unite_ingredients[]"
                        value="<?= $ingredient["unite"] ?>">
                </div>
            <?php endforeach; ?>
        </div>
    </form>
</div>

<hr>


<!----- NOTES -------> 

<h3 style ="color:green">Listes des Notes</h3>

<?php if (empty($listeNotes)): ?>

    <p>Aucune note pour cette recette.</p>

<?php else: ?>

    <?php foreach ($listeNotes as $note): ?>

        <div class="ligne-note">

            <strong><?= $note->html("pseudo") ?></strong>
            :
            <?= $note->html("type") ?>
        </div>

    <?php endforeach; ?>

<?php endif; ?>

<hr>

<!----- COMMENTAIRES -------> 

<h3 style ="color:green">Listes des Commentaires</h3>

<?php if (empty($listeCommentaires)): ?>

    <p>Aucun commentaire.</p>

<?php else: ?>

    <?php foreach ($listeCommentaires as $commentaire): ?>

        <div class="ligne-commentaire">

            <strong><?= $commentaire->html("pseudo")?></strong>
            <br>

            <?= $commentaire->html("commentaire") ?>

            <br>

            
            <?= $commentaire->get("date_maj") ?>
        

        </div>

    <?php endforeach; ?>

<?php endif; ?>