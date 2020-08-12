<?php
    include '../../connection.php';
    session_start();
    if(isset($_GET["type"]))
    {

    }
    else
    {
        header("Location:Request.php?type=m");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V2</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<div class="limiter">
        <div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form p-b-10" method="post">
                    <span class="login100-form-title" style="font-size: 15px;">
                        <?php
                            if(isset($_GET["type"]))
                            {
                                if($_GET["type"] == "m")
                                {
                                    echo "Search By Mobile No";
                                }
                                elseif ($_GET["type"] == "a") {
                                    echo "Search By Aadhar No";
                                }
                            }
                        ?>
                    </span>

					<span class="login100-form-title p-t-10">
						<img src="../../Resources/images/logo.png">
					</span>

                    <span class="login100-form-btn" style="color: black;padding-bottom: 10px;height: 30px;">

                    </span>

                    <center><?php
                        if(isset($_POST["btngeteid"]))
                        {
                            $res = 0;
                            $sql = "";
                            $Enrollment_id = 0;
                            $mobile = 0;
                            $name = "";
                            if($_GET["type"] == "m")
                            {
                                $sql = "select * from enroll_master where mobile1 = ".$_POST["txtno"]." or mobile2 = ".$_POST["txtno"];
                                $result = $con->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    $res = 1;
                                    $Enrollment_id = $row["first_name"]." Your Enrollment Id Is  ".$row["enrollment_id"].", ";
                                    $mobile = $_POST["txtno"];
                                }

                                
                            }
                            elseif ($_GET["type"] == "a") {
                                $sql = "select * from enroll_master where aadharcard_no = '".$_POST["txtno"]."'";
                                $result = $con->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    $Enrollment_id = $row["first_name"]." Your Enrollment Id Is ".$row["enrollment_id"];
                                    if($row["mobile1"] != "")
                                    {
                                        $res = 1;
                                        $mobile = $row["mobile1"];
                                    }
                                    else if($row["mobile2"] != "")
                                    {
                                        $res = 1;
                                        $mobile = $row["mobile2"];
                                    }
                                    else{
                                        $res = 0;
                                    }
                                }
                            }

                            if($res == 1)
                            {
                                echo "<span style='color:green;'>Enrollment Id Send Successfully</span>";
                                echo "<script src='https://code.jquery.com/jquery-1.12.4.min.js'></script><script>";
                                echo "$(document).ready(function () {";
                                echo "$.ajax({ ";
                                  echo "url: 'http://sms.onlinebusinessbazaar.in/api/mt/SendSMS?user=aangroup&password=AAN8866&senderid=AANGHQ&channel=Trans&DCS=0&flashsms=0&number=".$mobile."&text=  ".$Enrollment_id."'";
                                  echo ",cache: false,";
                                  echo "success: function (html) {  } ";
                                echo "}); });</script>";
                            }
                            else
                            {
                                echo "<script>alert('You Have Not Registor Your Mobile Number Yet. Please Contact With AAN HQ.');</script>";
                            }
                        }
                    ?></center>

                    <span class="login100-form-btn p-b-5" style="color: black;padding-bottom: 10px;height: 30px;">

                    </span>

					<div class="wrap-input100 validate-input" data-validate="Please Fill It.">
						<input class="input100" type="text" name="txtno"
                        <?php if(isset($_GET["type"]))
                            {
                                if($_GET["type"] == "m")
                                {
                                    echo "pattern='^[0-9]{10}' title='Enter Mobile Like (1234567890)'";
                                }
                                elseif ($_GET["type"] == "a") {
                                    echo "pattern='[0-9]{4}-[0-9]{4}-[0-9]{4}' title='Enter Aadhar Like (1234-5678-9123)'";
                                }
                            } ?> >

                        <span class="focus-input100 p-b-20" <?php if(isset($_GET["type"]))
                            {
                                if($_GET["type"] == "m")
                                {
                                    echo "data-placeholder='Mobile Number'";
                                }
                                elseif ($_GET["type"] == "a") {
                                    echo "data-placeholder='Aadhar Number'";
                                }
                            } ?> ></span>
                    </div>


                    <div class="container-login100-form-btn" >
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn" name="btngeteid" >
                                Get Enrollment Id
                            </button>
                        </div>
                    </div>


					<div class="text-center p-t-50">
						<a class="txt2" href="Login.php">
							Get Back.
						</a>

                        |

                        <?php
                            if(isset($_GET["type"]))
                            {
                                if($_GET["type"] == "m")
                                {
                                    echo "<a class='txt2' href='Request.php?type=a'>Search By Aadhar No.</a>";
                                }
                                elseif ($_GET["type"] == "a") {
                                    echo "<a class='txt2' href='Request.php?type=m'> Search By Mobile No.</a>";
                                }
                            }
                        ?>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<script src="js/main.js"></script>

</body>
</html>