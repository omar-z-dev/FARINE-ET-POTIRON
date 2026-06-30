/*
Librairies des fonctions spécifiques générales du projet
*/

/*==========================================================  
         role : afficher formulaire ajout recette 
===========================================================*/
function afficherFormAjout() {
  fetch("creer-rectte-ajax.php")
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
  fetch("valider-creation-recette-ajax.php", {
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
        fetch("liste-recettes-ajax.php")
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
         role : afficher le detail d'une conversation
===========================================================*/

/*==========================================================  
         role : envoyer un message sans recharger la page
===========================================================*/

/*==========================================================  
         role : archiver conversation
===========================================================*/
