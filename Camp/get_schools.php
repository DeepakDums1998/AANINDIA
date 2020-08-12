<?php
include '../connection.php';

if(isset($_POST["set_state"]))
{
	echo "<option value='0'>All School</option>";
	$sql = "";
	if($_POST["set_state"] == 0)
	{
		$school_array = array();
		$sql = "select * from school_assign,school_master where school_master.SC_ID = school_assign.school_Id and school_assign.camp_Id = ".$_POST["set_camp_Id"];
		$res = $con->query($sql);
		while ($row = $res->fetch_assoc()) {
			array_push($row["TROOP_CODE"]);
		}
		$school_array = array_unique($school_array);
		foreach ($school_array as $value) {
			echo "<option>".$value."</option>";
		}
		$sql = "select * from school_master where TROOP_CODE = '".$row["TROOP_CODE"]."'";
			$res = $con->query($sql);
			while ($row = $res->fetch_assoc()) {
				$statesql = "select * from state_master where STATE_ID = ".$row["STATE_ID"];
				echo "<option value='".$row["TROOP_CODE"]."'>". $con->query($statesql)->fetch_assoc()["STATE_CODE"] ." - ".$row["TROOP_CODE"]." - ". $row["SC_NAME"] ."</option>";
			}
	}
	else
	{
		$sql = "select * from school_assign,school_master where school_master.SC_ID = school_assign.school_Id and school_master.STATE_ID = ".$_POST["set_state"] . " and school_assign.camp_Id = ".$_POST["set_camp_Id"];
		$res = $con->query($sql);
		while ($row = $res->fetch_assoc()) {
			echo "<option value='".$row["TROOP_CODE"]."'>".$row["TROOP_CODE"]." - ". $row["SC_NAME"] ."</option>";
		}
	}
}