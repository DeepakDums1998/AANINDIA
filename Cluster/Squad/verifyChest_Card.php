<?php
	session_start();
	include '../../connection.php';
	if(isset($_POST["Bond"]))
	{
		$campid = 0;
		$campsql = "select * from squad_master where U_Type = 3 and S_No = ".$_SESSION["Id"];
		$campres = $con->query($campsql);
		while ($row = $campres->fetch_assoc()) {
			$campid = $row["C_ID"];
		}

		if(!($campid == 0))
		{
			$check = 0;
			$sql = "select * from camp_cadet_entry where Camp_Id = ".$campid." and Chest_Card_No = ".$_POST["Chest_Card"];
			$res = $con->query($sql);
			while ($row = $res->fetch_assoc()) {
				$check = 1;
			}

			if($check == 1)
			{
				echo "This Chest Card Number Already Scan.";
			}
			else
			{
				$sql1 = "insert into camp_cadet_entry(Camp_Id,S_No,C_No,Chest_Card_No) values({$campid},".$_POST["squad"].",".$_POST["Bond"].",".$_POST["Chest_Card"].")";
				if($con->query($sql1) == TRUE)
				{
					echo "0";
				}
			}
		}

		
	}

?>