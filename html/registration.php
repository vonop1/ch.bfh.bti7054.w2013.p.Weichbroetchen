<?php
	include_once ('functions.php');
	
	//set the language and load texts for choosen language
	$language = get_param("lang", "de");
	$texts = simplexml_load_file("./text/$language.xml");
	$registrationTexts = $texts->registration;
	
	//set title texts
	$titleTexts = $registrationTexts->titles;
	$mainTitle = $titleTexts->main;
	$userRegTitle = $titleTexts->userReg;
	$finishTitle = $titleTexts->finish;
	
	//set input field texts
	$formTexts = $registrationTexts->form;
	
	//set button texts
	$buttonTexts = $registrationTexts->buttons;
	$submitValue = $buttonTexts->send;
	$resetValue = utf8_decode($buttonTexts->reset);
	
	//set input field length
	$inputSize = 50;
	
	//create html content
	echo '<h2>' .$mainTitle. '</h2>';
	echo '<form action ="evaluateReg.php" onsubmit="return validateForm()" method="post">';
	echo '<fieldset class="registration">';
	echo '<legend>' .$userRegTitle. '</legend>';
	$accesskey = 1;
	foreach ($formTexts->children() as $child){
		$childName = $child->getName();
		echo '<label accesskey="' .$accesskey. '" for="' .$childName. '">' .$child. '</label>';
		if ($childName == "password" || $childName == "passwordR") {
			echo '<input type="password" id="' .$childName. '" name="' .$childName. '" size="' .$inputSize. '"></input>';
		}else{
			echo '<input id="' .$childName. '" name="' .$childName. '" size="' .$inputSize. '"></input>';
		}
		echo '<br></br>';
		$accesskey++;
	}
	
	echo '</fieldset>';
	echo '<br></br>';
	echo '<fieldset class="buttons">';
	echo '<legend>' .$finishTitle. '</legend>';
	echo '<input id="submit" type="submit" value="' .$submitValue. '"></input>';
	echo '<input id="reset" type="reset" value="' .$resetValue. '"></input>';
	echo '</fieldset>';
	echo '</form>';

?>
