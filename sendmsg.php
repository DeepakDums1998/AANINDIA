
<?php
if(isset($_SESSION["Send"]))
{
	if($_SESSION["Send"] == 1)
	{
		/*echo "<script src='https://code.jquery.com/jquery-1.12.4.min.js'></script><script>";
		echo "$(document).ready(function () {";
		echo "$.ajax({ ";
		  echo "url: 'http://sms.onlinebusinessbazaar.in/api/mt/SendSMS?user=aangroup&password=AAN8866&senderid=AANGHQ&channel=Trans&DCS=0&flashsms=0&number=".$_SESSION["mobile_no"]."&text=".$_SESSION["msg1"]."'";
		  echo ",cache: false,";
		  echo "success: function (html) {  } ";
		echo "}); });</script>";
		
		echo "<script src='https://code.jquery.com/jquery-1.12.4.min.js'></script><script>";
		echo "$(document).ready(function () {";
		echo "$.ajax({ ";
		  echo "url: 'http://sms.onlinebusinessbazaar.in/api/mt/SendSMS?user=aangroup&password=AAN8866&senderid=AANGHQ&channel=Trans&DCS=0&flashsms=0&number=".$_SESSION["mobile_no"]."&text=".$_SESSION["msg"]."'";
		  echo ",cache: false,";
		  echo "success: function (html) {  } ";
		echo "}); });</script>";*/
		$_SESSION["Send"] = NULL;
		$_SESSION["mobile_no"] = NULL;
		$_SESSION["msg"] = NULL;
		$_SESSION["msg1"] = NULL;
	}
}
?>