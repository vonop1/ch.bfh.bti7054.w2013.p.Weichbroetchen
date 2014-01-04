<?php 
include ('password.php'); //password functions, needed if php version < 5.5

// set variables that are needed in all files
$language = get_param ("lang", "de");
$texts = "text_$language";

	/**
	 * loads the class definition File
	 * @param string $class_name, name of the class
	 */
  	function __autoload($class_name) { 
    	require_once($class_name.".inc.php"); 
  	} 
  
	/**
	 * get value of a parameter, if not set returns default value
	 * @param string $name of the parameter
	 * @param string $default value to retrun if not set
	 * @return string value of parameter
	 */
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
	
	/**
	 * add a parameter a existing url
	 * @param string $url the already exist
	 * @param string $name of the parameter to add
	 * @param string $value of the parameter
	 * @param string $sep seperator in the Url
	 * @return string new Url
	 */
	function add_param($url, $name, $value, $sep="&") 
	{
		$new_url = $url.$sep.$name."=".urlencode($value);
		return $new_url;
	}
	
	/**
	 * generates from the actual URL, a new URL with changed attributes
	 * @param string array $attr to change
	 * @return string new URL
	 */
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

	/**
	 * generates Html-code for a select List
	 * @param string $name for the Html-Form
	 * @param string array $options for the selcet List
	 * @param string $title of the Html-Form
	 * @param number $size, how many options to display at once
	 */
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
	
	/**
	 * generates Html-code for a option
	 * @param unknown $value of the Html-option
	 * @param unknown $text to display
	 */
	function makeOption($value, $text)
	{
		echo "<option value=\"$value\">$text</option>";
	}
	

	/**
	 * generates a checkbox
	 * @param stirng array $options for the radio-buttons
	 * @param string $title of the Html-Form
	 */
	function makeCheckboxes($options, $title)
	{
		
		if (is_array($options))
		{
			echo '<fieldset class="registration">';
			echo '<legend>' .$title. '</legend>';
			foreach($options as $value => $optionText)
			{
				echo "<input type=\"checkbox\" name =\"cb_$value\"> $optionText</input></br>";
			}
			echo '</fieldset>';
		}
	}

	/**
	 * generates a radio-button choice
	 * @param string $name of the the Html-Form
	 * @param stirng array $options for the radio-buttons
	 * @param string $title of the Html-Form
	 */
	function makeRadio($name, $options, $title)
	{
		if (is_array($options))
		{
			echo '<fieldset class="registration">';
			echo '<legend>' .$title. '</legend>';
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
	 * @param string $var the string to sanitize
	 * @return string the sanitized string
	 */
	function sanitizeString($var) {
		$var = stripslashes($var);
		$var = htmlentities($var);
		$var = strip_tags($var);
		return $var;
	}	

?>