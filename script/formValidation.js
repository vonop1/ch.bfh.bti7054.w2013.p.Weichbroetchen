/**
 * checks if a input field is empty and sets the css classes
 * @param value the value to check
 * @param target the id of the input field to check
 */
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

/**
 * Uses ajax to validate the registration form
 * @param method the method to call for in the server side php file
 * @param value the value of the input field
 * @param target the id of the input field
 */
function callAjax(method, value, target){
	
	//create new ajax request
	var xmlhttp; 
	   if (window.XMLHttpRequest){
		xmlhttp = new XMLHttpRequest();
    }
	
	//check for readyState 4 (completed)
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState == 4){
			
			//if an error was detected set message and paint field red, else everything is ok (green)
			if (xmlhttp.responseText.length > 0){
				document.getElementById(target).className = "inputError";
				document.getElementById(target + "Rsp").innerHTML = "<strong>" + xmlhttp.responseText + "</strong>";
			}else{
				document.getElementById(target).className = "inputOK";
				document.getElementById(target + "Rsp").innerHTML = "";
			}
		} 
	}
	
	//open new request, set header for POST-values and send the request to server
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

/**
 * OLD Version before ajax implementation
 * Validates the registration form, language is set with hidden input 
 * @returns {Boolean} false if an error is found, true if everything is ok
 */
function validateForm(){
	
	//get input fields and set standard values
	var username = document.getElementById("username");
	username.className = "inputOK";
	username.title = "OK";
	var firstname = document.getElementById("firstname");
	firstname.className = "inputOK";
	firstname.title = "OK";
	var lastname = document.getElementById("lastname");
	lastname.className = "inputOK";
	lastname.title = "OK";
	var street = document.getElementById("street");
	street.className = "inputOK";
	street.title = "OK";
	var streetNo = document.getElementById("streetNo");
	streetNo.className = "inputOK";
	streetNo.title = "OK";
	var zip = document.getElementById("zip");
	zip.className = "inputOK";
	zip.title = "OK";
	var city = document.getElementById("city");
	city.className = "inputOK";
	city.title = "OK";
	var phone = document.getElementById("phone");
	phone.className = "inputOK";
	phone.title = "OK";
	var email = document.getElementById("email");
	email.className = "inputOK";
	email.title = "OK";
	var emailR = document.getElementById("emailR");
	emailR.className = "inputOK";
	emailR.title = "OK";
	var checkPwd = false;
	if (document.getElementById("password")){
		var password = document.getElementById("password");
		password.className = "inputOK";
		password.title = "OK";
		var passwordR = document.getElementById("passwordR");
		passwordR.className = "inputOK";
		passwordR.title = "OK";
		checkPwd = true;
	}

	//get language
	var language = document.getElementById("lang").value;
	
	//set standard return value
	var ret = true;
	
	//check the input fields
	if (!username.value.match(/^[A-Za-z]+[A-Za-z0-9]*$/)){
		if(language == "en"){
			username.title = "Username error! Allowed characters are the alphabet and numbers. Must start with a letter";
		}else{
			username.title = "Fehler beim Benutzername! Erlaubt sind Buchstaben und Zahlen. Muss mit einem Buchstaben anfangen";
		}
		username.className = "inputError";
		ret = false;
	}

	if (!firstname.value.match(/^[A-ZÄÖÜa-zäöüéèàç]{2,}$/)) {
		if(language == "en"){
			firstname.title = "Firstname error! At least 2 characters, without spaces";
		}else{
			firstname.title = "Fehler bei Vorname! Mindestens 2 Buchstaben, ohne Leerzeichen";
		}
		firstname.className = "inputError";
	    ret = false;
	}
	
	if (!lastname.value.match(/^[a-zA-ZäöüÄÖÜéàèÉÈç]{1}[a-zA-ZäöüÄÖÜéàèÉÈç ]{1,}$/)){
		if(language == "en"){
			lastname.title = "Lastname error! At least two letters, spaces are allowed";
		}else{
			lastname.title = "Fehler bei Nachname! Mindestens zwei Buchstaben, Leerzeichen sind erlaubt";
		}
		lastname.className = "inputError";
	    ret = false;
	}

	if (!street.value.match(/^[A-ZÄÖÜa-zäöü]+$/)){
		if(language == "en"){
			street.title = "Street error! Only letters are allowed";
		}else{
			street.title = "Fehler bei Strasse! Nur Buchstaben sind erlaubt";
		}
	    street.className = "inputError";
	    ret = false;
	}
	
	if (!streetNo.value.match(/^[0-9A-Za-z]*$/)){
		if(language == "en"){
			streetNo.title = "Street number error! Only letters from the alphabet and numbers are allowed";
		}else{
			streetNo.title = "Fehler bei Strassenummer! Nur Buchstaben aus dem Alphabet und Zahlen sind erlaubt";
		}
	    streetNo.className = "inputError";
	    ret = false;
	}
	
	if (!zip.value.match(/^[1-9]{1}\d{3}$/)){
		if(language == "en"){
			zip.title = "ZIP error! Only four-digit numbers are allowed";
		}else{
			zip.title = "Fehler bei PLZ! Nur vierstellige Zahlen sind erlaubt";
		}
	    zip.className = "inputError";
	    ret = false;
	}
	
	if (!city.value.match(/^[A-ZÄÖÜa-zäöü ]{2,}$/)){
		if(language == "en"){
			city.title = "City error! Only letters and spaces are allowed";
		}else{
			city.title = "Fehler beim Ort! Nur Buchstaben und Leerzeichen sind erlaubt";
		}
	    city.className = "inputError";
	    ret = false;
	}
	
	if (!phone.value.match(/^\+\d{2} \d{2} \d{3} \d{2} \d{2}$/)){
		if(language == "en"){
			phone.title = "Phonenumber error! Please provide your number in the following format: +41 XX XXX XX XX";
		}else{
			phone.title = "Fehler bei der Telefonnummer! Bitte Telefonnummer im Format +41 XX XXX XX XX angeben";
		}
		phone.className = "inputError";
	    ret = false;
	}
	
	if (email.value != emailR.value){
		if(language == "en"){
			email.title = "Email address error! Entries don't match";
			emailR.title = "Email address error! Entries don't match";
		}else{
			email.title = "Fehler bei E-Mailadresse! Einträge stimmen nicht überein";
			emailR.title = "Fehler bei E-Mailadresse! Einträge stimmen nicht überein";
		}
		email.className = "inputError";
		emailR.className = "inputError";
		ret = false;
	}else if(!email.value.match(/^[A-Za-z0-9\._%\+-]+@[A-Za-z0-9\.-]+\.[A-Za-z]{2,4}$/)){
		if(language == "en"){
			email.title = "Email address error! This is not a valid email address";
			emailR.title = "Email address error! This is not a valid email address";
		}else{
			email.title = "Fehler bei E-Mailadresse! Keine gültige E-Mailadresse";
			emailR.title = "Fehler bei E-Mailadresse! Keine gültige E-Mailadresse";
		}
		email.className = "inputError";
		emailR.className = "inputError";
		ret = false;
	}
	
	if(checkPwd){
		if (password.value != passwordR.value){
			if(language == "en"){
				password.title = "Password error! Entries don't match";
				passwordR.title = "Password error! Entries don't match";
			}else{
				password.title = "Fehler beim Passwort! Einträge stimmen nicht überein";
				passwordR.title = "Fehler beim Passwort! Einträge stimmen nicht überein";
			}
			password.className = "inputError";
			passwordR.className = "inputError";
			ret = false;
		}else if(!password.value.match(/^[\S]{6,20}$/)){
			if(language == "en"){
				password.title = "Password error! Must be between 6 to 20 characters";
				passwordR.title = "Password error! Must be between 6 to 20 characters";
			}else{
				password.title = "Fehler beim Passwort! Muss zwischen 6 bis 20 Zeichen lang sein";
				passwordR.title = "Fehler beim Passwort! Muss zwischen 6 bis 20 Zeichen lang sein";
			}
			password.className = "inputError";
			passwordR.className = "inputError";
			ret = false;
		}
	}

	return ret;
}