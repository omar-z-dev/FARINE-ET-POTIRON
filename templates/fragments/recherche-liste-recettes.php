<?php
//liste recettes
?>

<!-- liste de mes recettes -->
<div id="recherche-liste-recette">
    
    <h2> liste de mes recettes </h2>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>Titre      </th>
                <th>Description</th>
                <th>Durée      </th>
                <th>Difficulté </th>
                <th>Date de mise à jour</th>
            </tr>
        </thead>

        <tbody>
                <?php foreach ($listeRecettes as $recette): ?>

                    <tr>
                        <td><?= $recette->html("titre")?>      </td>
                        <td><?= $recette->html("description")?></td>
                        <td><?= $recette->html("duree")?> min  </td>
                        <td><?= $recette->html("difficulte")?> </td>
                        <td><?= $recette->html("date_maj")?>   </td>
                    </tr>

                <?php endforeach; ?>
        </tbody>
    </table>
</div>