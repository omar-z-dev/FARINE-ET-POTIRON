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

    /*=====================================================
            1.        finf commentaie par recette par utilisateur    
    =======================================================*/ 


    function findByRecetteUtilisateur($recette_id, $utilisateur_id) {
        $sql = "SELECT * FROM `$this->table` WHERE recette_id = :recette_id AND utilisateur_id = :utilisateur_id";
        $req = $this->execute($sql, [
            ":recette_id"     => $recette_id,
            ":utilisateur_id" => $utilisateur_id
        ]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

}