<?php
require('../Resources/fpdf/fpdf.php');
include '../connection.php';
session_start();

class PDF extends FPDF
{

}

$pdf = new PDF('P','in',array(8.3,11.7));
$pdf->SetFont('Arial','',11);
$year = $_SESSION["cd_year"];

    $pdf->SetFont('Arial','',11);
    $pdf->AddPage();
    $pdf->Cell(7.5,0.42,"Camp Summary Report of ". $year,1,0,'C',false);
    $pdf->Ln();
    $pdf->Cell(3.75,0.42,"Training Year",1,0,'C',false);
    $pdf->Cell(3.75,0.42,"Number of Cadet",1,0,'C',false);
    $pdf->Ln();
    
    $sql = "SELECT * FROM `year_master` where year_range = '$year'";
    $year = $con->query($sql)->fetch_assoc()["c_year"];

    $count1 = 0;
    for($i=3;$i<=5;$i++)
    {
        $count = 0;
        $count=$con->query("SELECT COUNT(*) as 'year_count', t_year as trp_year from enroll_master WHERE c_year=$year and t_year=$i and (atc = 1 or otc = 1 or stc = 1)");
        $row=$count->fetch_assoc();
        $data = $row['year_count'];
        if($i == 3)
        {
            $pdf->Cell(3.75,0.42,$i. " (ATC)",1,0,'C',false);
        }
        else if($i == 4)
        {
            $pdf->Cell(3.75,0.42,$i. " (STC)",1,0,'C',false);
        }
        else if($i == 5)
        {
            $pdf->Cell(3.75,0.42,$i. " (OTC)",1,0,'C',false);
        }
        else
        {
            $pdf->Cell(3.75,0.42,$i,1,0,'C',false);
        }
    	$pdf->Cell(3.75,0.42,$data,1,0,'C',false);
        $count1 = $count1 + $data;
    	$pdf->Ln();
    }
    $pdf->Cell(3.75,0.42,"Total Cadet",1,0,'C',false);
    $pdf->Cell(3.75,0.42,$count1,1,0,'C',false);
    $pdf->Text(5.5,11.5,'Report Genrated On :- '.date("Y-m-d"));
$pdf->Output();
?>