<?php 
	//lädt Klassen definitions File
  	function __autoload($class_name) { 
    	require_once($class_name.".inc.php"); 
  	} 
  
	//fragt den Parameter $name der url ab, und gibt wenn nicht definiert den Default zurück
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
	
	//fügt der $url einen neuen parameter mit gegebenem Seperator  an
	function add_param($url, $name, $value, $sep="&") 
	{
		$new_url = $url.$sep.$name."=".urlencode($value);
		return $new_url;
	}
	
	//gerneriert aus der aktuellen URL eine neue URL mit geändertem Attribut
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

	//generiert den HTML Code für eine Auswahlliste
	function makeSelection($name, $options, $text, $size = 1)
	{
		if (is_array($options))
		{
			echo '<fieldset class="registration">';
			echo '<legend>' .$text. '</legend>';
			echo "<select name=\"$name\" size=\"$size\">";
			foreach($options as $value => $optionText)
			{
				makeOption($value, $optionText);
			}
			echo "</select>";
			echo '</fieldset>';
		}
	}
	
	//generiert den HTML Code für eine Option in einer Auswahlliste
	function makeOption($value, $text)
	{
		echo "<option value=\"$value\">$text</option>";
	}
	

	//generiert den HTML Code für Checkboxes
	function makeCheckboxes($options, $text)
	{
		
		if (is_array($options))
		{
			echo '<fieldset class="registration">';
			echo '<legend>' .$text. '</legend>';
			foreach($options as $optionText)
			{
				echo "<input type=\"checkbox\" name =\"cb_$optionText\"> $optionText</input></br>";
			}
			echo '</fieldset>';
		}
	}

	//generiert den HTML Code für Radio Buttons
	function makeRadio($name, $options, $text)
	{
		if (is_array($options))
		{
			echo '<fieldset class="registration">';
			echo '<legend>' .$text. '</legend>';
			foreach($options as $optionText)
			{
				echo "<input type=\"radio\" name =\"$name\" value=\"$optionText\"> $optionText</input>";
				echo '<br>';
			}
			echo '</fieldset>';
		}
	}
	

?>