<?php
class UserDB extends mysqli {
	public function getAllUsers() {
		return $this->query ( "SELECT * FROM user" );
	}
	public function deleteUser($id) {
		$this->query ( "DELETE FROM user WHERE ID = $id" );
	}
	public function insertUser($username, $password, $firstname, $lastname, $street, $streetNo, $zip, $city, $phone, $email) {
		$this->query ( "INSERT INTO user (Username, Password, Firstname, Lastname, Street, StreetNo, ZIP, City, Phone, Email)  
      semester) VALUES ('$username', '$password', '$firstname', '$lastname', '$street', '$streetNo', '$zip', '$city', '$phone', '$email')" );
	}	
	
	public function updateStudent($id, $lname, $fname, $semes) {
		$this->query ( "UPDATE student SET LastName='$lname', 
      FirstName='$fname', semester='$semes' WHERE ID=$id" );
	}
	function __construct() {
		parent::__construct ( "localhost", "root", "" );
		parent::select_db ( "webshop" );
	}
	function __destruct() {
		parent::close ();
	}
}

?>