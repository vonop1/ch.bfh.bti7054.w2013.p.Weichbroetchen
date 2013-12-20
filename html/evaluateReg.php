<html><body>
<?php

	
	$username = $_POST['username'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$street = $_POST['street'];
	$streetNo = $_POST['streetNumber'];
	$zip = $_POST['zip'];
	$city = $_POST['city'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$userDB = new UserDB();
	$userDB->insertUser($username, $password, $firstname, $lastname, $street, $streetNo, $zip, $city, $phone, $email);
	
?>
</body></html> 
