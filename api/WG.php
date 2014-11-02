<?php

/*
* Wrapper Class for WunderGround API
*/
class WG {

  CONST API_URL 			= 'http://api.wunderground.com/api/';
  CONST API_QUERY_CONSTANT  = 'q';

  private $sAPIKey;
  
  private $sRequestUrl;

  private $sFeatures;
  private $sSettings;
  private $sQuery;
  private $sResponseFormat;
  private $aSupportedFormats = array('json','xml');

 //Can be used to Set Authentication Params

 public function __construct($sAPIKey){
 	$this->sAPIKey = $sAPIKey;
 }

 private function buildURL(){
 	
 	$this->sRequestUrl = self::API_URL.$this->sAPIKey;
	$this->sRequestUrl .= isset($this->sFeatures) ? $this->sFeatures : '' ;
	$this->sRequestUrl .= isset($this->sSettings) ? $this->$this->sSettings: '';
	$this->sRequestUrl .= "/".self::API_QUERY_CONSTANT;
	$this->sRequestUrl .= isset($this->sQuery) ? $this->sQuery : '';
	$this->sRequestUrl .= "." . $this->sResponseFormat;
 }

 private function executeRequest(){

 	$curl = curl_init();
 	curl_setopt($curl, CURLOPT_URL, $this->sRequestUrl);
 	curl_setopt($curl, CURLOPT_RETURNTRANSFER , TRUE);
 	$response = curl_exec($curl);

 	return $response;
 }

 private function setHeaders(){

 }
 
 public function setFeatures($aFeatures){
 	
 	if(!isset($aFeatures) || empty($aFeatures))
 		return;

 	foreach ($aFeatures as $key => $value) {
 		$this->sFeatures .= '/'.$value; 
 	}
 }

 public function setSettings($aSettings){

	if(!isset($aSettings) || empty($aSettings))	
 		return;
 	
 	foreach ($aSettings as $key => $value) {
 		$this->sSettings .= '/'.$value; 
 	}

 }

 public function setQuery($sQuery){
 	$this->sQuery = "/" . $sQuery;
 }

 public function setResponseFormat($sResponseFormat){
 	if(!in_array(strtolower($sResponseFormat), $this->aSupportedFormats)){
 		throw new Exception("Unkown or not supported format");
 	}

 	$this->sResponseFormat = $sResponseFormat;
 }

 public function processRequest(){
	$this->buildURL();
	return $this->executeRequest();
 }

}