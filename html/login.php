<?php
session_unset();
session_destroy();
session_start();

include_once ('functions.php');
include('UserDB.inc.php');

//load texts for choosen language
$texts = simplexml_load_file ( "./text/$language.xml" );
$loginTexts = $texts->login;

// set title and messages
$mainTitle = $loginTexts->title;
$loginSuccess = $loginTexts->success;
$loginError = $loginTexts->error;

// set input field texts
$formTexts = $loginTexts->form;

// set button texts
$buttonTexts = $loginTexts->buttons;
$submitValue = $buttonTexts->send;
$resetValue = utf8_decode ( $buttonTexts->reset );

// set input field length
$inputSize = 50;

//set login error
$isLoginError = false;

// create html title
echo '<h2>' . $mainTitle . '</h2>';

if(isset($_POST["submit"])) {

	//get form data
	$username = sanitizeString($_POST['username']);
	$password = $_POST['password'];

	//get database data for entered username
	$userDB = new UserDB();
	$query = $userDB->getSpecificUser(strtolower($username));
	if($query->num_rows == 0){
		$isLoginError = true;
	}else{
		// Check if the hash of the entered login password, matches the stored hash.
		// The salt and the cost factor will be extracted from $existingHashFromDb.
		$user = $query->fetch_object();
		$existingHashFromDb = $user->Password;
		$isPasswordCorrect = password_verify($password, $existingHashFromDb);
		
		//start session for user or set login error
		if ($isPasswordCorrect) {
			$user = User::withUsername($username);
			$_SESSION["user"]= serialize($user);
			echo '<p>' .$loginSuccess. '</p>';
		}else{
			$isLoginError = true;
		}
		
	}
}

//display login form if there is no user session or a login error
if (!isset($_SESSION["user"]) || $isLoginError) {
	echo '<form action="" method="post">';
	echo '<fieldset>';
	$accesskey = 1;
	foreach ( $formTexts->children () as $child ) {
		$childName = $child->getName ();
		echo '<label class="login" accesskey="' . $accesskey . '" for="' . $childName . '">' . $child . '</label>';
		if ($childName == "password") {
			echo '<input type="password" id="' . $childName . '" name="' . $childName . '" size="' . $inputSize . '" class="input"></input>';
		} else {
			echo '<input id="' . $childName . '" name="' . $childName . '" size="' . $inputSize . '" class="input"></input>';
		}
		echo '<br></br>';
		$accesskey ++;
	}
	echo '<input class="buttons" id="submit" name="submit" type="submit" value="' . $submitValue . '"></input>';
	echo '<input class="buttons" id="reset" type="reset" value="' . $resetValue . '"></input>';
	echo '</fieldset>';
	echo '</form>';
	if($isLoginError){
		echo '<p>' .$loginError. '</p>';
	}
}

?>
