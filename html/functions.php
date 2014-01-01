<?php 
include ('password.php'); //password functions, needed if php version < 5.5

	//l�dt Klassen definitions File
  	function __autoload($class_name) { 
    	require_once($class_name.".inc.php"); 
  	} 
  
	//fragt den Parameter $name der url ab, und gibt wenn nicht definiert den Default zur�ck
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
	
	//f�gt der $url einen neuen parameter mit gegebenem Seperator  an
	function add_param($url, $name, $value, $sep="&") 
	{
		$new_url = $url.$sep.$name."=".urlencode($value);
		return $new_url;
	}
	
	//gerneriert aus der aktuellen URL eine neue URL mit ge�nderten Attributen
	function changeUrl($attr)
	{
		if (isset($attr["idMain"]))
		{
			$idMain = $attr["idMain"];
		}
		else 
		{
			$idMain = get_param("idMain", 1);
		}
		
		if (isset($attr["idSec"]))
		{
			$idSec = $attr["idSec"];
		}
		else 
		{
			$idSec = get_param("idSec", 1);
		}
		
		if (isset($attr["lang"]))
		{
			$language = $attr["lang"];
		}
		else 
		{
			$language = get_param("lang", "de");
		}
		
		$url = $_SERVER['PHP_SELF'];
		$url = add_param($url,"idMain",$idMain,"?");
		$url = add_param($url,"idSec",$idSec);
		$url = add_param($url, "lang", $language);
		
		return $url;
	}

	//generiert den HTML Code f�r eine Auswahlliste
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
	
	//generiert den HTML Code f�r eine Option in einer Auswahlliste
	function makeOption($value, $text)
	{
		echo "<option value=\"$value\">$text</option>";
	}
	

	//generiert den HTML Code f�r Checkboxes
	function makeCheckboxes($options, $text)
	{
		
		if (is_array($options))
		{
			echo '<fieldset class="registration">';
			echo '<legend>' .$text. '</legend>';
			foreach($options as $value => $optionText)
			{
				echo "<input type=\"checkbox\" name =\"cb_$value\"> $optionText</input></br>";
			}
			echo '</fieldset>';
		}
	}

	//generiert den HTML Code f�r Radio Buttons
	function makeRadio($name, $options, $text)
	{
		if (is_array($options))
		{
			echo '<fieldset class="registration">';
			echo '<legend>' .$text. '</legend>';
			foreach($options as $value => $optionText)
			{
				echo "<input type=\"radio\" name =\"$name\" value=\"$value\"> $optionText</input>";
				echo '<br>';
			}
			echo '</fieldset>';
		}
	}
	
	/**
	 * Un-quotes a quoted string, removes html characters and html tags
	 * @param unknown $var the string to sanitize
	 * @return string the sanitized string
	 */
	function sanitizeString($var) {
		$var = stripslashes($var);
		$var = htmlentities($var);
		$var = strip_tags($var);
		return $var;
	}	

?>