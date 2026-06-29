<?php
/*
Classe archive : gestion des objets archive du MCD

*/
require_once __DIR__ . "/../core/model.php";
class commentaire extends _model {

    protected $table  = "commentaires";
    protected $fields = [  
    "utilisateur_id" , 
    "recette_id",
    "commentaire",
    "date_maj"
    ];
    protected $links = [ 
    "utilisateur_id"   => "utilisateurs",
    "recette_id"       => "recettes" 
    ];


}