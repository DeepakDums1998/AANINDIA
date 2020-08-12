		<?php
require('../Resources/fpdf/fpdf.php');
include '../connection.php';
session_start();

if (isset($_SESSION["ADMIN"])) {
         
         
	class PDF extends FPDF
	{

		}
		$sql1 = "select CURRENT_DATE as 'date'";
		$datetime = $con->query($sql1)->fetch_assoc()["date"];
		
			$sql = $_SESSION["query"];
			$res = $con->query($sql);
		$pdf = new PDF('P','mm','A4');
		$pdf->SetFont('Arial','B',12);
		while ($row = $res->fetch_assoc()) {
		    $city = "";
			$pdf->AddPage();
			$pdf->AliasNbPages();
			$pdf->Text(83,81,$row["enrollment_id"]);
			$pdf->Text(160,81,'CDT');	
			$pdf->Text(45,89.5,strtoupper($row["first_name"]." ".$row["middle_name"][0] . ". " . $row["last_name"]));

			if($row["school_update_status"] == 1)
			{
				$sqla = "select * from update_school_details,state_master,city_master,school_master where update_school_details.state_id = state_master.Sr_no and update_school_details.city_id = city_master.Sr_no and school_master.troop_code = update_school_details.troop_code and enrollment_id = '".$row["enrollment_id"]."'";
				$rs = $con->query($sqla);
				while ($roww = $rs->fetch_assoc()) {
					$city = $roww["city_name"];
				    $pdf->SetFont('Arial','B',10);
				    $pdf->Text(45,100.5,($roww["troop_code"]."-".$roww["state_code"]." (".$roww["school_name"].")"));
				}
			}
			else
			{
				$sql12 = "SELECT * FROM school_master,city_master,state_master where school_master.STATE_ID = state_master.Sr_no and state_master.STATE_ID = city_master.STATE_ID and school_master.C_ID = city_master.C_ID and school_master.TROOP_CODE = '".explode("-",$row["enrollment_id"])[1]."' and state_master.STATE_CODE = '".explode("-",$row["enrollment_id"])[2]."'";
				echo $sql12;
				$resss = $con->query($sql12);
				while($rows = $resss->fetch_assoc())
				{
						$city = $rows["city_name"];
					    $pdf->SetFont('Arial','B',10);
					    $pdf->Text(45,100.5,($rows["troop_code"]."-".$rows["state_code"]." (".$rows["school_name"].")")); 
				}
			}
			
			$pdf->SetFont('Arial','B',12);
			$pdf->Text(44,128,'26/01/'.(date("Y",strtotime($datetime))+1));
			$pdf->Text(178,127,strtoupper($city));
			$pdf->Image('../Resources/images/certi_signs.png',130,140,40);

		}
		$pdf->Output();
	}
	else
	{
		echo "asdasd";
	}
	?>
