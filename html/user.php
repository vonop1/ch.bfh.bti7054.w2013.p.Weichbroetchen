<?php
include_once ('functions.php');

// set the language and load texts for choosen language
$language = get_param ( "lang", "de" );
$texts = simplexml_load_file ( "./text/$language.xml" );
$userTexts = $texts->user;

// check if a user is logged in
if (isset ( $_SESSION ["user"] )) {
	echo "<p>Hello " . $_SESSION ["user"] . "</p>";
	$userLink = $userTexts->LogoutLink;
} else {
	$userLink = $userTexts->LoginLink;
}

echo '<ul>';

// 100 Offset to identify non product ids
echo '<li class="user">';
echo "<a href=\"" . changeUrl ( array (
		"idMain" => 100,
		"idSec" => 0 
) ) . "\">";
echo $userLink;
echo "</a>";
echo '</li>';
echo '<li class="user">';
echo "<a href=\"" . changeUrl ( array (
		"idMain" => 101,
		"idSec" => 0 
) ) . "\">";
echo "$userTexts->RegistrationLink";
echo "</a>";
echo '</li>';
echo '<li class="user">';
echo "<a href=\"" . changeUrl ( array (
		"idMain" => 102,
		"idSec" => 0 
) ) . "\">";
echo "$userTexts->Cart";
echo "</a>";
echo '</li>';
echo '</ul>';
?>