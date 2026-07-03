<?php
/*
Classe archive : gestion des objets archive du MCD

*/
require_once __DIR__ . "/../core/model.php";
class recette_ingredient extends _model {

    protected $table  = "recette_ingredients";
    protected $fields = [  
    "ingredient_id", 
    "recette_id",
    "quantite",
    "unite"
    ];
    
    protected $links = [ 
    "ingredient_id" => "ingredients",
    "recette_id"    => "recettes" 
    ];

    /*==================================================================
                    1. 
    ==================================================================*/
    function getIngredientsByRecette($recetteId){
        //role de la fonction : récupérer la liste des ingrédients d'une recette
        //parametres : $recetteId : l'id de la recette
        //retour : la liste des ingrédients de la recette
        $sql = "SELECT
                    ingredients.nom,
                    recette_ingredients.quantite,
                    recette_ingredients.unite
                    
                FROM recette_ingredients
                JOIN ingredients
                ON recette_ingredients.ingredient_id = ingredients.id
                WHERE recette_ingredients.recette_id = :id
        ";

        $req = $this->execute($sql, [
            ":id" => $recetteId
        ]);

      
        return $req->fetchAll(PDO::FETCH_ASSOC);
        
    }
}