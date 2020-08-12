<?php
include '../connection.php';
$erno=$_POST["er_id"]."-".$_POST["troopcode"]."-".$_POST["state_id"];
//echo $erno; 
$data = "000";        
if(isset($_POST["er_id"]) && isset($_POST["troopcode"]) && isset($_POST["state_id"]))
{

	 $eno=$con->query("select MAX(SUBSTR(enrollment_id ,13, 3)) As maxeno FROM enroll_master WHERE enrollment_id LIKE '$erno%'");
	
	 $row=$eno->fetch_assoc();
	 $data = $row['maxeno'] + 1;
	 if ($data > 0 && $data <= 9) {
	 	echo "00".$data;
	 }
	 elseif ($data >= 10 && $data <= 99) {
	 	echo "0".$data;
	 }
	 elseif ($data >= 100 && $data <= 999) {
	 	echo $data;
	 }
}

?>