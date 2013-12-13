<?php
	class Product
	{
		private $id = 0;
		private $prodName = "";
		private $price = 0;
		private $image = "";
		private $select = null;
		private $check = null;
		private $radio = null;
		
		//Konstruktor
		public function __construct($product, $lang)
		{
			$text = "text_$lang";
			$this->id = $product->prodId;
			$this->prodName = $product->$text;
			$this->image = $product->Image;
			
		}
		

		//show Product Info
		public function display() {
			$textAddToCart = "Zum Warenkorb hinzufügen";
			$textSelect = "";
			$textRadio = "";
			$textCheck ="";
			
			echo "<h2>".$this->prodName."</h2>";
			echo "<img src=\"$this->image\" alt=\"$this->image\" class=\"content\"/>";
			
			echo "<form action =\"html/AddToCart.php\" method=\"post\">";
			makeSelection("selcect", $this->select, $textSelect);	// Wenn vorhanden select Array als Auswahlliste anzeigen
			makeCheckboxes($this->check, $textCheck);				// Wenn vorhanden check Array als Checkboxen ausgeben
			makeRadio("radio", $this->radio, $textRadio);			// Wenn vorhanden radio Array als Radio buttons ausgeben
			echo "<input type=\"hidden\" name=\"id\" value=\"$this->id\">";
			echo "<br/><input type=\"submit\" value=\"$textAddToCart\"/>";
			echo "</form>";
		}
		
	}
?>