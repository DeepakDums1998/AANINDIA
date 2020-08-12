<?php
require('../../Resources/fpdf/fpdf.php');

include '../../connection.php';
@session_start();
class PDF extends FPDF
{
}
ob_start();

    
	
	
if(isset($_SESSION["Login_id"]))
{
	$sql = "SELECT * FROM fees_payment WHERE e_id = ".$_SESSION["Login_id"]." and year = ".$_GET['year'];
	
	$name_cadet = "SELECT * FROM enroll_master WHERE e_id = ".$_SESSION["Login_id"];
	if($con->query($sql)->num_rows!=0)
	{
	$pdf = new PDF('P','mm',array(180,150));
	$pdf->SetFont('Arial','B',10);
	$pdf->AddPage();
	$pdf->AliasNbPages();
	$pdf->Rect(5, 5, 140, 170, 'D');
	$image = '../../Resources/images/logo.png';
	$sign = '../../Resources/images/certi_signs.png';

	$reciptid=$con->query($sql)->fetch_assoc()["pay_id"];
	$e_id=$con->query($name_cadet)->fetch_assoc()["enrollment_id"];
	$amount=$con->query($sql)->fetch_assoc()["amount"];
	$name=$con->query($name_cadet)->fetch_assoc()["first_name"]." ".$con->query($name_cadet)->fetch_assoc()["middle_name"]."  ".$con->query($name_cadet)->fetch_assoc()["last_name"];
	$pdf->Cell(100,20,$pdf->Image($image,10,10,30),0,0,'C',false);
 	$pdf->Cell(1.6,6.66,"Receipt No : {$reciptid}",0,2,'L',false);
 	$transdate=date('d-m-Y h:i:s', strtotime($con->query($sql)->fetch_assoc()["created_date"]));
	$date=substr($transdate,0,10);
	$time=substr($transdate,10);
	$tdate=substr($transdate,0,10);
 	$pdf->Cell(1.6,6.66,"Date : {$date}",0,2,'L',false);
 	$pdf->Cell(1.6,6.66,"Time : {$time}",0,1,'L',false);
 	$pdf->Cell(1.6,20,"",0,1,'L',false);
 	$pdf->Cell(65,6.66,"Enrollment ID",1,0,'L',false);
 	
 	$pdf->Cell(65,6.66,"{$e_id}",1,1,'L',false);
 	$pdf->Cell(65,6.66,"Name",1,0,'L',false);
 	$pdf->Cell(65,6.66,"{$name}",1,1,'L',false);
 	$pdf->Cell(65,6.66,"Date of transaction",1,0,'L',false);
 	$pdf->Cell(65,6.66,"{$tdate}",1,1,'L',false);
 	$pdf->Cell(65,6.66,"Transaction id",1,0,'L',false);
 	$t_id=$con->query($sql)->fetch_assoc()["payment_id"];
	$year=$con->query($sql)->fetch_assoc()["year"];
	$next_year=intval(substr($year,2))+1;
 	$pdf->Cell(65,6.66,"{$t_id}",1,1,'L',false);
 	$pdf->Cell(65,6.66,"YEAR",1,0,'L',false);
 	$pdf->Cell(65,6.66,"{$year}-{$next_year}",1,1,'L',false);
 	$pdf->Cell(65,6.66,"Amount ",1,0,'L',false);
 	$pdf->Cell(65,6.66,"Rs.{$amount}\-",1,1,'L',false);
 	$pdf->Cell(130,10,"",0,1,'L',false);
 	$pdf->Cell(65,6.66,"",0,0,'L',false);
 	$pdf->Cell(65,6.66,"ADJT , AAN",0,1,'R',false);
 	$pdf->Cell(130,20,"",0,1,'L',false);
 	$pdf->SetFont('Arial','',9);
	$pdf->SetTextColor(255,0,0);
 	$pdf->Cell(130,20,"*This is computer generated receipt and does not required signature and stamp.",0,1,'L',false);
 		
 

/*	
	
	$amount=$con->query($sql)->fetch_assoc()["amount"];
	$pdf->Text(20,54,"Received Rs.{$amount}/- from cadet with Enrollment id");
	$e_id=$con->query($name_cadet)->fetch_assoc()["enrollment_id"];
	$pdf->Text(100,54," {$e_id} ");
	
	
	$name=$con->query($name_cadet)->fetch_assoc()["first_name"]." ".$con->query($name_cadet)->fetch_assoc()["middle_name"]."  ".$con->query($name_cadet)->fetch_assoc()["last_name"];
	$tdate=substr($transdate,0,10);
	$pdf->Text(20,64,"Name {$name} on {$tdate} with Transaction id");
	$t_id=$con->query($sql)->fetch_assoc()["payment_id"];
	$year=$con->query($sql)->fetch_assoc()["year"];
	$next_year=intval(substr($year,2))+1;
	$pdf->Text(20,74,"{$t_id} for year {$year}-{$next_year}.");
	$pdf->SetFont('Arial','B',12);
	
	$pdf->Image($sign,115,75,25);
	$pdf->Text(115,96,"ADJT , AAN");
	$pdf->SetFont('Arial','',9);
	$pdf->SetTextColor(255,0,0);
	$pdf->Text(20,114,"This is computer generated receipt and does not required signature and stamp.");*/
	//$pdf->Output();
	$pdf->Output('D',$e_id."_receipt.pdf");
	//header("Location:Dashboard.php");
	}
}
else
{
header("Location:Login.php");
}
?>