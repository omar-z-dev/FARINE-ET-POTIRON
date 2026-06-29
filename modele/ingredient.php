<?php
/*
Classe archive : gestion des objets archive du MCD

*/
require_once __DIR__ . "/../core/model.php";
class ingredient extends _model {

    protected $table  = "ingredients";
    protected $fields = [  
    "nom" , 
    "type"
    ];
    protected $links = [ 
    ];


}