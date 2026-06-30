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

    /*=====================================================
            1.         mes recettes      
    =======================================================*/    

    function mesRecettes($utilisateur_id) {
        //role : recuperer mes recettes
        // parametres : $utilisateur_id
        // retour : $lignes

        $sql = "SELECT * FROM recettes WHERE utilisateur_id = $utilisateur_id";
        $req = $this->execute($sql);
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
