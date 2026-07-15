<div class="commentaire-recette">

    <form method="POST" action="index.php?page=valider-commentaire-ajax">

    <h2>Saisir un commentaire</h2>

    <!-- message erreur deja commenté-->
    <?php if (!empty($_SESSION["error_commentaire"])): ?>
        <p style="color:red; font-weight:bold;"><?= $_SESSION["error_commentaire"] ?></p>
        <?php unset($_SESSION["error_commentaire"]); ?>
    <?php endif; ?>

        <!-- ID de la recette -->
        <input
            type="hidden"
            name="recette_id"
            value="<?= $recette->id() ?>">

        <textarea
            name="commentaire"
            rows="3"
            cols="35"
            placeholder="Écrivez votre commentaire...">
        </textarea>

        <br><br>

        <button type="submit">Valider</button>

    </form>

</div>