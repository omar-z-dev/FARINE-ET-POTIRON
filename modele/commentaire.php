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
            1. find commentaie par recette par utilisateur    
    =======================================================*/ 


    function findByRecetteUtilisateur($recette_id, $utilisateur_id) {
        $sql = "SELECT * FROM `$this->table` WHERE recette_id = :recette_id AND utilisateur_id = :utilisateur_id";
        $req = $this->execute($sql, [
            ":recette_id"     => $recette_id,
            ":utilisateur_id" => $utilisateur_id
        ]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    /*=====================================================
           2. all commentaie par recette   
    =======================================================*/

    function getCommentairesByRecette($idRecette){
        $sql = "SELECT
                commentaires.commentaire,
                commentaires.date_maj,
                utilisateurs.pseudo
                FROM commentaires
                JOIN utilisateurs
                ON commentaires.utilisateur_id = utilisateurs.id
                WHERE commentaires.recette_id = :id
                ORDER BY commentaires.date_maj DESC";

        $req = $this->execute($sql , [":id" => $idRecette]);

        $lignes = $req->fetchAll(PDO::FETCH_ASSOC);
            $objets = [];
            
            // get_class($this) retourne nom de la classe de l'objet courant (ex : "Projet" ou "Utilisateur")
            $className = get_class($this);
            
            foreach ($lignes as $ligne) {
                // Créer un nouvel objet de la même classe que l'objet courant, le charger avec la ligne, et le stocker dans le tableau des objets
                $objet = new $className();
                $objet->loadFromtab($ligne);
                $objets[] = $objet;
            }
            return $objets;

    }

}