<?php
	include '../../connection.php';
	session_start();
	if (isset($_POST["get_enroll"])) {
		$enrollment_id = $_POST["get_enroll"];
		$enrollflag = 0;
		$gender = "M";
		$no = 0;
		$enrollsql = "select * from enroll_master where enrollment_id = '".$enrollment_id."'";
		$enrollres = $con->query($enrollsql);
		while ($row = $enrollres->fetch_assoc()) {
			$enrollflag = 1;
			$no = $row["e_id"];
			$gender = $row["gender"];
			break;
		}

		if($enrollflag == 1)
		{
			$schoolid = explode("-", $enrollment_id)[1];
			$campId = 0;
			$squadsql = "select * from squad_master where S_No = ".$_SESSION["Id"];
			$res = $con->query($squadsql);
			while ($row = $res->fetch_assoc()) {
				$campId = $row["C_ID"]; 	
			}


			$finalflag = 0;
			$school = "select * from school_assign,squad_master,school_master where school_master.SC_ID = school_assign.school_Id and squad_master.S_No = school_assign.squad_no and squad_master.C_ID = ".$campId." and S_type = '".$gender."' and school_master.TROOP_CODE = ".$schoolid;
			$schoolres = $con->query($school);
			while ($row = $schoolres->fetch_assoc()) {
				$finalflag = 1;
				break;
			}

			if($finalflag == 1)
			{
				echo $no;
			}
			else
			{
				echo "Enrollment Number Not Please Connect With Admin..";
			}
		}
		else
		{
			echo "Invalid Enrollment Id";
		}

		/*

		$schools = */
	}
?>