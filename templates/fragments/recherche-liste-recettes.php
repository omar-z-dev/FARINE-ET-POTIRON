<?php
//liste recettes
?>

<!-- liste de mes recettes -->
<div id="recherche-liste-recette">
    
    <h2> liste des recettes </h2>

    <table border="1" cellpadding="2">
        <thead>
            <tr>
                <th>Titre       </th>
                <th>Description </th>
                <th>Durée       </th>
                <th>Difficulté  </th>
                <th>Date de mise à jour </th>
                <th>Voir la recette     </th>
                <th>Notes               </th>
                <th>Commentaires        </th>
            </tr>
        </thead>

        <tbody>
                <?php foreach ($listeRecettes as $recette): ?>

                    <!-- ne pas fficher les recette de l'utilisateur connecté -->

                    <?php if ($recette->value("utilisateur_id") !=   $user->id()): ?>

                        <tr>
                            <td><?= $recette->html("titre")?>      </td>
                            <td><?= $recette->html("description")?></td>
                            <td><?= $recette->html("duree")?> min  </td>
                            <td><?= $recette->html("difficulte")?> </td>
                            <td><?= $recette->html("date_maj")?>   </td>

                            <!-- bouton voir une recette : -->
                            <td>
                                <a href="index.php?page=voir-recette&id=<?= $recette->id() ?>">
                                    Voir
                                </a>
                            </td>
                            
                            <td>
                                <?php require "templates/fragments/note-recette.php"; ?>
                            </td>

                            <td>
                                <?php require "templates/fragments/commentaires-recette.php"; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
        </tbody>
    </table>
</div>