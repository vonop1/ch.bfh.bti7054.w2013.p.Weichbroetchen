<?php
	require_once ('fpdf.php');
	
	class pdfCart extends FPDF
	{ 
		function Header() 
		{
			$language = getLanguage();
			$texts = simplexml_load_file("../text/$language.xml");
			$userTexts = $texts->user;
	      	//$this->Image('logo.png', $this->lMargin, 2, 25, 16); 
	      	$this->SetFont('Arial', 'B', 20); 
	      	$this->Cell(0, 0, $userTexts->Cart, 0, 1, 'C'); 
	      	$this->SetLineWidth(0.1); 
	     	$this->Line(0, 20, $this->w, 20); 
	      	$this->SetY(30); 
		}
		
		function Footer() {
			$this->SetFont('Arial','B',8);
			$this->SetXY(0,-15);
			$this->Cell(0, 10,
					'Page '.$this->PageNo().'/#p',0,1,'R');
		}
    } 
		
?>