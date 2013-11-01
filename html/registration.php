<?php
	include_once ('functions.php');
	$registrationForm = array(	"de" => array (
										"firstname" => "Vorname", 
										"lastname" => "Nachname", 
										"street" => "Strasse", 
										"streetNumber" => "Hausnummer", 
										"ZIP" => "PLZ", 
										"city" => "Ort", 
										"phone" => "Telefonnummer",
										"email" => "E-Mailadresse",
										"emailR" => "E-Mailadresse wiederholen"),
								"en" => array (
										"firstname" => "Firstname", 
										"lastname" => "Lastname", 
										"street" => "Street", 
										"streetNumber" => "Streetnumber", 
										"ZIP" => "ZIP", 
										"city" => "City", 
										"phone" => "Phonenumber",
										"email" => "E-Mailadresse",
										"emailR" => "E-Mailadresse wiederholen")
								);
	function regForm($items)
	{
		$language = get_param("lang", "de");
		$formItems = $items[$language]; //Array entsprechend der Sprache nehmen
		foreach ($languageItems as $key => $value)
		{
			echo '<input name="'. $key .'">'. $value .'</input>';
		}
	
	}
?>
