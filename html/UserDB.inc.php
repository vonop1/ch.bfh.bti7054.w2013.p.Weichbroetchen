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
	 * @param string $username the user to get the data from
	 */
	public function getSpecificUser($username) {
		$query = "SELECT * FROM user WHERE Username = '$username'";
		return $this->query($query);
	}
	
	/**
	 * create new user in database with given data
	 * @param string $username
	 * @param string $password
	 * @param string $firstname
	 * @param string $lastname
	 * @param string $street
	 * @param string $streetNo
	 * @param string $zip
	 * @param string $city
	 * @param string $phone
	 * @param string $email
	 */
	public function insertUser($username, $password, $firstname, $lastname, $street, $streetNo, $zip, $city, $phone, $email) {
		$query = "INSERT INTO user (Username, Password, Firstname, Lastname, Street, StreetNo, ZIP, City, Phone, Email) VALUES ('$username', '$password', '$firstname', '$lastname', '$street', '$streetNo', '$zip', '$city', '$phone', '$email')";
		$this->query($query);
	}
	
	/**
	 * updates user in database with given data
	 * @param string $username
	 * @param string $password
	 * @param string $firstname
	 * @param string $lastname
	 * @param string $street
	 * @param string $streetNo
	 * @param string $zip
	 * @param string $city
	 * @param string $phone
	 * @param string $email
	 */
	public function updateUser($username, $password, $firstname, $lastname, $street, $streetNo, $zip, $city, $phone, $email) {
		$query = "UPDATE user SET Username='$username',Password='$password',Firstname='$firstname',Lastname='$lastname',Street='$street',StreetNo='$streetNo',ZIP='$zip',City='$city',Phone='$phone',Email='$email' WHERE Username='$username'";
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