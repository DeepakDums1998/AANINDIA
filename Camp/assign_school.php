<?php
include '../connection.php';

if(isset($_POST["set_sid"]))
{
	if($_POST["opration"] == "I")
	{
		$data = "insert into school_assign(school_id,camp_id,squad_no,school_assign_time) values(".$_POST["set_sid"].",".$_POST["set_cid"].",".$_POST["no"].",'".date("Y-m-d H:i")."')";
		$con->query($data);
	}

	if($_POST["opration"] == "D")
	{
		$data = "delete from school_assign where squad_no = ".$_POST["no"]." and school_id = ".$_POST["set_sid"] ." and camp_id = ".$_POST["set_cid"];
		echo $data;
		$con->query($data);
	}
}