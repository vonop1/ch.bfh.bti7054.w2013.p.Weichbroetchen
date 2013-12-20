function validateForm(){
	var username = document.getElementById("username").value;
	var firstname = document.getElementById("firstname").value;
	var lastname = document.getElementById("lastname").value;
	var street = document.getElementById("street").value;
	var streetNo = document.getElementById("streetNumber").value;
	var zip = document.getElementById("ZIP").value;
	var city = document.getElementById("city").value;
	var phone = document.getElementById("phone").value;
	var email = document.getElementById("email").value;
	var emailR = document.getElementById("emailR").value;
	var password = document.getElementById("password").value;
	var passwordR = document.getElementById("passwordR").value;
	var ret = true;

	if (!firstname.match(/^[A-ZÄÖÜa-zäöüéèàç]{2,}$/)) {
		document.getElementById("firstname").className = "inputError";
	    document.getElementById("firstname").value = "Bitte Ihren Namen eingeben!";
	    ret = false;
	}
	if (!lastname.match(/^[A-ZÄÖÜa-zäöüéèàç]{2,}[[ ]?[A-ZÄÖÜa-zäöüéèàç]+]*$/)){
	    document.getElementById("lastname").value = "Bitte Ihren Nachnamen eingeben!";
	    ret = false;
	}
	if (!street.match(/^[A-ZÄÖÜa-zäöü]+$/)){
	    document.getElementById("street").value = "Bitte Strasse angeben";
	    ret = false;
	}
	if (!streetNo.match(/^[0-9A-Za-z]*$/)){
	    document.getElementById("streetNumber").value = "Bitte korrekte Hausnummer angeben";
	    ret = false;
	}
	if (!zip.match(/^[1-9]{1}\d{3}$/)){
	    document.getElementById("ZIP").value = "Bitte korrekte PLZ angeben";
	    ret = false;
	}
	if (!city.match(/^[A-ZÄÖÜa-zäöü]{2,}$/)){
	    document.getElementById("city").value = "Bitte Stadt angeben";
	    ret = false;
	}
	if (!phone.match(/^\+\d{2} \d{2} \d{3} \d{2} \d{2}$/)){
	    document.getElementById("phone").value = "Bitte Telefonnummer im Format +41 XX XXX XX XX angeben";
	    ret = false;
	}
	/*
	if (email == emailR){
		if (!email.match(/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i)){
		    document.getElementById("").value = "Bitte E-Mailadresse angeben";
		    ret = false;
		}
	}else{
		document.getElementById("email").value = "Felder stimmen nicht überein";
		ret = false;
	}
	*/
	if (password == passwordR){
		if (!password.match(/^$/)){
		    document.getElementById("").value = "Bitte  angeben";
		    ret = false;
		}
	}else{
		document.getElementById("password").value = "Felder stimmen nicht überein";
		ret = false;
	}

	return ret;
}