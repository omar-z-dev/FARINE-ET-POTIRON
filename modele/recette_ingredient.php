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


}