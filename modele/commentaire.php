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

        //role : trouver un commentaire par recette par utilisateur
        // parametres : $recette_id, $utilisateur_id
        // retour : $ligne

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
        //role : trouver tous les commentaires par recette
        // parametres : $idRecette
        // retour : $lignes

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
        return $lignes;

    }


    function getCommentairesUtilisateur($utilisateurId) {
            //role : trouver tous les commentaires par utilisateur
            // parametres : $utilisateurId
            // retour : $lignes
            $sql = "SELECT
                    commentaires.id,
                    commentaires.commentaire,
                    commentaires.date_maj,
                    recettes.titre
                FROM commentaires
                JOIN recettes
                ON commentaires.recette_id = recettes.id
                WHERE commentaires.utilisateur_id = :utilisateur_id
                ORDER BY commentaires.date_maj DESC";

        $req = $this->execute($sql, [
            ":utilisateur_id" => $utilisateurId
        ]);

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}