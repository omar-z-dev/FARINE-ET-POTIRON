<h2>Ajouter une recette</h2>



<!-- formulaire d ajout d une recette -->

<form id="form-recette">

    <input type="text" name="titre" placeholder="Titre"><br><br>

    <textarea name="description" placeholder="Description"></textarea><br><br>

    <input type="number" name="duree" placeholder="Durée (min)"><br><br>

    <select name="difficulte">
        <option value="très facile">Très facile</option>
        <option value="facile">Facile</option>
        <option value="difficile">Difficile</option>
    </select><br><br>

    <button type="button" onclick="validerRecette()">
        Valider
    </button>

</form>

<div id="msg-ajout-recette"></div>