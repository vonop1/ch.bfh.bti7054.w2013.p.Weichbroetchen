<?php
include_once ('functions.php');

//check that all POST variables have been set
if (!isset($_POST['method']) || !isset($_POST['value'])){
	exit;
}

//get values
$method = $_POST['method'];
$value = rawurldecode($_POST['value']);
$extraVal = rawurldecode($_POST['extraVal']);

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
		$regex = "/^[A-ZִײÜa-zהצüיטאח]{2,}$/";
		if (!preg_match($regex, $value)){
			echo $errorTexts->firstname;
		}
		break;
	case "lastnameCheck":
		$regex = "/^[A-ZִײÜa-zהצüיטאח]{1}[A-ZִײÜa-zהצüיטאח ]{1,}$/";
		if (!preg_match($regex, $value)){
			echo $errorTexts->lastname;
		}
		break;
	case "streetCheck":
		$regex = "/^[A-ZִײÜa-zהצü]+$/";
		if (!preg_match($regex, $value)){
			echo $errorTexts->street;
		}
		break;
	case "streetNumberCheck":
		$regex = "/^[0-9A-Za-z]*$/";
		if (!preg_match($regex, $value)){
			echo $errorTexts->streetNumber;
		}
		break;
	case "ZIPCheck":
		$regex = "/^[1-9]{1}\d{3}$/";
		if (!preg_match($regex, $value)){
			echo $errorTexts->ZIP;
		}
		break;
	case "cityCheck":
		$regex = "/^[A-ZִײÜa-zהצü ]{2,}$/";
		if (!preg_match($regex, $value)){
			echo $errorTexts->city;
		}
		break;
	case "phoneCheck":
		$regex = "/^\+\d{2}[ ]{1}\d{2}[ ]{1}\d{3}[ ]{1}\d{2}[ ]{1}\d{2}$/";
		if (!preg_match($regex, $value)){
			$errorTexts->phone;
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