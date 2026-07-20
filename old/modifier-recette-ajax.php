function ajouterFarine() {

    fetch("index.php?page=ligne-farine-ajax")
        .then(response => response.text())
        .then(html => {
            console.log(html);
            document
                .getElementById("liste-farines")
                .insertAdjacentHTML("beforeend", html);
        })
        .catch(error => console.error(error));

}