<?php
	session_start();
	include 'Connection.php';
	session_destroy();
	header("location:Login.php");
?>