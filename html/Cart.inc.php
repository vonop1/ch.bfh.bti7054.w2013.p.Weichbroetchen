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
			echo "<table border=\"1\">";
			echo "<tr><th>Article</th><th>Items</th></tr>";
			foreach ($this->items as $item)
			{
				echo "<tr>$item->display()</tr>";
			}
			echo "</table>";
		}
	}
?>