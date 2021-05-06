<?php

class ConvocationController extends Controller {

	var $rolepermissions = [1,2,3];

	public function generate() {
        require('./fpdf/fpdf.php');

        id_or_back(parameters());

        $prestation = new Prestation(parameters()['id']);

        if($prestation->idstudent->idinternaluser->idinternaluser != get_id()){
        	go_back();
        }

		$pdf = new FPDF();

		$pdf->AddPage();

		$pdf->SetFont('Arial','B',16);

		$pdf->Image('./images/logo_polytech.png',11,9,49);
		// Police Arial gras 15
		$pdf->SetFont('Arial','B',15);
		// Décalage à droite
		$pdf->Cell(105);
		// Titre
		$pdf->Cell(80,10,'Convocation à une épreuve',1,1,'C');
		// Saut de ligne
		$pdf->Ln(20);


	    // Couleur de fond
	    $pdf->SetFillColor(255,255,255);
	    // Titre
	    $pdf->Cell(0,6,"Convocation pour l'épreuve : ".$prestation->idevent->entitled_event,0,1,'L',true);
	    $pdf->SetLineWidth(.3);
	    // Saut de ligne
	    $pdf->Ln(8);
	    $pdf->SetFont('Arial','',12);
	    $pdf->Cell(0,4,"Bonjour ".$prestation->idstudent->idinternaluser->nom . " " . $prestation->idstudent->idinternaluser->prenom .  
	    	 ", vous avez été convoqué à une épreuve." , 0 ,1,'L',true);
	    $pdf->Ln(4);
	    $pdf->Cell(0,4,"Nom de l'épreuve : " . $prestation->idevent->entitled_event , 0 ,1,'L',true);
	    $pdf->Ln(4);
	    $pdf->Cell(0,4,"Description de l'épreuve : " . $prestation->idevent->description_event , 0 ,1,'L',true);
	   	$pdf->Ln(10);
	   	$pdf->Cell(0,4,"Vous avez rendez-vous le " . date_format(date_create($prestation->date_prestation),'d-m-Y') . " de " . date_format(date_create($prestation->start_time),'H:i') . " à " . date_format(date_create($prestation->end_time),'H:i') . " à l'adresse suivante :",0,0,'L');
	    $pdf->Ln(13);
	   	$pdf->Cell(0,4,"Polytech Annecy-Chambéry site d'Annecy",0,0,'C');
	    $pdf->Ln(7);
	    $pdf->Cell(0,4,"5 Chemin de Bellevue 74940 Annecy",0,0,'C');
	    $pdf->Ln(7);
	    $pdf->Cell(0,4,"Numéro de salle " . $prestation->idjury->idclassroom->name_classroom . " | ". $prestation->idjury->idclassroom->building_classroom,0,0,'C');
	    $pdf->Ln(13);
	    $pdf->Cell(0,4,"Le/la candidat(e) doit se présenter à l’heure et au jour indiqués ci-dessus muni(e) d’une ",0,0,'L');
	    $pdf->Ln(5);
	    $pdf->Cell(0,4,"pièce d’identité et du présent document.",0,0,'L');
	   	$pdf->Ln(10);
	   	$pdf->SetFont('Arial','B',12);
	    $pdf->Cell(0,4,"Pour rappel, votre présence est obligatoire.",0,0,'L');
	    $pdf->Ln(10);
	    $pdf->Cell(0,4,"Absence injustifiée",0,0,'L');
	    $pdf->Ln(5);
	    $pdf->SetFont('Arial','',12);
	    $pdf->Cell(0,4,"En cas d’absence non justifiée d’un candidat à une situation d’évaluation, l’élève se voit attribuer",0,0,'L');
	    $pdf->Ln(5);
	    $pdf->Cell(0,4,"la note zéro par les évaluateurs.",0,0,'L');
	    $pdf->SetFont('Arial','B',12);
	    $pdf->Ln(10);
	    $pdf->Cell(0,4,"Absence justifiée",0,0,'L');
	    $pdf->Ln(5);
	    $pdf->SetFont('Arial','',12);
	    $pdf->Cell(0,4,"Lorsqu’un candidat est absent pour un motif dûment justifié à une ou plusieurs situations",0,0,'L');
	    $pdf->Ln(5);
	    $pdf->Cell(0,4,"l’évaluation, une autre date doit lui être proposée pour la ou les situation(s) manquée(s).",0,0,'L');




		$pdf->Output($prestation->idstudent->idinternaluser->nom. "_".$prestation->idstudent->idinternaluser->prenom."_Convocation","I");
    }
}