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
		
		$sqlimage = "select * from camp_master where srno = ".$_GET["Id"];
		$image = '../Resources/images/camp_forms/'.$con->query($sqlimage)->fetch_assoc()["Main_Page_Form"];

		$pdf->Image($image,4,1,205);
		$pdf->Text(32,57,strtoupper(($row["first_name"]." ".$row["middle_name"][0] . ". " . $row["last_name"])));
		$pdf->Image("http://localhost/aanindia/Admin/qr_generator.php?code=".$row["enrollment_id"], 45, 26, 25, 25, "png");
		$pdf->SetFont('Arial','B',7);
		$pdf->Text(47.5,51	,$row["enrollment_id"]);

		$pdf->SetFont('Arial','B',10);
		if($row["school_update_status"] == 1)
		{
			$sqla = "select * from update_school_details,state_master,city_master,school_master where update_school_details.state_id = state_master.STATE_ID and update_school_details.city_id = city_master.C_ID and school_master.TROOP_CODE = update_school_details.troop_code and enrollment_id = '".$row["enrollment_id"]."'";
			$rs = $con->query($sqla);
			while ($roww = $rs->fetch_assoc()) {
				$pdf->Text(35,66.5,strtoupper($roww["SC_NAME"])." (".$roww["TROOP_CODE"]."-".explode("-",$row["enrollment_id"])[2].")");
			}
		}
		else
		{
			$sql12 = "SELECT school_master.SC_NAME as 'schoolname',school_master.TROOP_CODE as 'troopcode' FROM school_master,city_master,state_master where school_master.STATE_ID = state_master.STATE_ID and state_master.STATE_ID = city_master.STATE_ID and school_master.C_ID = city_master.C_ID and school_master.TROOP_CODE = '".explode("-",$row["enrollment_id"])[1]."' and state_master.STATE_CODE = '".explode("-",$row["enrollment_id"])[2]."'";
			$resss = $con->query($sql12);
			while($rows = $resss->fetch_assoc())
			{
				$pdf->Text(35,66.5,strtoupper($rows["schoolname"])." (".$rows["troopcode"]."-".explode("-",$row["enrollment_id"])[2].")");
			}
		}

		
		$pdf->Text(35,76.5,$row["std"]);
		$pdf->Text(77,76,$row["aadharcard_no"]);
		$pdf->Text(147,76.5,$row["mobile1"]);

		$state = "select * from state_master where STATE_CODE = '".explode("-", $row["enrollment_id"])[2]."'";
		$school = "select * from school_master where TROOP_CODE = '".explode("-", $row["enrollment_id"])[1]."' AND STATE_ID = ".$con->query($state)->fetch_assoc()["STATE_ID"];

		$squadno = "select * from school_assign,squad_master where squad_master.S_No = school_assign.squad_no and S_type = '".$row["gender"]."' and camp_Id = ".$_GET["Id"]." and school_Id = ".$con->query($school)->fetch_assoc()["SC_ID"];


		$pdf->SetFont('Arial','B',11);

		$pdf->Text(141,270.5,"SQUAD - ".$con->query($squadno)->fetch_assoc()["CS_No"]);

		$pdf->AddPage();
		$pdf->AliasNbPages();

		$sqlimage = "select * from camp_master where srno = ".$_GET["Id"];
		$image = '../Resources/images/camp_forms/'.$con->query($sqlimage)->fetch_assoc()["Back_Page_Form"];

		$pdf->Image($image,4,1,205);

	}
	$pdf->Output();
}
else
{

}
	?>
