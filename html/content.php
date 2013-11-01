<?php
		
	//generiert HTML Code f�r Content Area
	function createContent()
	{
		global $title;
		global $image;
		global $select;
		global $textSelect;
		global $check;
		global $textCheck;
		global $radio;
		global $textRadio;
		$textAddToCart = "Zum Warenkorb hinzuf�gen";
		
		echo "<h2>".$title."</h2>";
		echo "<img src=\"$image\" alt=\"$image\" class=\"content\"/>";
		
		echo "<form action =\"index.php\" method=\"post\">";
		makeSelection("selcect", $select, $textSelect);	// Wenn vorhanden select Array als Auswahlliste anzeigen
		makeCheckboxes($check, $textCheck);				// Wenn vorhanden check Array als Checkboxen ausgeben
		makeRadio("radio", $radio, $textRadio);			// Wenn vorhanden radio Array als Radio buttons ausgeben
		echo "<br/><input type=\"submit\" value=\"$textAddToCart\"/>";
		echo "</form>";
		
	}
	

	$idMain = (get_param("idMain", 0));
	$textSelect =  "W�hlen sie Ihre Sauce :";
	switch ($idMain)
	{
		case 0:
			$title = "Hamburger";
			$image = "images/hamburger.jpg";
			$select = array("Ketchup", "Senf", "Barbacue", "Weichbr�tchen Spezial");
			$check = array("Speck","Extra K�se", "Zusatz Sauce");
			$textCheck = "W�hlen sie Ihre Zus�tze :";
			createContent();
			break;
		case 1:
			$title = "Gr�ner Salat";
			$image = "images/salat.jpg";
			$select = array("French Dressing", "Italian Dressing");
			createContent();
			break;
		case 2:
			$title = "Cola";
			$image = "images/cola.jpg";
			$radio = array ("3dl", "4dl", "5dl");
			$textRadio = "W�hlen sie die gew�nschte Gr�sse:";
			createContent();
			break;
	
	}
?>