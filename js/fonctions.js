/*
Librairies des fonctions spécifiques générales du projet
*/

/*==========================================================  
         role : afficher formulaire ajout recette 
===========================================================*/
function afficherFormAjout() {
  fetch("index.php?page=creer-recette-ajax")
    .then((response) => response.text())
    .then((html) => {
      document.getElementById("zone-ajout-recette").innerHTML = html;
    });
}

/*==========================================================  
         role : valider le formulaire ajout recette
===========================================================*/

function validerRecette() {
  // recup le formulaire avec son ID
  const formulaire = document.getElementById("form-recette");

  //crée un objet FormData contenant tous les champs du formulaire.
  const data = new FormData(formulaire);

  //navigateur envoie ces données en POST
  fetch("index.php?page=valider-creation-recette-ajax", {
    method: "POST",
    body: data,
  })
    .then((response) => response.text())
    .then((message) => {
      if (message === "SUCCESS") {
        document.getElementById("zone-ajout-recette").innerHTML =
          "<p style='color:green'>✅ Recette ajoutée avec succès.</p>";

        // supprimer le message de succes apres 3 secondes
        setTimeout(() => {
          document.getElementById("zone-ajout-recette").innerHTML = "";
        }, 3000);

        // Recharger la liste des recettes
        fetch("index.php?page=liste-recettes-ajax")
          .then((response) => response.text())
          .then((html) => {
            console.log(html);
            document.getElementById("liste-recettes").innerHTML = html;
          });
      } else {
        document.getElementById("msg-ajout-recette").innerHTML = message;
        // supprimer le message d echec apres 3 secondes
        setTimeout(() => {
          document.getElementById("msg-ajout-recette").innerHTML = "";
        }, 3000);
      }
    });
}

/************************************** */

/*==========================================================  
         role : AfficherFormModifierRecette
===========================================================*/
function AfficherFormModifierRecette(id) {
  fetch("index.php?page=modifier-recette-ajax&id=" + id)
    .then((response) => response.text())
    .then((html) => {
      // zone où affiche le formulaire
      document.getElementById("modifier-recette").innerHTML = html;
    })
    .catch((error) => {
      console.error("Erreur chargement formulaire modification :", error);
    });
}
/*==========================================================  
         role : validerModificationRecette
===========================================================*/
function validerModificationRecette() {
  const form = document.getElementById("form-modif-recette");
  const data = new FormData(form);

  fetch("index.php?page=valider-modif-recette-ajax", {
    method: "POST",
    body: data,
  })
    .then((res) => res.text())
    .then((message) => {
      if (message === "SUCCESS") {
        document.getElementById("modifier-recette").innerHTML =
          "<p style='color:green;font-weight:bold'>✔ Modifié avec succès</p>";
        // supprimer le message de succes apres 3 secondes
        setTimeout(() => {
          document.getElementById("modifier-recette").innerHTML = "";
        }, 3000);

        // refresh liste
        fetch("index.php?page=liste-recettes-ajax")
          .then((res) => res.text())
          .then((html) => {
            document.getElementById("liste-recettes").innerHTML = html;
          });
      } else {
        document.getElementById("msg-modif").innerHTML = message;
        // supprimer le message d echec apres 3 secondes
        setTimeout(() => {
          document.getElementById("msg-modif").innerHTML = "";
        }, 3000);
      }
    });
}
/*==========================================================  
        // fermer modif profil
===========================================================*/

function fermerProfil() {
  console.log("fermerProfil");
  document.getElementById("modifier-recette").innerHTML = "";
}
