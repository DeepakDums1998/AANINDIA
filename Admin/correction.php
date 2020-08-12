<?php
require('../Resources/fpdf/fpdf.php');
include '../connection.php';
session_start();


class PDF extends FPDF
{

}

if(isset($_SESSION["query"]))
{
	$pdf = new PDF('L','in',array(8.3,11.7));
	$query = "select * from enroll_master where aadharcard_no = '' or mobile1 = '' ORDER BY t_year ASC";
	$res = $con->query($query);
	$pdf->SetFont('Arial','',10);

    $pdf->AddPage();
    $count = 1;
    $count1 = 1;
    $pdf->Cell(0.6,0.25,"Sr.No.",1,0,'C',false);
    $pdf->Cell(1.4,0.25,"Enrollment Id",1,0,'C',false);
	$pdf->Cell(3.1,0.25,"Full Name",1,0,'C',false);
	$pdf->Cell(0.50,0.25,"STD",1,0,'C',false);
	$pdf->Cell(0.50,0.25,"Trg",1,0,'C',false);
	$pdf->Cell(0.64,0.25,"F.No",1,0,'C',false);
	$pdf->Cell(1.0,0.25,"Mobile",1,0,'C',false);
	$pdf->Cell(1.0,0.25,"D.O.B",1,0,'C',false);
	$pdf->Cell(0.40,0.25,"B.G",1,0,'C',false);
	$pdf->Cell(0.60,0.25,"G",1,0,'C',false);
	$pdf->Cell(1.20,0.25,"Aadhar No.",1,0,'C',false);
	$pdf->Text(9.2,8.1,'Report Genrated On :- '.date("Y-m-d"));
	$pdf->Ln();
    while ($row = $res->fetch_assoc()) {
		if($count%28 == 0)
		{
			$pdf->Text(9.2,8.1,'Report Genrated On :- '.date("Y-m-d"));
			$pdf->Cell(0.6,0.25,"Sr.No.",1,0,'C',false);
		    $pdf->Cell(1.4,0.25,"Enrollment Id",1,0,'C',false);
			$pdf->Cell(3.1,0.25,"Full Name",1,0,'C',false);
			$pdf->Cell(0.50,0.25,"STD",1,0,'C',false);
			$pdf->Cell(0.50,0.25,"Trg",1,0,'C',false);
			$pdf->Cell(0.64,0.25,"F.No",1,0,'C',false);
			$pdf->Cell(1.0,0.25,"Mobile",1,0,'C',false);
			$pdf->Cell(1.0,0.25,"D.O.B",1,0,'C',false);
			$pdf->Cell(0.40,0.25,"B.G",1,0,'C',false);
			$pdf->Cell(0.60,0.25,"G",1,0,'C',false);
			$pdf->Cell(1.20,0.25,"Aadhar No.",1,0,'C',false);
			$pdf->Ln();
			$count = $count + 1;
		}
			$pdf->Cell(0.6,0.25,$count1,1,0,'C',false);
			$pdf->Cell(1.4,0.25,$row["enrollment_id"],1,0,'C',false);
			$pdf->Cell(3.1,0.25,strtoupper($row["first_name"]." ".$row["middle_name"][0] . ". " . $row["last_name"]),1);
			$pdf->Cell(0.50,0.25,$row["std"],1,0,'C',false);
			$pdf->Cell(0.50,0.25,$row["t_year"],1,0,'C',false);
			$pdf->Cell(0.64,0.25,$row["form_no"],1,0,'C',false);			
			$pdf->Cell(1.0,0.25,$row["mobile1"],1,0,'C',false);
			$pdf->Cell(1.0,0.25,$row["birthdate"],1,0,'C',false);
			$pdf->Cell(0.40,0.25,$row["blood_group"],1,0,'C',false);
			$pdf->Cell(0.60,0.25,$row["gender"],1,0,'C',false);
			$pdf->Cell(1.20,0.25,$row["aadharcard_no"],1,0,'C',false);
			
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