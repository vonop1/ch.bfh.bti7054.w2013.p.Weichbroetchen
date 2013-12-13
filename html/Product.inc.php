<?php
	class Product
	{
		private $id = 0;
		private $prodName = "";
		private $price = 0;
		private $image = "";
		private $select = array();
		private $check = array();
		private $radio = null;
		private $lang = "de";
		
		//Konstruktor
		public function __construct($product, $lang, $select, $check, $radio)
		{
			$this->lang = $lang;
			$text = "text_$lang";
			$this->id = $product->prodId;
			$text = "text_$lang";
			$this->prodName = $product->$text;
			$this->image = $product->Image;
			$this->select = $select;
			$this->radio = $radio;
			$this->check = $check;
			
		}
		

		//show Product Info
		public function display() {
			//load text elements from XML
			$texts = simplexml_load_file("./text/$this->lang.xml");
			$contenttexts = $texts->content;
			$textAddToCart = utf8_decode($contenttexts->AddToCart);
			$textSelect = utf8_decode($contenttexts->ChooseSauce);
			$textRadio = utf8_decode($contenttexts->ChooseSize);
			$textCheck = utf8_decode($contenttexts->ChooseExtra);
			
			echo "<h2>".$this->prodName."</h2>";
			echo "<img src=\"$this->image\" alt=\"$this->image\" class=\"content\"/>";
			
			echo "<form action =\"html/AddToCart.php\" method=\"post\">";
			makeSelection("select", $this->select, $textSelect);	// Wenn vorhanden select Array als Auswahlliste anzeigen
			makeCheckboxes($this->check, $textCheck);				// Wenn vorhanden check Array als Checkboxen ausgeben
			makeRadio("radio", $this->radio, $textRadio);			// Wenn vorhanden radio Array als Radio buttons ausgeben
			echo "<input type=\"hidden\" name=\"id\" value=\"$this->id\">";
			echo "<br/><input type=\"submit\" value=\"$textAddToCart\"/>";
			echo "</form>";
		}
		
	}
?>