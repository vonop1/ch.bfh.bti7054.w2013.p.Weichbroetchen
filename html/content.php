<?php
		
	//generiert HTML Code f�r Content Area
	function createContent()
	{
		global $id;
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
		
		echo "<form action =\"html/AddToCart.php\" method=\"post\">";
		makeSelection("selcect", $select, $textSelect);	// Wenn vorhanden select Array als Auswahlliste anzeigen
		makeCheckboxes($check, $textCheck);				// Wenn vorhanden check Array als Checkboxen ausgeben
		makeRadio("radio", $radio, $textRadio);			// Wenn vorhanden radio Array als Radio buttons ausgeben
		echo "<input type=\"hidden\" name=\"id\" value=\"$id\">";
		echo "<br/><input type=\"submit\" value=\"$textAddToCart\"/>";
		echo "</form>";
		
	}
	

	$idMain = (get_param("idMain", 0));
	$textSelect =  "W�hlen sie Ihre Sauce :";
	$id = 0;
	switch ($idMain)
	{
		case 0:
			$id = 1;
			$title = "Hamburger";
			$image = "images/hamburger.jpg";
			$select = array("Ketchup", "Senf", "Barbacue", "Weichbr�tchen Spezial");
			$check = array("Speck","Extra K�se", "Zusatz Sauce");
			$textCheck = "W�hlen sie Ihre Zus�tze :";
			createContent();
			break;
		case 1:
			$id = 2;
			$title = "Gr�ner Salat";
			$image = "images/salat.jpg";
			$select = array("French Dressing", "Italian Dressing");
			createContent();
			break;
		case 2:
			$id = 3;
			$title = "Cola";
			$image = "images/cola.jpg";
			$radio = array ("3dl", "4dl", "5dl");
			$textRadio = "W�hlen sie die gew�nschte Gr�sse:";
			createContent();
			break;
		case 100:
			// Registrierung
			include_once 'registration.php';
		case 101: 
			// Login
			include_once 'user.php';
	
	}
?>