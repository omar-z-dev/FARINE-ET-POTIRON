<?php

$url = "https://api.mywebecom.ovh/play/fep/catalogue.php";

//initialisation
$curl = curl_init($url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$resultat = curl_exec($curl);

if ($resultat === false) {
    // erreur de la réponse
    echo "Echec de la requête : " . curl_error($curl);
    exit;
}

header("Content-Type: application/json");

echo $resultat;
exit;