<?php
include_once ('functions.php');
include_once ('password.php');
include('UserDB.inc.php');

// set the language and load texts for choosen language
$language = get_param ( "lang", "de" );
$texts = simplexml_load_file ( "./text/$language.xml" );
$registrationTexts = $texts->registration;

// set title texts
$titleTexts = $registrationTexts->titles;
$mainTitle = $titleTexts->main;
$userRegTitle = $titleTexts->userReg;
$finishTitle = $titleTexts->finish;

// set input field texts
$formTexts = $registrationTexts->form;

// set button texts
$buttonTexts = $registrationTexts->buttons;
$submitValue = $buttonTexts->send;
$resetValue = utf8_decode ( $buttonTexts->reset );

// set input field length
$inputSize = 50;

// create html title
echo '<h2>' . $mainTitle . '</h2>';

//create new user in database if form was filled
if (isset($_POST['submit'])){
	
	$username = sanitizeString($_POST['username']);
	$firstname = sanitizeString($_POST['firstname']);
	$lastname = sanitizeString($_POST['lastname']);
	$street = sanitizeString($_POST['street']);
	$streetNo = sanitizeString($_POST['streetNumber']);
	$zip = sanitizeString($_POST['ZIP']);
	$city = sanitizeString($_POST['city']);
	$phone = sanitizeString($_POST['phone']);
	$email = sanitizeString($_POST['email']);
	$password = $_POST['password'];
	$cryptedPW = password_hash($password, PASSWORD_BCRYPT);
	
	$userDB = new UserDB();
	$query = $userDB->getSpecificUser(strtolower($username));
	
	if($query == null){
		$userDB->insertUser($username, $cryptedPW, $firstname, $lastname, $street, $streetNo, $zip, $city, $phone, $email);
	}else{
		echo '<p>Username: ' .$username. ' is already taken. Please choose something else</p>';
	}

	
	if ($language == "en"){
		echo '<p>User: ' .$username. ' was created. You\'re now able to login</p>';
	}else{
		echo '<p>User: ' .$username. ' wurde erstellt. Sie k�nnen sich nun einloggen</p>';
	}

}else{ // display the registration form
	
	echo '<form action="" onsubmit="return validateForm()" method="post">';
	echo '<fieldset class="registration">';
	echo '<legend>' . $userRegTitle . '</legend>';
	$accesskey = 1;
	foreach ( $formTexts->children () as $child ) {
		$childName = $child->getName ();
		echo '<label accesskey="' . $accesskey . '" for="' . $childName . '">' . $child . '</label>';
		if ($childName == "password" || $childName == "passwordR") {
			echo '<input type="password" id="' . $childName . '" name="' . $childName . '" size="' . $inputSize . '"></input>';
		} else {
			echo '<input id="' . $childName . '" name="' . $childName . '" size="' . $inputSize . '" class="input"></input>';
		}
		echo '<br></br>';
		$accesskey ++;
	}
	echo '<input id="lang" type="hidden" value="' . $language . '"></input>';
	echo '</fieldset>';
	echo '<br></br>';
	echo '<fieldset class="buttons">';
	echo '<legend>' . $finishTitle . '</legend>';
	echo '<input id="submit" name="submit" type="submit" value="' . $submitValue . '"></input>';
	echo '<input id="reset" type="reset" value="' . $resetValue . '"></input>';
	echo '</fieldset>';
	echo '</form>';
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
