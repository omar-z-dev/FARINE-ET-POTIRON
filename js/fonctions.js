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
      chargerCatalogueFarines();
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
        // fermer
===========================================================*/

function fermerModifRecette() {
  console.log("fermermodif");
  document.getElementById("modifier-recette").innerHTML = "";
}
/*==========================================================  
        // fermer
===========================================================*/

function fermerAjoutRecette() {
  console.log("fermerajout");
  document.getElementById("zone-ajout-recette").innerHTML = "";
}

/*==========================================================  
         role : afficher les farine dispo depuis api
===========================================================*/
function chargerCatalogueFarines() {
  fetch("https://api.mywebecom.ovh/play/fep/catalogue.php")
    .then((response) => response.json())
    .then((data) => {
      const select = document.querySelector('select[name="farines[]"]');

      for (const reference in data) {
        const option = document.createElement("option");

        option.value = reference;
        option.textContent = data[reference];

        select.appendChild(option);
      }
    });
}

/*==========================================================  
         role : ajouter ligne farine
===========================================================*/
function ajouterFarine() {
  //récupère le conteneur principal
  const container = document.getElementById("liste-farines");

  // crée une nouvelle ligne
  const ligne = document.createElement("div");
  ligne.classList.add("ligne-farine");

  //construit le HTML de la ligne
  ligne.innerHTML = `
        <select name="farines[]">
            <option value="">-- Choisir une farine --</option>
        </select>

        <input type="number" name="quantite_farines[]" placeholder="Quantité">

        <select name="unite_farines[]">
            <option value="g">g</option>
            <option value="kg">kg</option>
        </select>
        <button type="button" onclick="supprimerLigne(this)">
            ✖
        </button>
    `;

  //ajoute la ligne dans la page
  container.appendChild(ligne);

  //recharge les farines API dans le nouveau select
  chargerCatalogueFarinesLigneSup(
    ligne.querySelector('select[name="farines[]"]'),
  );
}
/*==========================================================  
         role : charger catalogue farines
===========================================================*/
function chargerCatalogueFarinesLigneSup(select) {
  fetch("https://api.mywebecom.ovh/play/fep/catalogue.php")
    .then((response) => response.json())
    .then((data) => {
      for (const reference in data) {
        const option = document.createElement("option");

        option.value = reference;
        option.textContent = data[reference];

        select.appendChild(option);
      }
    });
}

/*==========================================================  
         role : ajouter ligne ingredient
===========================================================*/
function ajouterIngredient() {
  //récupère le conteneur principal
  const container = document.getElementById("liste-ingredients");

  // crée une nouvelle ligne
  const ligne = document.createElement("div");
  ligne.classList.add("ligne-ingredient");

  //construit le HTML de la ligne
  ligne.innerHTML = `
        <input type="text" name="ingredients[]"
            placeholder="Nom de l'ingrédient">

        <input type="number" name="quantite_ingredients[]"
            placeholder="Quantité">

        <input type="text" name="unite_ingredients[]"
            placeholder="g, ml...">
        <button id = "btn-supprimer-ligne" type="button" onclick="supprimerLigne(this)">
            ✖
        </button>
    `;

  //ajoute la ligne dans la page
  container.appendChild(ligne);
}
/* supprimer une ligne */
function supprimerLigne(bouton) {
  bouton.parentElement.remove();
}
