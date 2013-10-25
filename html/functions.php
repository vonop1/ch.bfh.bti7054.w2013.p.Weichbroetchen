<?php
	function get_param($name, $default) 
	{
		if (isset($_GET[$name])) 
		{
			return urldecode($_GET[$name]);
		}
		else
		{
			return $default;
		}
	}
	
	function add_param($url, $name, $value, $sep="&") 
	{
		$new_url = $url.$sep.$name."=".urlencode($value);
		return $new_url;
	}
	
	function changeUrl($attr, $val)
	{
		$idMain = get_param("idMain", 0);
		$idSec = get_param("idSec", 0);
		$language = get_param("lang", "de");
		
		if ($attr == "idMain") 	$idMain = $val;
		if ($attr == "idSec") 	$idSec = $val;
		if ($attr == "lang") 	$language = $val;
		
		$url = $_SERVER['PHP_SELF'];
		$url = add_param($url,"idMain",$idMain,"?");
		$url = add_param($url,"idSec",$idSec);
		$url = add_param($url, "lang", $language);
		
		return $url;
	}

?>