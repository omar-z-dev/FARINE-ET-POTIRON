/*
Librairies des fonctions spécifiques générales du projet
*/

/*==========================================================  
         role : ouvrir une conversation 
===========================================================*/
function ouvrirConversation() {
  console.log("test ouvrirConversation");
  let nom = document.getElementById("nom").value;

  let url = "conversation-ajax.php?nom=" + nom;

  fetch(url)
    .then(function (response) {
      return response.text();
    })

    .then(function (fragment) {
      document.getElementById("zone-message").innerHTML = fragment;
      FormMessage2();
    });
}
/*==========================================================  
         role : envoyer un message apres avoir 
         selectionné le destinaire
===========================================================*/

function FormMessage2() {
  //role : envoyer un message sans recharger la page
  let form = document.getElementById("message-a-saisir-select");

  form.addEventListener("submit", function (e) {
    e.preventDefault();
    //creer un FormData qui va contenir le contenu du formulaire
    let formData = new FormData(this);
    //envoyer une requete HTTP POST vers traiter-message.php
    fetch("traiter-message.php", { method: "POST", body: formData })
      .then((response) => response.text())
      .then(() => {
        //vider le formulaire avec la methode reset
        document.getElementById("message-a-saisir-select").reset();
      });
  });
}

// Rafraîchissement automatique de la liste de conversation
function rafraichirListeConversations() {
  console.log("test rafraichirListeConversations");
  fetch("liste-conversations-ajax.php")
    .then((response) => response.text())
    .then((fragment) => {
      document.getElementById("liste-conversations").innerHTML = fragment;
    });
}
rafraichirListeConversations();

// Rafraîchissement automatique de la conversation

setInterval(function () {
  console.log("test setInterval liste de conversation");

  rafraichirListeConversations();
}, 2000);
/************************************** */

/*==========================================================  
         role : afficher le detail d'une conversation
===========================================================*/
let idActuel = null;
function detailConversation(id) {
  idActuel = id;

  //marquer comme lu

  fetch("lu-message-ajax.php?idHim=" + idActuel);

  fetch("detail-conversation-ajax.php?id=" + id)
    .then((data) => data.text())
    .then((fragment) => {
      document.getElementById("detail-conversation").innerHTML = fragment;

      // Mettre en bas de page le scroll pour afficher le dernier message
      setTimeout(() => {
        let conversation = document.querySelector(".conversation");

        if (conversation) {
          conversation.scrollTop = conversation.scrollHeight;
        }
      }, 50);

      FormMessage();
    });
}

/*==========================================================  
         role : envoyer un message sans recharger la page
===========================================================*/
function FormMessage() {
  console.log("test FormMessage");
  let form = document.getElementById("message-a-saisir");

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    //FormData est une fonction JavaScript intégrée qui parcourt automatiquement tous les champs du formulaire (inputs, textarea, selects, etc.) et construit un jeu de données prêt à être envoyé en HTTP.

    //Cela évite de devoir récupérer manuellement chaque champ (ex : document.querySelector('textarea[name="message"]').value)

    //fetch est une fonction moderne pour envoyer des requêtes réseau (AJAX) sans recharger la page.
    //url = "traiter-message.php" : le script PHP qui va traiter les données (votre script d'insertion).

    //fetch se charge d’envoyer les données (message, nom, etc.) à traiter-message.php sans recharger la page.

    /*method: "POST" : on envoie les données via la méthode HTTP POST (comme un formulaire classique).
s
    //body: formData : on transmet les données collectées du formulaire dans le corps de la requête.*/

    let formData = new FormData(this);

    fetch("traiter-message.php", { method: "POST", body: formData })
      .then((response) => response.text())
      .then(() => {
        detailConversation(idActuel);
        document.getElementById("message-a-saisir").reset();
      });
  });
}

// Rafraîchissement automatique de la conversation

setInterval(function () {
  console.log("test setInterval detail de conversation", idActuel);
  if (idActuel !== null) {
    detailConversation(idActuel);
  }
}, 15000);

/*==========================================================  
         role : archiver conversation
===========================================================*/

function archiverConversation(id) {
  console.log("test archive");
  fetch("archiver-ajax.php?id=" + id).then(() => {
    rafraichirListeConversations();
  });
}
