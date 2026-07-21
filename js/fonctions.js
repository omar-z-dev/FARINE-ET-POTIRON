/*
Librairies des fonctions spécifiques générales du projet
*/

/*==========================================================  
         role : afficher formulaire ajout recette 
===========================================================*/
function afficherFormAjout() {
  fetch("index.php?page=creer-recette")
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
  console.log("afficher modif recette");

  fetch("index.php?page=modifier-recette-ajax2&id=" + id)
    .then((response) => response.text())
    .then((html) => {
      // zone où affiche le formulaire
      document.getElementById("modifier-recette").innerHTML = html;
      // Charger les farines dans les <select> du formulaire
      chargerCatalogueFarinesModification();
    });
}
/*==========================================================  
         role : chargerCatalogueFarines pour Modification
===========================================================*/

function chargerCatalogueFarinesModification() {
  console.log("charger  Catalogue   Farines   Modification");
  fetch("index.php?page=catalogue-farine")
    .then((response) => response.json())
    .then((data) => {
      document.querySelectorAll(".select-farine").forEach((select) => {
        const selected = select.dataset.selected;

        for (const reference in data) {
          const option = document.createElement("option");

          option.value = data[reference];
          option.textContent = data[reference];
          console.log("farine existante :", selected);

          if (data[reference] === selected) {
            option.selected = true;
          }

          select.appendChild(option);
        }
      });
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
  console.log("fermer form de modif");
  document.getElementById("fermer-profil").style.background = "grey";
  setTimeout(() => {
    document.getElementById("modifier-recette").innerHTML = "";
  }, 80);
}
/*==========================================================  
        // fermer
===========================================================*/

function fermerAjoutRecette() {
  console.log("fermerajout");
  document.getElementById("fermer-profil").style.background = "grey";
  setTimeout(() => {
    document.getElementById("zone-ajout-recette").innerHTML = "";
  }, 80);
}

/*==========================================================  
         role : ajouter ligne farine
===========================================================*/
function ajouterFarine() {
  fetch("index.php?page=ligne-farine-ajax")
    .then((response) => response.text())
    .then((html) => {
      console.log(html);
      document
        .getElementById("liste-farines")
        .insertAdjacentHTML("beforeend", html);
    })
    .catch((error) => console.error(error));
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
            ❌
        </button>
    `;

  //ajoute la ligne dans la page
  container.appendChild(ligne);
}
/* supprimer une ligne */
function supprimerLigne(bouton) {
  bouton.parentElement.remove();
}

/********************************************************* */

/*==========================================================  
         role : recherche recette 
===========================================================*/

let form = document.getElementById("searchForm");

if (form)
  form.addEventListener("submit", function (e) {
    e.preventDefault();

    rechercherRecettes();
  });

function rechercherRecettes() {
  console.log("rechercher recettes");
  let titre = document.querySelector("#titre").value;
  let difficulte = document.querySelector("#difficulte").value;
  let duree = document.querySelector("#duree_max").value;
  let farine = document.querySelector("#farine").value;

  fetch(
    //transformer un texte pour qu'il puisse être envoyé dans une URL en utilisant encodeURIComponent

    "index.php?page=recherche-recette-ajax" +
      "&titre=" +
      encodeURIComponent(titre) +
      "&difficulte=" +
      encodeURIComponent(difficulte) +
      "&duree=" +
      encodeURIComponent(duree) +
      "&farine=" +
      encodeURIComponent(farine),
  )
    .then((response) => response.text())
    .then((html) => {
      document.querySelector("#resultat-recherche-recette").innerHTML = html;
    });
}
