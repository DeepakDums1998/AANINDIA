<?php
    include '../../connection.php';
    session_start();

    if(isset($_SESSION["Login_id"]))
    {
        header("Location:Dashboard.php");
    }

    if(isset($_GET["data"]))
    {
        $OTP = rand(1000,9999);
        $_SESSION["OTP"] = $OTP;
        echo "<script src='https://code.jquery.com/jquery-1.12.4.min.js'></script><script>";
        echo "$(document).ready(function () {";
        echo "$.ajax({ ";
          echo "url: 'http://sms.onlinebusinessbazaar.in/api/mt/SendSMS?user=aangroup&password=AAN8866&senderid=AANGHQ&channel=Trans&DCS=0&flashsms=0&number=".$_SESSION["mobile"]."&text=It is your one-time password ".$OTP.". please do not share with anyone.'";
          echo ",cache: false,";
          echo "success: function (html) {  } ";
        echo "}); });</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>AAN INDIA | CADET</title>
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
				<form class="login100-form validate-form" method="post">
                    <?php
                        if(isset($_POST["btnotp"]))
                        {
                            $enrollment_id = $_POST["txtusername"];
                            $sql = "SELECT * FROM enroll_master where enrollment_id = '{$enrollment_id}'";
                            $result = $con->query($sql);
                            $nfound = 2;
                            while ($row = $result->fetch_assoc()) {
                                if($row["password"] != NULL)
                                {
                                    $_SESSION["id"] = $row["enrollment_id"];
                                    $_SESSION["pass_cofirm"] = 0;
                                }
                                else
                                {
                                    $_SESSION["pass_cofirm"] = 1;
                                    if($row["mobile1"] != "")
                                    {
                                        $_SESSION["reload"] = 0;
                                        $_SESSION["id"] = $row["enrollment_id"];
                                        $_SESSION["mobile"] = $row["mobile1"];
                                        $nfound = 0;
                                    }
                                    else if($row["mobile2"] != "")
                                    {
                                        $_SESSION["id"] = $row["enrollment_id"];
                                        $_SESSION["mobile"] = $row["mobile2"];
                                        $nfound = 0;
                                    }
                                    else
                                    {
                                        $nfound = 1;
                                    }
                                }
                            }

                            if($nfound == 1)
                            {
                                echo "<script>alert('You Have Not Registor Your Mobile Number Yet. Please Contact With AAN HQ.');</script>";
                            }
                            else
                            {
                                $OTP = rand(1000,9999);
                                $_SESSION["OTP"] = $OTP;
                                echo "<script src='https://code.jquery.com/jquery-1.12.4.min.js'></script><script>";
                                echo "$(document).ready(function () {";
                                echo "$.ajax({ ";
                                  echo "url: 'http://sms.onlinebusinessbazaar.in/api/mt/SendSMS?user=aangroup&password=AAN8866&senderid=AANGHQ&channel=Trans&DCS=0&flashsms=0&number=".$_SESSION["mobile"]."&text=It is your one-time password ".$OTP.". please do not share with anyone.'";
                                  echo ",cache: false,";
                                  echo "success: function (html) {  } ";
                                echo "}); });</script>";
                            }
                        }
                    ?>
					<span class="login100-form-title">
						<img src="../../Resources/images/logo.png">
					</span>

                    <span class="login100-form-btn p-b-20" style="color: black;">
                        <?php
                            if(isset($_SESSION["mobile"]))
                            {
                                echo "OTP Send no ********".$_SESSION["mobile"][8].$_SESSION["mobile"][9];
                            }
                        ?>
                    </span>

                    
                        <?php
                            if(isset($_POST["btnsubmit"]))
                            {
                                if($_SESSION["OTP"] == $_POST["txtOTP"])
                                {
                                    $id = "";
                                    $enrollment_id = $_SESSION["id"];
                                    $sql = "SELECT * FROM enroll_master where enrollment_id = '{$enrollment_id}'";
                                    $result = $con->query($sql);
                                        while ($row = $result->fetch_assoc()) {
                                        $id = $row["e_id"];
                                    }
                                    session_destroy();
                                    session_start();
                                    $_SESSION["Login_id"] = $id;
                                    header("Location:Dashboard.php");
                                }
                                else
                                {
                                    ?>
                                        <span class="login100-form-btn p-b-20" style="color: red;">
                                    <?php
                                            echo "Your OTP is invalid.";
                                    ?>
                                        </span>
                                    <?php
                                }
                            }
                            if(isset($_POST["btnpasssubmit"]))
                            {
                                $sql = "select * from enroll_master where enrollment_id = '".$_SESSION["id"]."' and password = '".$_POST["txtpass"]."'";
                                $res = $con->query($sql);
                                while ($row = $res->fetch_assoc()) {
                                        $_SESSION["Login_id"] = $row["e_id"];
                                        header("Location:Dashboard.php"); 
                                }
                            }
                        ?>

					<div class="wrap-input100 validate-input" data-validate = "enrollment id like : 19-9999-GUJ-001">
						<input class="input100" type="text" pattern="^[0-9]{2}-[0-9]{4}-[a-zA-Z]{3}-[0-9]{3}" title="Please Enter Your Enrollment Id Like(19-9999-GUJ-001)" name="txtusername" id="txtuser" value="<?php if(isset($_SESSION['id'])){echo $_SESSION['id'];} ?>" focus="true">
						<?php if (isset($_SESSION["id"])) {
                           
                        }
                        else{
                            ?>
                            <span class="focus-input100 p-b-20" data-placeholder="Enrollment Id"></span>
                            <?php
                        } ?>
                    </div>


                    <?php
                        if(isset($_SESSION["id"]))
                        {
                            if(isset($_SESSION["pass_cofirm"]))
                            {
                                if($_SESSION["pass_cofirm"] == 1)
                                {
                                    ?>
                                        <div class="wrap-input100 validate-input" data-validate="Enter password">
                                            <span class="btn-show-pass">
                                                <a href="http://localhost/AAN/Camp/Cadet_Login/Login.php?data=resend">Resend OTP</a>
                                            </span>
                                            <input class="input100" type="text" name="txtOTP" pattern="^[0-9]{4}" title="Please Enter 4 Digit OTP " style="padding-right: 100px;">
                                            <span class="focus-input100" data-placeholder="OTP"></span>
                                        </div>

                                        <div class="container-login100-form-btn">
                                            <div class="wrap-login100-form-btn">
                                                <div class="login100-form-bgbtn"></div>
                                                <button class="login100-form-btn" name="btnsubmit">
                                                    Login
                                                </button>
                                            </div>
                                        </div>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                        <div class="wrap-input100 validate-input" data-validate="Enter password">
                                            <input class="input100" type="password" name="txtpass" title="Please Enter 4 Digit OTP " style="padding-right: 100px;">
                                            <span class="focus-input100" data-placeholder="Password"></span>
                                        </div>

                                        <div class="container-login100-form-btn">
                                            <div class="wrap-login100-form-btn">
                                                <div class="login100-form-bgbtn"></div>
                                                <button class="login100-form-btn" name="btnpasssubmit">
                                                    Login
                                                </button>
                                            </div>
                                        </div>
                                    <?php
                                }
                            }
                        }
                        else
                        {
                                ?>
                                <div class="container-login100-form-btn" >
                                    <div class="wrap-login100-form-btn">
                                        <div class="login100-form-bgbtn"></div>
                                        <button class="login100-form-btn" name="btnotp" >
                                            Send OTP
                                        </button>
                                    </div>
                                </div>
                                <?php
                        }
                    ?>

					<div class="text-center p-t-50">
						<a class="txt2" href="Request.php">
							Request For Enrollment Id?
						</a>
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