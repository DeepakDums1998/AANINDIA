<?php
include '../connection.php';

if(isset($_POST["set_year"]) && isset($_POST["set_type"]))
{
	$Camp_Id = "";
	$sql = "select * from camp_master where Camp_Id like '%".$_POST["set_year"]."%' and Camp_Id like '%".$_POST["set_type"]."%' order by Camp_Id";
	$rs = $con->query($sql);
	if(($rs->num_rows) > 0)
	{
		while ($row = $rs->fetch_assoc()) {
			$Camp_Id = $row["Camp_Id"];
		}
		if(explode("-", $Camp_Id)[2] >= 1 && explode("-", $Camp_Id)[2] <= 9)
		{
			$camp_increase = (explode("-", $Camp_Id)[2]) + 1;
			echo "00".$camp_increase;
		}
		elseif(explode("-", $Camp_Id)[2] >= 10 && explode("-", $Camp_Id)[2] <= 99)
		{
			$camp_increase = (explode("-", $Camp_Id)[2]) + 1;
			echo "0".$camp_increase;
		}
		elseif(explode("-", $Camp_Id)[2] >= 100 && explode("-", $Camp_Id)[2] <= 999)
		{
			$camp_increase = (explode("-", $Camp_Id)[2]) + 1;
			echo "".$camp_increase;
		}
	}else
	{
		echo "001";
	}
}