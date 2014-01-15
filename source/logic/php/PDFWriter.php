<?php 
	require('logic/libraries/fpdf17/fpdf.php');
	class PDFWriter extends FPDF 
	{
		function Header() 
		{
			$this->Image('resources/design/header.png', $this->lMargin, 2, 25, 16);
			$this->SetFont('Arial', 'B', 20);
			$this->SetXY($this->lMargin, 5);
			$this->Cell(0, 0, 'Title', 0, 1, 'C');
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
		public function set_default_config()
		{
			$this->AliasNbPages('#p');
			$this->SetAutoPageBreak(true, 50);
			$this->AddPage();
			$this->SetFont('Times', '', 12);
		}
		public function write_line($linestring)
		{
			$this->Cell(0, 10, $linestring, 0, 1);
		}
		public function save()
		{
			$this->Output();	
		}
	}
?>