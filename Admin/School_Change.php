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
	$query = "select * from enroll_master where school_update_status ORDER BY t_year ASC";
	$res = $con->query($query);
	$pdf->SetFont('Arial','',10);

    $pdf->AddPage();
    $count = 1;
    $count1 = 1;
    $pdf->Cell(0.6,0.25,"Sr.No.",1,0,'C',false);
    $pdf->Cell(1.4,0.25,"Enrollment Id",1,0,'C',false);
	$pdf->Cell(3.1,0.25,"Full Name",1,0,'C',false);
	$pdf->Cell(2.9,0.25,"Old School",1,0,'C',false);
	$pdf->Cell(2.9,0.25,"New School",1,0,'C',false);
	$pdf->Text(9.2,8.1,'Report Genrated On :- '.date("Y-m-d"));
	$pdf->Ln();
    while ($row = $res->fetch_assoc()) {
		if($count%28 == 0)
		{
			$pdf->Text(9.2,8.1,'Report Genrated On :- '.date("Y-m-d"));
			$pdf->Cell(0.6,0.25,"Sr.No.",1,0,'C',false);
		    $pdf->Cell(1.4,0.25,"Enrollment Id",1,0,'C',false);
			$pdf->Cell(3.1,0.25,"Full Name",1,0,'C',false);
			$pdf->Cell(2.9,0.25,"Old School",1,0,'C',false);
			$pdf->Cell(2.9,0.25,"New School",1,0,'C',false);
			$pdf->Ln();
			$count = $count + 1;
		}
			$pdf->Cell(0.6,0.25,$count1,1,0,'C',false);
			$pdf->Cell(1.4,0.25,$row["enrollment_id"],1,0,'C',false);
			$pdf->Cell(3.1,0.25,strtoupper($row["first_name"]." ".$row["middle_name"][0] . ". " . $row["last_name"]),1);

			$sql = "select school_name from school_master where troop_code = ".explode("-", $row["enrollment_id"])[1];
			$rs = $con->query($sql)->fetch_assoc()["school_name"];
			$pdf->Cell(2.9,0.25,$rs,1,0,'C',false);

			$sql = "SELECT school_name FROM update_school_details,school_master WHERE update_school_details.troop_code = school_master.troop_code and enrollment_id = '".$row["enrollment_id"] . "'";
			$rs = $con->query($sql)->fetch_assoc()["school_name"];
			$pdf->Cell(2.9,0.25,$rs,1,0,'C',false);
			
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