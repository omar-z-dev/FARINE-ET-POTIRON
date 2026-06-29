<?php
/*
Classe message : gestion des objets message du MCD

*/
require_once __DIR__ . "/../core/model.php";
class recette extends _model {

    protected $table  = "recettes";
    protected $fields = [ 
    "titre", 
    "description" , 
    "duree" , 
    "difficulte",
    "date_maj",
    "utilisateur_id"
    ];
    protected $links  = [ 
    "utilisateur_id" => "utilisateurs"
    ];

 

}
