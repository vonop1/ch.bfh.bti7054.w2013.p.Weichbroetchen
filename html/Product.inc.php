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
		
		/**
		 * constructor
		 * @param mysqli $product from database
		 * @param string $lang language to display (de or en)
		 * @param string array $select items for selectlist
		 * @param string array $check items for checkboxes
		 * @param string array $radio items for radiobuttons
		 */
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
			$this->price = $product->prize;
			
		}
		

		/**
		 * display product info's
		 */
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
			$priceString = 'Fr. '.number_format($this->price, 2,".","'");
			echo "<p>$priceString</p>";
			
			echo "<form action =\"html/AddToCart.php\" method=\"post\">";
			makeSelection("select", $this->select, $textSelect);	// if a select array exist show the list
			makeCheckboxes($this->check, $textCheck);				// if a checkbox array exist show the boxes
			makeRadio("radio", $this->radio, $textRadio);			// if a radio-button array exist show the buttons
			echo "<input type=\"hidden\" name=\"id\" value=\"$this->id\">";
			echo "<br/><input type=\"submit\" value=\"$textAddToCart\"/>";
			echo "</form>";
		}
		
	}
?>