


<?php

$url = "https://api.mywebecom.ovh/play/fep/catalogue.php";

$curl = curl_init($url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$resultat = curl_exec($curl);

curl_close($curl);

header("Content-Type: application/json");

echo $resultat;