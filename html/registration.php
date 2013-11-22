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
	$inputSize = 50;
	$title = "Registrierung";
	$textReg = "Kontaktangaben";
	$textSend = "Abschliessen";
	
	echo '<h2>' .$title. '</h2>';
	echo '<form action ="evaluateReg.php" onsubmit="return validateForm()" method="post">';
	echo '<fieldset class="registration">';
	echo '<legend>' .$textReg. '</legend>';
	$accesskey = 1;
	foreach ( $formItems as $key => $value ) {
		echo '<label accesskey="' .$accesskey. '" for="' .$key. '">' .$value. '</label>';
		echo '<input id="' .$key. '" name="' .$key. '" size="' .$inputSize. '"></input>';
		echo '<br></br>';
		$accesskey++;
	}
	echo '</fieldset>';
	echo '<br></br>';
	echo '<fieldset class="buttons">';
	echo '<legend>' .$textSend. '</legend>';
	echo '<input id="submit" type="submit" value="Abschicken"></input>';
	echo '<input id="reset" type="reset" value="Eingaben löschen"></input>';
	echo '</fieldset>';
	echo '</form>';

?>
