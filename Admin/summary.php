<?php
require('../Resources/fpdf/fpdf.php');
include '../connection.php';
session_start();

class PDF extends FPDF
{

}

$pdf = new PDF('P','in',array(8.3,11.7));
$pdf->SetFont('Arial','',11);

$troop = $_SESSION["troop_code"];
$state = $_SESSION["state_code"];
$year = $_SESSION["cd_year"];


if($troop != "All" && $state != "All")
{
    $stateid = "select * from state_master where state_code = '$state'";
    $stateid = $con->query($stateid)->fetch_assoc()["Sr_no"];
    $sql1 = "select * from school_master where troop_code = '$troop' and state_id = $stateid";
    $name = $con->query($sql1)->fetch_assoc()["school_name"] . " - (" . $con->query($sql1)->fetch_assoc()["troop_code"] . ")";

    $pdf->SetFont('Arial','',11);
    $pdf->AddPage();
    $pdf->Cell(7.5,0.42,"Summary Report of ". $year,1,0,'C',false);
    $pdf->Ln();
    $pdf->Cell(7.5,0.42,$name,1,0,'C',false);
    $pdf->Ln();
    $pdf->Cell(3.75,0.42,"Training Year",1,0,'C',false);
    $pdf->Cell(3.75,0.42,"Number of Cadet",1,0,'C',false);
    $pdf->Ln();
    $sql = "SELECT * FROM `year_master` where year_range = '$year'";
    $year = $con->query($sql)->fetch_assoc()["c_year"];
    $count1 = 0;
    for($i=1;$i<=5;$i++)
    {
        $count=$con->query("SELECT COUNT(*) as 'year_count', t_year as trp_year from enroll_master WHERE t_year=$i and SUBSTRING( enroll_master.enrollment_id, 4, 4)=$troop and enrollment_id like '%$state%' and c_year=$year");

        $row=$count->fetch_assoc();
        $data = $row['year_count'];
        $pdf->Cell(3.75,0.42,$i,1,0,'C',false);
    	$pdf->Cell(3.75,0.42,$data,1,0,'C',false);
        $count1 = $count1 + $data;
    	$pdf->Ln();
    }
    $pdf->Cell(3.75,0.42,"Total Cadet",1,0,'C',false);
    $pdf->Cell(3.75,0.42,$count1,1,0,'C',false);
    $pdf->Text(5.5,11.5,'Report Genrated On :- '.date("Y-m-d"));
}
else if($troop == "All" && $state != "All")
{
    /*$stateid = "select * from state_master where state_code = '$state'";
    $stateid = $con->query($stateid)->fetch_assoc()["Sr_no"];

    $sql1 = "select * from school_master where state_id = $stateid";
    $select = $con->query($sql1);
    while($row = $select->fetch_assoc())
    {
        $name = $row["school_name"] . " - (" . $row["troop_code"] . ")";
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->Cell(7.5,0.42,"Summary Report of ". $year,1,0,'C',false);
        $pdf->Ln();
        $pdf->Cell(7.5,0.42,$name,1,0,'C',false);
        $pdf->Ln();
        $pdf->Cell(3.75,0.42,"Training Year",1,0,'C',false);
        $pdf->Cell(3.75,0.42,"Number of Cadet",1,0,'C',false);
        $pdf->Ln();
        $sql = "SELECT * FROM `year_master` where year_range = '$year'";
        $year = $con->query($sql)->fetch_assoc()["c_year"];
        $count1 = 0;
        for($i=1;$i<=5;$i++)
        {
            $sql12 = "SELECT COUNT(*) as 'year_count', t_year as trp_year from enroll_master WHERE t_year=$i and SUBSTRING( enroll_master.enrollment_id, 4, 4)=$troop and enrollment_id like '%$state%' and c_year=$year";

			$resss = $con->query($sql12);
			while($rows = $resss->fetch_assoc())
			{
			    $pdf->Text(55,89.5,$rows["asd"]);
			}
        }

        $pdf->Cell(3.75,0.42,"Total Cadet",1,0,'C',false);
        $pdf->Cell(3.75,0.42,$count1,1,0,'C',false);
    }*/
}
$pdf->Output();
?>
