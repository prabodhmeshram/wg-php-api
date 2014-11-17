<?php

require "../api/WG.php";
require "../config/config.php"; 

if(trim($sAPI_KEY) == ''){
	throw new Exception("API KEY NOT SET");
}

$oWG = new WG($sAPI_KEY);

$oWG->setFeatures(array("forecast","geolookup"));
// $oWG->setSettings(array());
$oWG->setQuery("Australia/Sydney");
$oWG->setResponseFormat("json"); // Can be XML

$result = $oWG->processRequest();

var_dump($result); // Outputs your result