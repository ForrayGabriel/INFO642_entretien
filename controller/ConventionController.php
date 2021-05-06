<?php

class ConventionController extends Controller {

	var $rolepermissions = [1,2,3];

	public function index() {
        require('./components/fpdf.php');
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(40,10,'Hello World !');
		$pdf->Output();
    }
}