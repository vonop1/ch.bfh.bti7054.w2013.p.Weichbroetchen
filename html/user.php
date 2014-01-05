<?php
include_once ('functions.php');

// set the language and load texts for choosen language
$language = get_param ("lang", "de");
$texts = simplexml_load_file("./text/$language.xml");
$userTexts = $texts->user;

// check if a user is logged in and set user links, 100 Offset to identify non product ids
if (isset ( $_SESSION ["user"] )) {
	echo '<p id="greeting">' .$userTexts->Greeting. ' <b>' .$_SESSION["user"]. '</b></p>';
	echo '<ul>';
	echo '<li class="user"><a href="' .changeUrl(array("idMain" => 100, "idSec" => 0)). '">' .$userTexts->LogoutLink. '</a></li>';
	echo '<li class="user"><a href="' .changeUrl(array("idMain" => 102, "idSec" => 0)). '">' .$userTexts->Cart. '</a></li>';
	echo '<li class="user"><a href="' .changeUrl(array("idMain" => 103, "idSec" => 0)). '">' .$userTexts->Account. '</a></li>';
	echo '</ul>';
}else{
	echo '<ul>';
	echo '<li class="user"><a href="' .changeUrl(array("idMain" => 101, "idSec" => 0)). '">' .$userTexts->RegistrationLink. '</a></li>';
	echo '<li class="user"><a href="' .changeUrl(array("idMain" => 100, "idSec" => 0)). '">' .$userTexts->LoginLink. '</a></li>';
	echo '</ul>';
}

?>