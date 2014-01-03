<?php
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
		
		//show Shopping Card
		public function display() {
			$language = get_param("lang", "de");
			$texts = simplexml_load_file("./text/$language.xml");
			$userTexts = $texts->user;
			echo "<h1>$userTexts->Cart</h1>";
			foreach ($this->items as $key=>$item)
			{
				$item->display();
			}
			$priceString = 'Fr. '.number_format($this->calcPrice(), 2,".","'");
			echo "<p class=\"cartitem\">Total: $priceString</p>";
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
	}
?>