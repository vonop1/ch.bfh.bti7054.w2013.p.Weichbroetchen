<?php
/**
 * MySQL functions for UserDB
 * @author pvonow
 *
 */
class UserDB extends mysqli {
	
	/**
	 * get all users from database
	 */
	public function getAllUsers() {
		return $this->query ( "SELECT * FROM user");
	}
	
	/**
	 * get all data for a specific user from database
	 * @param unknown $username the user to get the data from
	 */
	public function getSpecificUser($username) {
		$query = "SELECT * FROM user WHERE Username = '$username'";
		return $this->query($query);
	}
	
	/**
	 * create new user in database with given data
	 * @param unknown $username
	 * @param unknown $password
	 * @param unknown $firstname
	 * @param unknown $lastname
	 * @param unknown $street
	 * @param unknown $streetNo
	 * @param unknown $zip
	 * @param unknown $city
	 * @param unknown $phone
	 * @param unknown $email
	 */
	public function insertUser($username, $password, $firstname, $lastname, $street, $streetNo, $zip, $city, $phone, $email) {
		$query = "INSERT INTO user (Username, Password, Firstname, Lastname, Street, StreetNo, ZIP, City, Phone, Email) VALUES ('$username', '$password', '$firstname', '$lastname', '$street', '$streetNo', '$zip', '$city', '$phone', '$email')";
		$this->query($query);
	}
	
	/**
	 * create a new db connection
	 */
	function __construct() {
		parent::__construct ( "localhost", "root", "" );
		parent::select_db ( "webshop" );
	}
	
	/**
	 * end db connection
	 */
	function __destruct() {
		parent::close ();
	}
}

?>