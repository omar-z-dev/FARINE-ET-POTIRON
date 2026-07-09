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
    "nom_ingredient",
    "unite"
    ];
    
    protected $links = [ 
    "ingredient_id" => "ingredients",
    "recette_id"    => "recettes" 
    ];

    /*==================================================================
           1. get ingredients by recette
    ==================================================================*/
    function getIngredientsByRecette($recetteId){
        //role de la fonction : récupérer la liste des ingrédients d'une recette
        //parametres : $recetteId : l'id de la recette
        //retour : la liste des ingrédients de la recette
        $sql = "SELECT
                    recette_ingredients.id,
                    ingredients.nom,
                    recette_ingredients.ingredient_id,
                    recette_ingredients.quantite,
                    recette_ingredients.unite
                    
                FROM recette_ingredients
                JOIN ingredients
                ON recette_ingredients.ingredient_id = ingredients.id
                WHERE recette_ingredients.recette_id = :id
                AND ingredients.type = 'autre'
        ";

        $req = $this->execute($sql, [
            ":id" => $recetteId
        ]);

      
        return $req->fetchAll(PDO::FETCH_ASSOC);
        
    }

    /*==================================================================
           2. get farines by recette
    ==================================================================*/
    function getFarinesByRecette($recetteId){
        //role de la fonction : récupérer la liste des farines d'une recette
        //parametres : $recetteId : l'id de la recette
        //retour : la liste des farines de la recette
        $sql = "SELECT
                    recette_ingredients.id,
                    ingredients.nom,
                    recette_ingredients.ingredient_id,
                    recette_ingredients.quantite,
                    recette_ingredients.unite
                    
                FROM recette_ingredients
                JOIN ingredients
                ON recette_ingredients.ingredient_id = ingredients.id
                WHERE recette_ingredients.recette_id = :id
                AND ingredients.type = 'farine'
        ";

        $req = $this->execute($sql, [
            ":id" => $recetteId
        ]);

      
        return $req->fetchAll(PDO::FETCH_ASSOC);
        
    }
}