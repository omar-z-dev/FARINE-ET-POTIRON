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
  const form = document.getElementById("form-recette");
  const data = new FormData(form);

  fetch("valider-creation-recette-ajax.php", {
    method: "POST",
    body: data,
  })
    .then((response) => response.text())
    .then((message) => {
      if (message === "SUCCESS") {
        document.getElementById("zone-ajout-recette").innerHTML =
          "<p style='color:green'>✅ Recette ajoutée avec succès.</p>";
      } else {
        document.getElementById("msg-ajout-recette").innerHTML = message;
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
