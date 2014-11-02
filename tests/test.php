<?php

include "../api/WG.php";

$oWG = new WG("<YOUR-KEY-HERE>");

$oWG->setFeatures(array("forecast","geolookup"));
// $oWG->setSettings(array());
$oWG->setQuery("Australia/Sydney");
$oWG->setResponseFormat("json"); // Can be XML

$result = $oWG->processRequest();

var_dump($result);