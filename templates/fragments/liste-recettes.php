<!-- liste de mes recettes -->
<div id="liste-recettes">
    
    <h2> liste de mes recettes </h2>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>Titre      </th>
                <th>Description</th>
                <th>Durée      </th>
                <th>Difficulté </th>
                <th>Date de mise à jour</th>
                <th>Actions    </th>
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
                        <td><?= $recette->html("titre")?>      </td>
                        <td><?= $recette->html("description")?></td>
                        <td><?= $recette->html("duree")?> min  </td>
                        <td><?= $recette->html("difficulte")?> </td>
                        <td><?= $recette->html("date_maj")?>   </td>
                        <td>                         
                            <!-- bouton modifier une recette : -->
                            <button type="button" onclick="AfficherFormModifierRecette(<?= $recette->id() ?>)">
                            Modifier
                            </button>
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
</div>