<?php
include '../connection.php';
session_start();
if(isset($_SESSION["inLogin_id"]))
{
header("Location:Dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>AAN INDIA | CADET</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="../Camp/Cadet_Login/vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../Camp/Cadet_Login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../Camp/Cadet_Login/fonts/iconic/css/material-design-iconic-font.min.css">
		<link rel="stylesheet" type="text/css" href="../Camp/Cadet_Login/vendor/animate/animate.css">
		<link rel="stylesheet" type="text/css" href="../Camp/Cadet_Login/vendor/css-hamburgers/hamburgers.min.css">
		<link rel="stylesheet" type="text/css" href="../Camp/Cadet_Login/vendor/animsition/css/animsition.min.css">
		<link rel="stylesheet" type="text/css" href="../Camp/Cadet_Login/vendor/select2/select2.min.css">
		<link rel="stylesheet" type="text/css" href="../Camp/Cadet_Login/vendor/daterangepicker/daterangepicker.css">
		<link rel="stylesheet" type="text/css" href="../Camp/Cadet_Login/css/util.css">
		<link rel="stylesheet" type="text/css" href="../Camp/Cadet_Login/css/main.css">
	</head>
	<body>
		<div class="limiter">
			<div class="container-login100">
				<div class="wrap-login100">
					
					<form class="login100-form validate-form" method="post">
						<span class="login100-form-title">
							<img src="../Resources/images/logo.png">
						</span>
						<BR>
						
						<div class="wrap-input100 validate-input" data-validate = " Enter Incharge Username">
							<input class="input100" type="text" title="Please Enter Incharge Username" name="txtusername" id="txtuser" value="<?php if(isset($_SESSION['incharge'])){echo $_SESSION['incharge'];} ?>" focus="true" required>
							<span class="focus-input100 p-b-20" data-placeholder="OFFICER USERNAME"></span>
						</div>
						<div class="wrap-input100 validate-input" data-validate = "Enter Password ">
							<input class="input100" type="password"  title="Please Enter Password " name="txtpass" id="txtuser" value="<?php if(isset($_SESSION['pass'])){echo $_SESSION['pass'];} ?>" focus="true" required>
							<span class="focus-input100 p-b-20" data-placeholder="OFFICER PASSWORD"></span>
						</div>
						<div class="container-login100-form-btn" >
							<div class="wrap-login100-form-btn">
								<div class="login100-form-bgbtn"></div>
								<button class="login100-form-btn" name="btnlogin" >
								Login
								</button>
							</div>
						</div>
						
						<div class="text-center p-t-50">
							<a class="txt2" href="Request.php">
								FORGOT PASSWORD?
							</a>
						</div>
					</form>
				</div>
			</div>
		</div>
		<?php
		if(isset($_POST['btnlogin']))
		{
		$sql = "SELECT * FROM school_master where incharge_username = '{$_POST['txtusername']}' and incharge_password='{$_POST['txtpass']}'";
		$result = $con->query($sql);
		while ($row = $result->fetch_assoc()) {
		$id = $row["SC_ID"];
		}
		session_destroy();
		session_start();
		$_SESSION["inLogin_id"] = $id;
		header("Location:Dashboard.php");
		
		//echo "<script>alert('".$id."');</script>";
		}
		?>
		
		<div id="dropDownSelect1"></div>
		<script src="../Camp/Cadet_Login/vendor/jquery/jquery-3.2.1.min.js"></script>
		<script src="../Camp/Cadet_Login/vendor/animsition/js/animsition.min.js"></script>
		<script src="../Camp/Cadet_Login/vendor/bootstrap/js/popper.js"></script>
		<script src="../Camp/Cadet_Login/vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="../Camp/Cadet_Login/vendor/select2/select2.min.js"></script>
		<script src="../Camp/Cadet_Login/vendor/daterangepicker/moment.min.js"></script>
		<script src="../Camp/Cadet_Login/vendor/daterangepicker/daterangepicker.js"></script>
		<script src="../Camp/Cadet_Login/vendor/countdowntime/countdowntime.js"></script>
		<script src="../Camp/Cadet_Login/js/main.js"></script>
	</body>
</html>