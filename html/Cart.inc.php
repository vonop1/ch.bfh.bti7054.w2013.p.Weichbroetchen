<?php
	require ('fpdf.php');
	
	class Cart {

		private $items = array();
		private $counter = 1;
		
		//add a item to the session bassed card
		public function addItem($item) {
			$this->items[$this->counter] = $item;
			$this->counter++;
		}
		
		//remove a item from card
		public function removeItem() {
			if (isset($this->items[$item])) 
			{ 
				unset($this->items[$item]);
				return true;
			}
			else return false;
		}
		
		/**
		 * generate HTML-code to display the shopping-cart
		 */
		public function display() {
			$language = getLanguage();
			$texts = simplexml_load_file("./text/$language.xml");
			$userTexts = $texts->user;
			$cartTexts = $texts->cart;
			echo "<h1>$userTexts->Cart</h1>";
			foreach ($this->items as $key=>$item)
			{
				$item->display();
			}
			$priceString = 'Fr. '.number_format($this->calcPrice(), 2,".","'");
			echo "<p class=\"cartitem\">Total: $priceString</p>";
			$confirmText =$cartTexts->confirm;
			echo "<form name=\"finishOrder\" action=\"html/FinishOrder.php\" onsubmit=\"return confirm('$cartTexts->confirm')\">";
			echo "<input type=\"submit\" value=\"$cartTexts->send\"/>";
			echo "</form>";
		}
		
		/**
		 * calc the price of the hole Cart
		 * @return number
		 */
		public function calcPrice()
		{
			$total = 0;
			foreach ($this->items as $item)
			{
				$total += $item->getPrice();
			}
			return $total;
		}

		/**
		 * generate HTML-code to display the shopping-cart
		 */
		public function printCart() 
		{

			$pdf=new pdfCart('P','mm','A4'); // 'P' = Portrait
			$pdf->AliasNbPages('#p');
			$pdf->SetAutoPageBreak(true,50);
		 	$pdf->AddPage(); 
		 	$pdf->SetFont('Arial','B',16); // 'B' = Bold 
			foreach ($this->items as $key=>$item)
			{
				$item->printCartItem($pdf);
			}
		 	$pdf->Output("test.pdf","I"); 
		}
	}
?>