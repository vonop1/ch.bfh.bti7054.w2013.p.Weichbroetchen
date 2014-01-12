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
	 * constructor for user class, normally use helper functions
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
	
	public function display($method, $texts, $language) {
		
		// set title texts
		$titleTexts = $texts->titles;
		$userRegTitle = $titleTexts->userReg;
		$finishTitle = $titleTexts->finish;
		
		// set input field texts
		$formTexts = $texts->form;
		
		// set button texts
		$buttonTexts = $texts->buttons;
		$submitValue = $buttonTexts->send;
		$resetValue = utf8_decode($buttonTexts->reset);
		
		// set input field length and accesskey
		$inputSize = 50;
		$accesskey = 1;
		
		//set template
		$template = '<form name="input" action="" onsubmit="return validateForm()" method="post">';
		$template .= '<fieldset>';
		$template .= '<legend>' . $userRegTitle . '</legend>';
		foreach ( $formTexts->children () as $child ) {
			$childName = $child->getName ();
			if($method == "registration" || ($childName != "password" && $childName != "passwordR")){
				$template .= '<label class="registration" accesskey="' . $accesskey . '" for="' . $childName . '">' . $child . '</label>';
			}
			if (($childName == "password" || $childName == "passwordR") && $method == "registration") {
				$template .= '<input type="password" id="' . $childName . '" name="' . $childName . '" size="' . $inputSize . '" class="input" onmouseup="checkIfEmpty(this.value, this.id);" onkeyup="checkIfEmpty(this.value, this.id);" onchange="callAjax(\'' .$childName. 'Check\', this.value, this.id);"></input>';
			} elseif ($method == "account" && $childName == "username"){
				$template .= '<input id="' . $childName . '" name="' . $childName . '" size="' . $inputSize . '" value="@' .$childName. '@" class="input" disabled="disabled"></input>';
			}elseif($childName != "password" && $childName != "passwordR") {
				$template .= '<input id="' . $childName . '" name="' . $childName . '" size="' . $inputSize . '" value="@' .$childName. '@" class="input" onmouseup="checkIfEmpty(this.value, this.id);" onkeyup="checkIfEmpty(this.value, this.id);" onchange="callAjax(\'' .$childName. 'Check\', this.value, this.id);"></input>';
			}
			$template .= '<div id="' .$childName. 'Rsp" class="errorMsg"></div>';
			$accesskey ++;
		}
		$template .= '<input id="lang" type="hidden" value="' . $language . '"></input>';
		$template .= '</fieldset>';
		$template .= '<br></br>';
		$template .= '<fieldset>';
		$template .= '<legend>' . $finishTitle . '</legend>';
		$template .= '<input class="buttons" id="submit" name="submit" type="submit" value="' . $submitValue . '" disabled="disabled"></input>';
		$template .= '<input class="buttons" id="reset" type="reset" value="' . $resetValue . '"></input>';
		$template .= '</fieldset>';
		$template .= '</form>';
		
		//replace placeholder in template with actual values
		$template = str_replace("@username@", $this->username, $template);
		$template = str_replace("@firstname@", $this->firstname, $template);
		$template = str_replace("@lastname@", $this->lastname, $template);
		$template = str_replace("@street@", $this->street, $template);
		$template = str_replace("@streetNo@", $this->streetNo, $template);
		$template = str_replace("@zip@", $this->zip, $template);
		$template = str_replace("@city@", $this->city, $template);
		$template = str_replace("@phone@", $this->phone, $template);
		$template = str_replace("@email@", $this->email, $template);
		$template = str_replace("@emailR@", $this->email, $template);
		echo $template;
		
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
	
	public function updateUserData($firstname, $lastname, $street, $streetNo, $zip, $city, $phone, $email){
		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->street = $street;
		$this->streetNo = $streetNo;
		$this->zip = $zip;
		$this->city = $city;
		$this->phone = $phone;
		$this->email = $email;
		
		//new user db connection
		$userDB = new UserDB();
		
		//update user data in db
		$userDB->updateUser($this->username, $this->password, $this->firstname, $this->lastname, $this->street, $this->streetNo, $this->zip, $this->city, $this->phone, $this->email);
	}
	
	/**
	 * Getter for username
	 * @return string the username
	 */
	public function getUsername(){
		return $this->username;
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