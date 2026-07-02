<?php
/*
Classe archive : gestion des objets archive du MCD

*/
require_once __DIR__ . "/../core/model.php";
class ingredient extends _model {

    protected $table  = "ingredients";
    protected $fields = [  
    "nom" , 
    "type",
    "created_at",
    ];
    protected $links = [ 
    ];

    /*==================================================================
                    1. find by field et sa value
   ==================================================================*/
    function findBy($field, $value) {
        //role de la fonction : trouver un objet par un champ donné et charger ses données dans l'objet courant
        //parametres : $field : le nom du champ à rechercher, $value : la valeur à rechercher
        //retour : true si trouvé, false sinon

        $sql = "SELECT " . $this->listFieldsForSql() . "
                FROM `{$this->table}`
                WHERE `$field` = :value
                LIMIT 1";

        $req = $this->execute($sql, [
            ":value" => $value
        ]);

        $ligne = $req->fetch(PDO::FETCH_ASSOC);

        if (!$ligne) {
            return false;
        }

        $this->loadFromtab($ligne);

        return true;
    }

}