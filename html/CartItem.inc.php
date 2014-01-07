<?php

class CartItem
{
	private $prodId = 0;
	private $extensions = array();
	private $price = 0;

	//Konstruktor
	public function __construct($product, $extensions)
	{		
		$this->prodId = $product;
		$this->extensions = $extensions;

		$prodDB = new ProductDB();
		$res = $prodDB->getProduct($product);
		$prod = $res->fetch_object();
		$totalPrice = $prod->prize;
		foreach ($extensions as $extension)
		{
			$res = $prodDB->getExtension($extension);
			if ($ext = $res->fetch_object())
			{
				$price = $ext->prize;
				if ($price > 0)
				{
					$totalPrice += $price;
				}
			}
		}
		$this->price = $totalPrice;
			
	}
	
	/**
	 * displays the cartitem with extension
	 */
	public function display ()
	{
		$prodDB = new ProductDB();
		$res = $prodDB->getProduct($this->prodId);
		
		if ($prod = $res->fetch_object())
		{
			$text = "text_". getLanguage();
			$totalPrice = $prod->prize;
			echo '<div>';
			echo '<h2>';
			echo $prod->$text;
			echo '</h2>';
			echo '<div class="cartitem">';
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
			$priceString = 'Fr. '.number_format($this->getPrice(), 2,".","'");
			echo $priceString;
			echo '</div>'; 
			echo '</div>';
		}
				
	}
	
	/**
	 * returns the price for the product with extensions
	 * @return number price of product
	 */
	public function getPrice ()
	{
		return $this->price;
	}

	/**
	 * displays the cartitem with extension
	 */
	public function printCartItem ($pdf)
	{
		$prodDB = new ProductDB();
		$res = $prodDB->getProduct($this->prodId);
	
		if ($prod = $res->fetch_object())
		{
			$text = "text_". getLanguage();
			$totalPrice = $prod->prize;
			$pdf->Cell(0,10,$prod->$text); 
  			$pdf->Ln(); 
			foreach ($this->extensions as $extension)
			{
				$res = $prodDB->getExtension($extension);
				if ($ext = $res->fetch_object())
				{
		 			$pdf->SetFont('Arial', 'B' ,12); // 'B' = Bold 
		 			$pdf->SetFont('');
					$pdf->Cell(0, 0,$ext->$text); 
  					$pdf->Ln(); 
				}
			}
			$priceString = 'Fr. '.number_format($this->getPrice(), 2,".","'");
			$pdf->Cell(0,10,$priceString); 
  			$pdf->Ln(); 
		}
	
	}
}
?>