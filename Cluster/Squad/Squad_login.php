<?php
	include '../../connection.php';
    session_start();
    if(isset($_SESSION["Id"]))
    {
        $sql = "select * from squad_master where S_No =".$_SESSION["Id"];
        $res = $con->query($sql);
        while ($row = $res->fetch_assoc()) {
            if($row["U_Type"] == 1)
            {
                header("location:MCO/index.php");
            }
            if($row["U_Type"] == 2)
            {
                header("location:index.php");
            }
            if($row["U_Type"] == 3)
            {
                header("location:index.php");
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<title>AAN INDIA | CLUSTER </title>
<head>
<style type="text/css">
.my-container:before {
    content: ' ';
    display: block;
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
    background-image: url('../../Resources/images/banner1.jpeg');
    background-repeat: no-repeat;
    background-size: 100% 100%;
}
.my-container img {
    z-index: 2;
    position: relative;
}
.my-container form {
    text-align: center;
    z-index: 1;
    position: relative;
} 
.my-container input {
	outline: none;
} 
.my-container input[type=text] {
	padding-left: 10px;
    z-index: 1;
    position: relative;
    height: 30px;
    width: 340px;
    margin-bottom: 10px;
    border: 1px solid black;
    border-radius: 2px;
    box-shadow: -1px 2px black;
} 
.my-container input[type=Password] {
	padding-left: 10px;
    z-index: 1;
    position: relative;
    height: 30px;
    width: 340px;
    margin-bottom: 10px;
    border: 1px solid black;
    border-radius: 2px;
    box-shadow: -1px 2px black;
}
.my-container input[type=Submit] {
	padding-left: 10px;
    z-index: 1;
    position: relative;
    height: 40px;
    width: 150px;
    border-radius: 30px;
    background-color: white;
    border:1px solid black;
    cursor: pointer;
    box-shadow: -1px 2px black;
} 
.my-container input[type=Submit]:hover {
	background-color: white;
	color: black;
} 
</style>
<script src="../js/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        if(getQueryVariable("ERROR") != false)
        {
            var data = getQueryVariable("ERROR").replace(/%20/g," ");
            alert(data);
            window.location.href = "../AAN Camp 2019/Login.php";
        }
        function getQueryVariable(variable)
        {
           var query = window.location.search.substring(1);
           var vars = query.split("&");
           for (var i=0;i<vars.length;i++) {
                var pair = vars[i].split("=");
                if(pair[0] == variable)
                {
                    return pair[1];
                }
           }
           return(false);
        }
    });
</script>	
</head>
<body class="my-container">
    <div>
		<center>
		<form method="post" style="width: 400px;margin-top: 190px;padding: 20px 20px 20px 20px;border-radius: 10px;background-color: transparent;">
            <img src="../../Resources/images/logo.png" height="50px">
			<input type="text" name="txtsquadname" placeholder="Enter Squad Id" style="margin-top: 20px;" required=""><br/>
			<input type="Password" name="txtpassword" placeholder="Enter Squad Password" required=""><br/>
			<input type="submit" name="btnsubmit" value="Login">
		</form>
        </center>
	</div>
	<?php
        if(isset($_POST["btnsubmit"]))
		{
            $squadid = $_POST["txtsquadname"];
            $pass = $_POST["txtpassword"];
            $type = 0;
            $C_Id = explode("-", $squadid)[0];
            if(strpos($squadid, "MCO") == true)
            {
                $type = 1;
                $select = "select * from squad_master where (C_ID = ".$C_Id." and U_type = ".$type.") and password = '".$pass."'" ;
                $rs = $con->query($select);
                while ($row = $rs->fetch_assoc()) {
                    echo "<script>alert('".$row["S_No"]."');</script>";
                    $flag = 1;
                    $_SESSION["Id"] = $row["S_No"];
                    $_SESSION["Cluster_Id"] = $row["C_ID"];
                    header("location:MCO/index.php");
                }
            }
            else if (strpos($squadid, "SRO") == true) {
                $type = 2;
                $select = "select * from squad_master where (C_ID = ".$C_Id." and U_type = ".$type.") and password = '".$pass."'" ;
                $rs = $con->query($select);
                while ($row = $rs->fetch_assoc()) {
                    echo "<script>alert('".$row["S_No"]."');</script>";
                    $flag = 1;
                    $_SESSION["Id"] = $row["S_No"];
                    $_SESSION["Cluster_Id"] = $row["C_ID"];
                    header("location:index.php");
                }
            }
            else
            {
                $type = 3;
                $flag = 0;
                $sid = explode("-", $squadid)[1];
                $sno = str_replace("squad", "", strtolower($sid));
                $select = "select * from squad_master where (CS_No = ".$sno . " and C_ID = ".$C_Id." and U_type = ".$type.") and password = '".$pass."'" ;
                $rs = $con->query($select);
                while ($row = $rs->fetch_assoc()) {
                    $flag = 1;
                    $_SESSION["Id"] = $row["S_No"];
                    $_SESSION["Camp_Id"] = $row["C_ID"];
                    header("location:index.php");
                }

            }
			


        }
	?>
</body>
</html>