<script type="text/javascript" src="script/formValidation.js"></script>

<?php
include_once ('functions.php');
include_once ('GeoIPLocator.php');

//load texts for choosen language
$texts = simplexml_load_file("./text/$language.xml");
$registrationTexts = $texts->registration;

// set title texts
$titleTexts = $registrationTexts->titles;
$mainTitle = $titleTexts->main;

//get IP address and set location text
$locationText = $titleTexts->location;
$ipAddress = $_SERVER['REMOTE_ADDR'];

// create html title
echo '<h2>' . $mainTitle . '</h2>';

//create new user in database if form was filled
if (isset($_POST['submit'])){

	//get form data
	$username = sanitizeString($_POST['username']);
	$userRow = array("Username" => $username,
			"Password" => password_hash($_POST['password'], PASSWORD_BCRYPT), // hash and salt the entered password
			"Firstname" => sanitizeString($_POST['firstname']),
			"Lastname" => sanitizeString($_POST['lastname']),
			"Street" => sanitizeString($_POST['street']),
			"StreetNo" => sanitizeString($_POST['streetNo']),
			"ZIP" => sanitizeString($_POST['zip']),
			"City" => sanitizeString($_POST['city']),
			"Phone" => sanitizeString($_POST['phone']),
			"Email" => sanitizeString($_POST['email']));
	
	//create new User
	$user = User::withRow($userRow);
	$user->createUser();
	
	//set feedback texts
	$errorTexts = $texts->registration->errors;
	$regErr = utf8_decode($errorTexts->regErr);
	$regSuc = utf8_decode($errorTexts->regSuc);
	
	//show error/success message
	if($user->getRegError()){
		echo '<p>' .$username.$regErr. '</p>';
	}else{
		echo '<p>' .$username.$regSuc. '</p>';
	}

}else{ // display the registration form
	
	$user = new User();
	$user->display("registration", $registrationTexts, $language);
	echo '<p>' .$locationText. ' ' .$ipAddress. ', ' .getGeoCountryWithWS($ipAddress). '</p>';
}

?>
