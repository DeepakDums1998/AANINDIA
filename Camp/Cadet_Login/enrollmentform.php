<?php
require('../../Resources/fpdf/fpdf.php');

include '../../connection.php';
session_start();
class PDF extends FPDF
{

}

if(isset($_SESSION["Login_id"]))

{
	$pdf = new PDF('P','mm','A4');
	//$query = $_SESSION["query"];
	//$res = $con->query($query);
	//while ($row = $res->fetch_assoc()) {
	$sql = "SELECT * FROM enroll_master WHERE e_id = ".$_SESSION["Login_id"];
	if($con->query($sql)->num_rows!=0)
	{

		$pdf->SetFont('Arial','B',10);
		$pdf->AddPage();
		$pdf->AliasNbPages();
		$pdf->Image('../../Resources/images/Camp_Form.jpg',4,1,205);
		$name=$con->query($sql)->fetch_assoc()["first_name"]." ".$con->query($sql)->fetch_assoc()["middle_name"]."  ".$con->query($sql)->fetch_assoc()["last_name"];
		$pdf->Text(32,60,strtoupper($name));
		//$pdf->Image("http://localhost/aan/Admin/qr_generator.php?code=".$row["enrollment_id"], 45, 26, 25, 25, "png");
	//	$pdf->SetFont('Arial','B',7);
	//	$pdf->Text(47.5,52,$row["enrollment_id"]);
		
	//	$pdf->SetFont('Arial','B',10);
		
		
	//	}
		
	//	$pdf->Text(29,82,$row["std"]);
	//	$pdf->Text(65,82,$row["aadharcard_no"]);
	//	$pdf->Text(141,82,$row["mobile1"]);
		
	
	//$pdf->Output();
	$pdf->Output('D',"enrollform.pdf");
}
}
else
{

}
	?>
