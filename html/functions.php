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
	
	function mainNav($items)
	{
		$language = get_param("lang", "de");
		$languageItems = $items[$language];
		foreach ($languageItems as $item)
		{
			echo '<li class="mainNav">';
			echo "$item";							
			echo '</li>';	
		}
				
	}
	
	function language()
	{
		$url = $_SERVER['PHP_SELF'];
		//$url = add_param($url, "id", get_param("id", 0), "?");
		//echo "<a href=\"".add_param($url,"lang","de")."\">DE</a> ";
		//echo "<a href=\"".add_param($url,"lang","en")."\">EN</a> ";			
		echo "<a href=\"".add_param($url,"lang","de","?")."\">DE</a> ";
		echo "<a href=\"".add_param($url,"lang","en","?")."\">EN</a> ";
	}
?>