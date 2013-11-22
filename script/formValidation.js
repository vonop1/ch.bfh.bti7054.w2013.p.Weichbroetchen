function validateForm(){
	var firstname = document.getElementById("firstname");
	if (firstname == "") {
	    //alert("Bitte Ihren Namen eingeben!");
	    document.Registration.firstname.focus();
	    document.Registration.firstname.value = "Bitte Ihren Namen eingeben!";
	    return false;
	}
}