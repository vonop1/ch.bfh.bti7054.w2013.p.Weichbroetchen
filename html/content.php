<?php
		
	//generiert HTML Code für Content Area
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
		$textAddToCart = "Zum Warenkorb hinzufügen";
		
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
	$idSec = (get_param("idSec", 1));
	$textSelect =  "Wählen sie Ihre Sauce :";
	$id = 0;
	$prodcutDb = new ProductDB();
	switch ($idMain)
	{
		case 0:
			$lang = get_param("lang", "de");
			$select = array("Ketchup", "Senf", "Barbacue", "Weichbrötchen Spezial");
			$check = array("Speck","Extra Käse", "Zusatz Sauce");
			$textCheck = "Wählen sie Ihre Zusätze :";
			//createContent();
			$res = $prodcutDb->getProduct($idSec);
			$select = $prodcutDb->getProductSelectExt($idSec, $lang);
			$prod = new Product($res->fetch_object(), $lang, $select);
			$prod->display();
			break;
		case 1:
			$id = 2;
			$title = "Grüner Salat";
			$image = "images/salat.jpg";
			$select = array("French Dressing", "Italian Dressing");
			createContent();
			break;
		case 2:
			$id = 3;
			$title = "Cola";
			$image = "images/cola.jpg";
			$radio = array ("3dl", "4dl", "5dl");
			$textRadio = "Wählen sie die gewünschte Grösse:";
			createContent();
			break;
		case 100: 
			// Login
			include_once 'login.php';
			break;
		case 101:
			// Registrierung
			include_once 'registration.php';
			break;
	
	}
?>