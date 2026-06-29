<?php
/*
Classe archive : gestion des objets archive du MCD

*/
require_once __DIR__ . "/../core/model.php";
class note extends _model {

    protected $table  = "notes";
    protected $fields = [  
    "utilisateur_id" , 
    "recette_id",
    "note"
    ];
    protected $links = [ 
    "utilisateur_id"   => "utilisateurs",
    "recette_id"       => "recettes" 
    ];


}