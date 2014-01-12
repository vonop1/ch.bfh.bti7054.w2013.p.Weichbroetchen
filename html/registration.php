<script type="text/javascript">

	function checkIfEmpty(value, target){
		if (value == ""){
			if (target == "streetNumber"){
				document.getElementById(target).className = "inputOK";
			}else{
				document.getElementById(target).className = "inputError";
			}
		}
		
		//check if there are still errors, if not enable submit form
		var submit = document.getElementById("submit");
		var inputArr = document.getElementsByClassName("inputError");
		if (inputArr.length > 0){
			submit.disabled = true;
		}else{
			submit.disabled = false;
		}
	}
	
	function callAjax(method, value, target){
		var xmlhttp; 
	    if (window.XMLHttpRequest){
			xmlhttp = new XMLHttpRequest();
	    }
	    xmlhttp.onreadystatechange = function(){
	    	
		    if (xmlhttp.readyState == 4){
		    	 if (xmlhttp.responseText.length > 0){
			    	 document.getElementById(target).className = "inputError";
			    	 document.getElementById(target + "Rsp").innerHTML = "<strong>" + xmlhttp.responseText + "</strong>";
		    	 }else{
		    		 document.getElementById(target).className = "inputOK";
		    		 document.getElementById(target + "Rsp").innerHTML = "";
		    	 }
	        } 
	    }
        xmlhttp.open("POST", "html/validateReg.php", true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

        //send extra value to compare password/email, else no extra value needed
        if (method == "passwordRCheck"){
        	var password = document.getElementById("password").value;
        	xmlhttp.send('method=' + method + '&value=' + encodeURIComponent(value) + '&extraVal=' + encodeURIComponent(password));
        }else if(method == "emailRCheck"){
        	var email = document.getElementById("email").value;
        	xmlhttp.send('method=' + method + '&value=' + encodeURIComponent(value) + '&extraVal=' + encodeURIComponent(email));
        }else{  
        	xmlhttp.send('method=' + method + '&value=' + encodeURIComponent(value) + '&extraVal=');
        }
	}
	
</script>
<?php
include_once ('functions.php');
//include_once ('GeoIPLocator.php');

//load texts for choosen language
$texts = simplexml_load_file("./text/$language.xml");
$registrationTexts = $texts->registration;

// set title texts
$titleTexts = $registrationTexts->titles;
$mainTitle = $titleTexts->main;
$userRegTitle = $titleTexts->userReg;
$finishTitle = $titleTexts->finish;

//get IP address and set location text
$locationText = $titleTexts->location;
$ipAddress = $_SERVER['REMOTE_ADDR'];

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
	
	//get form data
	$username = sanitizeString($_POST['username']);
	$userRow = array("Username" => $username,
			"Password" => password_hash($_POST['password'], PASSWORD_BCRYPT), // hash and salt the entered password
			"Firstname" => sanitizeString($_POST['firstname']),
			"Lastname" => sanitizeString($_POST['lastname']),
			"Street" => sanitizeString($_POST['street']),
			"StreetNo" => sanitizeString($_POST['streetNumber']),
			"ZIP" => sanitizeString($_POST['ZIP']),
			"City" => sanitizeString($_POST['city']),
			"Phone" => sanitizeString($_POST['phone']),
			"Email" => sanitizeString($_POST['email']));
	
	//create new User and show success/error message
	$user = User::withRow($userRow);
	$user->createUser();
	if($user->getRegError()){
		if ($language == "en"){
			echo '<p>Username: ' .$username. ' is already taken. Please choose something else</p>';
		}else{
			echo '<p>Benutzername: ' .$username. ' ist bereits vergeben. Bitte wählen Sie einen anderen Namen</p>';
		}
	}else{
		if ($language == "en"){
			echo '<p>User: ' .$username. ' was created. You\'re now able to login</p>';
		}else{
			echo '<p>User: ' .$username. ' wurde erstellt. Sie können sich nun einloggen</p>';
		}
	}

}else{ // display the registration form
	
	echo '<form name="input" action="" onsubmit="return validateForm()" method="post">';
	echo '<fieldset>';
	echo '<legend>' . $userRegTitle . '</legend>';
	$accesskey = 1;
	foreach ( $formTexts->children () as $child ) {
		$childName = $child->getName ();
		echo '<label class="registration" accesskey="' . $accesskey . '" for="' . $childName . '">' . $child . '</label>';
		if ($childName == "password" || $childName == "passwordR") {
			echo '<input type="password" id="' . $childName . '" name="' . $childName . '" size="' . $inputSize . '" class="input" onmouseup="checkIfEmpty(this.value, this.id);" onkeyup="checkIfEmpty(this.value, this.id);" onchange="callAjax(\'' .$childName. 'Check\', this.value, this.id);"></input>';
		} else {
			echo '<input id="' . $childName . '" name="' . $childName . '" size="' . $inputSize . '" class="input" onmouseup="checkIfEmpty(this.value, this.id);" onkeyup="checkIfEmpty(this.value, this.id);" onchange="callAjax(\'' .$childName. 'Check\', this.value, this.id);"></input>';
		}
		echo '<div id="' .$childName. 'Rsp" class="errorMsg"></div>';
		$accesskey ++;
	}
	echo '<input id="lang" type="hidden" value="' . $language . '"></input>';
	echo '</fieldset>';
	echo '<br></br>';
	echo '<fieldset>';
	echo '<legend>' . $finishTitle . '</legend>';
	echo '<input class="buttons" id="submit" name="submit" type="submit" value="' . $submitValue . '" disabled="disabled"></input>';
	echo '<input class="buttons" id="reset" type="reset" value="' . $resetValue . '"></input>';
	echo '</fieldset>';
	echo '</form>';
//	echo '<p>' .$locationText. ' ' .$ipAddress. ', ' .getGeoCountryWithWS($ipAddress). '</p>';
}

?>
