function validateForm(){
	var firstname = document.getElementById("firstname").value;
	if (firstname == "") {
	    //alert("Bitte Ihren Namen eingeben!");
	    document.getElementById("firstname").focus();
	    document.getElementById("firstname").value = "Bitte Ihren Namen eingeben!";
	    return false;
	}
}