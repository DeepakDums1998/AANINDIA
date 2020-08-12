<?php
session_start();
require('../Resources/fpdf/fpdf.php');
include '../connection.php';
class PDF extends FPDF
{

}

if(isset($_SESSION["query"]))
{
	$pdf = new PDF('P','in',array(8.3,11.7));
	$query = $_SESSION["query"];
	$res = $con->query($query);
	$pdf->SetFont('Arial','',11);

    $pdf->AddPage();
    $count = 1;
    $count1 = 1;
    $pdf->Text(5.5,11.5,'Report Genrated On :- '.date("Y-m-d"));
    $pdf->Cell(0.6,0.42,"Sr.No.",1,0,'C',false);
    $pdf->Cell(1.4,0.42,"Enrollment Id",1,0,'C',false);
	$pdf->Cell(3.5,0.42,"Full Name",1,0,'C',false);
	$pdf->Cell(0.50,0.42,"Trg",1,0,'C',false);
	$pdf->Cell(1.0,0.42,"Mobile",1,0,'C',false);
	$pdf->Cell(0.64,0.42,"F.No",1,0,'C',false);
	$pdf->Ln();
    while ($row = $res->fetch_assoc()) {
		if($count%25 == 0)
		{	
			$pdf->Text(5.5,11.5,'Report Genrated On :- '.date("Y-m-d"));
			$pdf->Cell(0.6,0.42,"Sr.No.",1,0,'C',false);
		    $pdf->Cell(1.4,0.42,"Enrollment Id",1,0,'C',false);
			$pdf->Cell(3.5,0.42,"Full Name",1,0,'C',false);
			$pdf->Cell(0.50,0.42,"Trg",1,0,'C',false);
			$pdf->Cell(1.0,0.42,"Mobile",1,0,'C',false);
			$pdf->Cell(0.64,0.42,"F.No",1,0,'C',false);
			$pdf->Ln();
			$count = $count + 1;
		}
			$pdf->Cell(0.6,0.42,$count1,1,0,'C',false);
			$pdf->Cell(1.4,0.42,$row["enrollment_id"],1,0,'C',false);
			$pdf->Cell(3.5,0.42,($row["first_name"]." ".$row["middle_name"][0] . ". " . $row["last_name"]),1);
			$pdf->Cell(0.50,0.42,$row["t_year"],1,0,'C',false);
			$pdf->Cell(1.0,0.42,$row["mobile1"],1,0,'C',false);
			$pdf->Cell(0.64,0.42,$row["form_no"],1,0,'C',false);	
		
		$pdf->Ln();
		$count = $count + 1;
		$count1 = $count1 + 1;
	}
	$pdf->Output();
}
else
{
	header("location:view_cadet.php");
}
?>