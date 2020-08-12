<?php
require('../../Resources/fpdf/fpdf.php');

include '../../connection.php';
session_start();
//$_SESSION["Login_id"]=22090;
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

		if($con->query($sql)->fetch_assoc()['t_year']==2 || $con->query($sql)->fetch_assoc()['t_year']==3)
		{
		$pdf->Image('../../Resources/images/campform/23.jpg',4,1,205);
		}
		if($con->query($sql)->fetch_assoc()['t_year']==4 || $con->query($sql)->fetch_assoc()['t_year']==5)
		{
			$pdf->Image('../../Resources/images/campform/45.jpg',4,1,205);
		}
		$name=$con->query($sql)->fetch_assoc()["first_name"]." ".$con->query($sql)->fetch_assoc()["middle_name"]."  ".$con->query($sql)->fetch_assoc()["last_name"];
		$pdf->Text(21,13,"ENROLLMENT ID");
		$pdf->Text(21,19,$con->query($sql)->fetch_assoc()['enrollment_id']);
		$pdf->Text(150,13,"TRANSACTION ID");
		$year=$con->query($sql)->fetch_assoc()['t_year'];
		$gettransactionid="SELECT * FROM fees_payment WHERE e_id='{$_SESSION["Login_id"]}' AND fees_for_year='{$year}'";
		$pdf->Text(150,19,$con->query($gettransactionid)->fetch_assoc()['payment_id']);
		
		$pdf->Text(32,63,strtoupper($name));
		$pdf->SetFontSize(8);
		$pdf->Text(34,76,$con->query($sql)->fetch_assoc()['address']);
		$pdf->SetFontSize(10);
		$city=$con->query($sql)->fetch_assoc()['city'];
		$pdf->Text(53,91,$city);
		$pdf->Text(110,99,$con->query($sql)->fetch_assoc()['mobile1']);
		if($con->query($sql)->fetch_assoc()['birthdate']!="0000-00-00")
		{
		$pdf->Text(40,106,$con->query($sql)->fetch_assoc()['birthdate']);
		}
		if($con->query($sql)->fetch_assoc()['gender']=='M'||$con->query($sql)->fetch_assoc()['gender']=='m')
		{
			$pdf->Text(115,106,"MALE");
		}
		else if($con->query($sql)->fetch_assoc()['gender']=='F'||$con->query($sql)->fetch_assoc()['gender']=='f')
		{
			$pdf->Text(115,106,"FEMALE");
		}
		else
		{
			$pdf->Text(115,106,$con->query($sql)->fetch_assoc()['gender']);
		}
		$trop=explode("-", substr($con->query($sql)->fetch_assoc()['enrollment_id'],3,8));
		$getschool="SELECT * FROM school_master WHERE TROOP_CODE='{$trop[0]}' AND STATE_ID=(SELECT STATE_ID FROM state_master WHERE STATE_CODE='{$trop[1]}')";
		$pdf->Text(50,114,$con->query($getschool)->fetch_assoc()['SC_NAME']);
		$pdf->Text(157,161,$con->query($sql)->fetch_assoc()['aadharcard_no']);
		$pdf->Text(115,161,$con->query($sql)->fetch_assoc()['blood_group']);
		
	    $pdf->AddPage();
	  
	
		 $pdf->Image('../../Resources/images/campform/all.jpg',4,1,205);
		  $pdf->Text(68,59,strtoupper($name));
	
	//$pdf->Output();
	$pdf->Output('D',"enrollform.pdf");
}
}
else
{

}
	?>
