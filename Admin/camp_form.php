<?php
require('../Resources/fpdf/fpdf.php');
include '../connection.php';
session_start();
class PDF extends FPDF
{

}

if(isset($_SESSION["query"]))
{
	$pdf = new PDF('P','mm','A4');
	$query = $_SESSION["query"];
	$res = $con->query($query);
	while ($row = $res->fetch_assoc()) {
		$pdf->SetFont('Arial','B',10);
		$pdf->AddPage();
		$pdf->AliasNbPages();
		$pdf->Image('../Resources/images/Camp_Form.jpg',4,1,205);
		$pdf->Text(32,60,strtoupper(($row["first_name"]." ".$row["middle_name"][0] . ". " . $row["last_name"])));
		$pdf->Image("http://localhost/aan/Admin/qr_generator.php?code=".$row["enrollment_id"], 45, 26, 25, 25, "png");
		$pdf->SetFont('Arial','B',7);
		$pdf->Text(47.5,52,$row["enrollment_id"]);
		
		$pdf->SetFont('Arial','B',10);
		
		if($row["school_update_status"] == 1)
		{
			$sqla = "select * from update_school_details,state_master,city_master,school_master where update_school_details.state_id = state_master.Sr_no and update_school_details.city_id = city_master.Sr_no and school_master.troop_code = update_school_details.troop_code and enrollment_id = '".$row["enrollment_id"]."'";
			$rs = $con->query($sqla);
			while ($roww = $rs->fetch_assoc()) {
				$pdf->Text(35,72,strtoupper($roww["school_name"])." (".$roww["troop_code"]."-".explode("-",$row["enrollment_id"])[2].")");
			}
		}
		else
		{
			$sql12 = "SELECT school_master.school_name as 'schoolname',school_master.troop_code as 'troopcode' FROM school_master,city_master,state_master where school_master.state_id = state_master.Sr_no and state_master.Sr_no = city_master.state_id and school_master.city_id = city_master.Sr_no and school_master.troop_code = '".explode("-",$row["enrollment_id"])[1]."' and state_master.state_code = '".explode("-",$row["enrollment_id"])[2]."'";
			$resss = $con->query($sql12);
			while($rows = $resss->fetch_assoc())
			{
				$pdf->Text(35,72,strtoupper($rows["schoolname"])." (".$rows["troopcode"]."-".explode("-",$row["enrollment_id"])[2].")");
			}
		}
		
		$pdf->Text(29,82,$row["std"]);
		$pdf->Text(65,82,$row["aadharcard_no"]);
		$pdf->Text(141,82,$row["mobile1"]);
		
	}
	$pdf->Output();
}
else
{

}
	?>
