<script type="text/javascript" src="script/formValidation.js"></script>

<?php
include_once ('functions.php');

//load texts for choosen language
$texts = simplexml_load_file("./text/$language.xml");
$registrationTexts = $texts->registration;
$mainTitle = $registrationTexts->titles->Account;

// create html title
echo '<h2>' . $mainTitle . '</h2>';

if (isset($_SESSION["user"])){
	
	//get user from session
	$user = unserialize($_SESSION["user"]);
	
	//update user in database if form was changed
	if (isset($_POST['submit'])){
		
		//get POST data
		$firstname = sanitizeString($_POST['firstname']);
		$lastname = sanitizeString($_POST['lastname']);
		$street = sanitizeString($_POST['street']);
		$streetNo = sanitizeString($_POST['streetNo']);
		$zip = sanitizeString($_POST['zip']);
		$city = sanitizeString($_POST['city']);
		$phone = sanitizeString($_POST['phone']);
		$email = sanitizeString($_POST['email']);
		
		//update user data
		$user->updateUserData($firstname, $lastname, $street, $streetNo, $zip, $city, $phone, $email);
		
		//save user in session
		$_SESSION["user"]= serialize($user);
		
		//show success message
		echo '<p>' .$registrationTexts->errors->accSuc. '</p>';
		
	}else{ //display form
		$user->display("account", $registrationTexts, $language);
	}
	
}else{
	//no session means no access -> go back to index.php
	header('location:'.$_SERVER['PHP_SELF']);
}

?>