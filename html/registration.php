<?php
	include_once ('functions.php');
	$registrationForm = array (
			"de" => array (
					"firstname" => "Vorname",
					"lastname" => "Nachname",
					"street" => "Strasse",
					"streetNumber" => "Hausnummer",
					"ZIP" => "PLZ",
					"city" => "Ort",
					"phone" => "Telefonnummer",
					"email" => "E-Mailadresse",
					"emailR" => "E-Mailadresse wiederholen" 
			),
			"en" => array (
					"firstname" => "Firstname",
					"lastname" => "Lastname",
					"street" => "Street",
					"streetNumber" => "Streetnumber",
					"ZIP" => "ZIP",
					"city" => "City",
					"phone" => "Phonenumber",
					"email" => "E-Mailadresse",
					"emailR" => "E-Mailadresse wiederholen" 
			) 
	);
	
	$language = get_param ( "lang", "de" );
	$formItems = $registrationForm [$language]; // Array entsprechend der Sprache nehmen
	
	foreach ( $formItems as $key => $value ) {
		echo '<tr>';
		echo  '<td>' .$value. '</td><td><input name="' .$key. '"></input></td>';
		echo '<tr>';
	}

?>
