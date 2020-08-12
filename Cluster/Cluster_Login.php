<?php
	include '../connection.php';
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
    background-image: url('../Resources/images/banner1.jpeg');
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
    background-color: transparent;
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
		<form method="post" style="width: 400px;margin-top: 190px;padding: 20px 20px 20px 20px;border-radius: 10px;background-color: white;box-shadow: 5px 10px black; ">
            <img src="../Resources/images/logo.png" height="50px">
            <h3 style="opacity: 1;">CLUSTER LOGIN</h3>
			<input type="text" name="txtclustername" placeholder="Enter Cluster Name" required=""><br/>
			<input type="Password" name="txtpassword" placeholder="Enter Cluster Password" required=""><br/>
			<input type="submit" name="btnsubmit" value="Login">
		</form>
        </center>
	</div>
	<?php
	    session_start();
        if(isset($_POST["btnsubmit"]))
		{
			$select = "select * from cluster_master where Cluster_Name = '".$_POST["txtclustername"]."' and Clust_Password = '".$_POST["txtpassword"]."' and Clust_Status = 1";
			$rs = $con->query($select);
			$count = 0;
			while ($row = $rs->fetch_assoc()) {
				$count = 1;
                $_SESSION["Clust"] = $row["Clust_Id"];
                header("location:Dashboard.php");
			}
			if($count == 0)
			{
                echo "<script>alert('Please Enter Valid Username and Password');</script>";
            }
        }
	?>
</body>
</html>