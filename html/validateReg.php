<?php
include_once ('functions.php');

//check that all POST variables have been set
if (!isset($_POST['method']) || !isset($_POST['value'])){
	exit;
}

//get values
$method = $_POST['method'];
$value = utf8_decode($_POST['value']);
$extraVal = $_POST['extraVal'];

//load texts for choosen language
$texts = simplexml_load_file("../text/$language.xml");
$errorTexts = $texts->registration->errors;

//temp variable for regex
$regex = "^$";

//check forms with regex and set error message
switch($method){
	case "usernameCheck":
		$regex = "/^[A-Za-z]+[A-Za-z0-9]*$/";
		if (!preg_match($regex, $value)){
			echo $errorTexts->username;
		}
		break;
	case "firstnameCheck":
		$regex = "/^[a-zA-Z������������]{2,}$/";
		if (!preg_match($regex, $value)){
			echo $errorTexts->firstname;
		}
		break;
	case "lastnameCheck":
		$regex = "/^[a-zA-Z������������]{1}[a-zA-Z������������ ]{1,}$/";
		if (!preg_match($regex, $value)){
			echo $errorTexts->lastname;
		}
		break;
	case "streetCheck":
		$regex = "/^[A-Z���a-z���]+$/";
		if (!preg_match($regex, $value)){
			echo $errorTexts->street;
		}
		break;
	case "streetNoCheck":
		$regex = "/^[0-9A-Za-z]*$/";
		if (!preg_match($regex, $value)){
			echo $errorTexts->streetNo;
		}
		break;
	case "zipCheck":
		$regex = "/^[1-9]{1}\d{3}$/";
		if (!preg_match($regex, $value)){
			echo $errorTexts->zip;
		}
		break;
	case "cityCheck":
		$regex = "/^[A-Z���a-z��� ]{2,}$/";
		if (!preg_match($regex, $value)){
			echo $errorTexts->city;
		}
		break;
	case "phoneCheck":
		$regex = "/^\+\d{2} \d{2} \d{3} \d{2} \d{2}$/";
		if (!preg_match($regex, $value)){
			echo $errorTexts->phone;
		}
		break;
	case "emailCheck":
		$regex = "/^[A-Za-z0-9\._%\+-]+@[A-Za-z0-9\.-]+\.[A-Za-z]{2,4}$/";
		if (!preg_match($regex, $value)){
			echo $errorTexts->email;
		}
		break;
	case "emailRCheck":
		if ($value != $extraVal){
			echo $errorTexts->emailR;
		}
		break;
	case "passwordCheck":
		$regex = "/^[\S]{6,20}$/";
		if (!preg_match($regex, $value)){
			echo $errorTexts->password;
		}
		break;
	case "passwordRCheck":
		if ($value != $extraVal){
			echo $errorTexts->passwordR;
		}
		break;
	default:
		echo "Default";
		exit;
}

?>