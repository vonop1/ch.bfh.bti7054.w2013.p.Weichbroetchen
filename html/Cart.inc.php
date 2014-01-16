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
		public function removeItem($item) {
			if (isset($this->items[$item])) 
			{ 
				unset($this->items[$item]);
				return true;
			}
			else return false;
		}

		//remove all items form cart
		public function clearCart() {
			unset($this->items);
			$this->counter = 1;
		}
		
		/**
		 * generate HTML-code to display the shopping-cart
		 */
		public function display() {
			$language = getLanguage();
			$texts = simplexml_load_file("./text/$language.xml");
			$userTexts = $texts->user;
			$cartTexts = $texts->cart;
			$removeText = utf8_decode($cartTexts->remove);
			echo "<h1>$userTexts->Cart</h1>";
			foreach ($this->items as $key=>$item)
			{
				$item->display();

				echo "<form action =\"\" method=\"post\">";
				echo "<input type=\"hidden\" name=\"itemToRemove\" value=\"$key\">";
				echo "<br/><input type=\"submit\" value=\"$removeText\"/>";
				echo "</form>";
			}
			$priceString = 'Fr. '.number_format($this->calcPrice(), 2,".","'");
			echo "<p class=\"cartitem\">Total: $priceString</p>";
			echo "<form name=\"finishOrder\"  method=\"post\" onSubmit=\"return confirmOrder('$cartTexts->confirm');\" action=\"\" >";
			echo "<input type=\"hidden\" name=\"order\" value=\"1\">";
			echo "<input type=\"submit\" value=\"$cartTexts->send\"/>";
			echo "<input type=\"button\" onclick=\"openPdf();\" value=\"$cartTexts->print\"/>";
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
			$pdf->SetFont('Arial','B',14); // 'B' = Bold
			$priceString = 'Total : Fr. '.number_format($this->calcPrice(), 2,".","'");
			$pdf->Cell(0,10,$priceString); 
		 	$pdf->Output("test.pdf","I"); 
		}
	}
?>