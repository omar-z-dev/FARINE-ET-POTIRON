<?php


$api = new api();

$catalogueFarines = $api->getCatalogueFarineByCurl();

require "templates/fragments/ligne-farine.php";