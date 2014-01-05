<?php

class User{
	private	$username = "";
	private $firstname = "";
	private $lastname = "";
	private $street = "";
	private $streetNo = "";
	private $zip = "";
	private $city = "";
	private $phone = "";
	private $email = "";
	private $password = "";
	private $userRegError = FALSE;
	
	/**
	 * constructor for user class, not indended to call directly, use helper functions instead
	 */
	public function __construct(){}

	/**
	 * helper function for constructor, to create a new instance with a username
	 * @param string $username the username of the user
	 * @return User a new user class instance
	 */
	public static function withUsername($username){
		$instance = new self();
		$instance->loadByUsername($username);
		return $instance;
	}

	/**
	 * helper function for constructor, to create a new instance with an array
	 * @param array $row the array with a set of user data
	 * @return User a new user class instance
	 */
	public static function withRow(array $row){
		$instance = new self();
		$instance->fill($row);
		return $instance;
	}
	
	/**
	 * helper function to load data from a specific user
	 * @param string $username
	 */
	protected function loadByUsername($username){
		$userDB = new UserDB();
		$query = $userDB->getSpecificUser(strtolower($username));
		$row = $query->fetch_object();
		$row = (array) $row;
		$this->fill($row);
	}
	
	/**
	 * helper function to fill an array into user variables
	 * @param array $row an array row with a set of user data
	 */
	protected function fill(array $row) {
		$this->username = $row['Username'];
		$this->password = $row['Password'];
		$this->firstname = $row['Firstname'];
		$this->lastname = $row['Lastname'];
		$this->street = $row['Street'];
		$this->streetNo = $row['StreetNo'];
		$this->zip = $row['ZIP'];
		$this->city = $row['City'];
		$this->phone = $row['Phone'];
		$this->email = $row['Email'];
	}
	
	public function display() {
		
	}
	
	/**
	 * creates a new user in database
	 */
	public function createUser(){
		//new user db connection
		$userDB = new UserDB();
		
		//check if user already exists in database, if set error to true, else create new user
		$query = $userDB->getSpecificUser(strtolower($this->username));
		if($query->num_rows == 0){
			$userDB->insertUser($this->username, $this->password, $this->firstname, $this->lastname, $this->street, $this->streetNo, $this->zip, $this->city, $this->phone, $this->email);
		}else{
			$this->userRegError=TRUE;
		}	
	}
	
	/**
	 * Getter for registration error userRegError
	 * @return boolean True if there was an error.
	 */
	public function getRegError(){
		return $this->userRegError;
	}
}
?>