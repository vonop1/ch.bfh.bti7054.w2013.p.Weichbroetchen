<?php

class CartItem
{
	private $prodId = 0;
	private $extensions = array();
	private $price = 0;

	//Konstruktor
	public function __construct($product, $extension)
	{
		$this->prodId = $product;
		$this->extensions = $extension;
			
	}
	
	public function display ()
	{
		$prodDB = new ProductDB();
		$res = $prodDB->getProduct($this->prodId);
		
		if ($prod = $res->fetch_object())
		{
			$text = "text_". get_Param("lang","de");
			echo '<div>';
			echo '<h2>';
			echo $prod->$text;
			echo '</h2>';
			foreach ($this->extensions as $extension)
			{
				$res = $prodDB->getExtension($extension);
				if ($ext = $res->fetch_object())
				{
					$text = "text_". get_Param("lang","de");
					echo '<li>';
					echo $ext->$text;
					echo '</li>';
				}
			}
			echo '</div>';
		}
				
	}
}
?>