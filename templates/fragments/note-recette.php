
<!-- Note de la recette j aime ou j aime moins -->

<form method="POST" action="index.php?page=valider-note">

    <input type="hidden" name="recette_id" value="<?= $recette->id() ?>">
    <input type="hidden" name="type" value="like">

    <button type="submit">
        👍 J'aime
    </button>

</form>


<form method="POST" action="index.php?page=valider-note">

    <input type="hidden" name="recette_id" value="<?= $recette->id() ?>">
    <input type="hidden" name="type" value="dislike">

    <button type="submit">
        👎 J'aime moins
    </button>
    
</form>
