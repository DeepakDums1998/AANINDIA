<?php 
	$con = new mysqli("localhost", "root", "","aanindia");
    if (isset($con->connect_error)) {
        die("connection faild...." . $con->connect_error);
    }
?>
