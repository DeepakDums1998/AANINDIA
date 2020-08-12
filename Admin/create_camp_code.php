<?php
	include '../connection.php';
	if(isset($_POST["get_year"]) && isset($_POST["get_type"]))
	{
		$camp_year = $_POST["get_year"];
		$camp_type = $_POST["get_type"];
		if($camp_year == "")
		{

		}
		elseif($camp_type == "")
		{

		}
		$camp_search = $camp_year . "-" . $camp_type;
		$sql = "select * from camp_master where Camp_Code like '%".$camp_search."%' Order By Camp_Id ASC";
		$rs = $con->query($sql);
		$count = 0;
		$camp_code = "";
		while ($row = $rs->fetch_assoc()) {
			$count = 1;
			$camp_code = $row["Camp_Code"];
		}
		if($count == 1)
		{
			$camp_code = explode("-", $camp_code)[2] + 1;
			if($camp_code > 0 && $camp_code <= 9)
			{
				$camp_code = "000".$camp_code;
			}
			elseif ($camp_code >= 10 && $camp_code <= 99) {
				$camp_code = "00".$camp_code;
			}
			elseif ($camp_code >= 100 && $camp_code <= 999) {
				$camp_code = "0".$camp_code;
			}
			elseif ($camp_code >= 1000 && $camp_code <= 9999) {
				$camp_code = $camp_code;
			}
		}
		if($count == 0)
		{
			$camp_code = "0001";
		}
		echo $camp_code;
	}
?>