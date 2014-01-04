<?php
require_once "./lib/nusoap.php";

//set new soap client
$client = new nusoap_client('http://www.webservicex.net/geoipservice.asmx?WSDL', true);

//get ip address or set ip address manually if executed on localhost
$ipAddress = $_SERVER['REMOTE_ADDR'];
if($ipAddress == "::1" || $ipAddress == "127.0.0.1"){
	$ipAddress = "178.197.224.152";
}

//get result and extract country
$result = $client->call('GetGeoIP',(array('IPAddress' => $ipAddress)));
$country = $result["GetGeoIPResult"]["CountryName"];

?>