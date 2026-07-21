<?php

//role : afficher une ligne supplementares de farine

?>

<div class="ligne-farine">

    <select name="farines[]">

        <option value="">-- Choisir une farine --</option>

        <?php foreach ($catalogueFarines as $reference => $nom): ?>

            <option value="<?=  $nom ?>">
                <?= $nom ?>
            </option>

        <?php endforeach; ?>

    </select>

    <input
        type="number"
        name="quantite_farines[]"
        placeholder="Quantité"
    >

    <select name="unite_farines[]">
        <option>g</option>
        <option>kg</option>
    </select>

    <button type="button" onclick="supprimerLigne(this)">
        ❌
    </button>

</div>