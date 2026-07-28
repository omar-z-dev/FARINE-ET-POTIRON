<?php
//role : afficher une ligne supplementares de farine

$api = new api();

$catalogueFarines = $api->getCatalogueFarineByCurl();

require "templates/fragments/ligne-farine.php";