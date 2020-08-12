<?php
    include 'connection.php';
?>
<!DOCTYPE html>
<html>
<title>AAN INDIA | CAMP 2019</title>
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
    opacity: 0.7500;
    background-image: url('Resources/images/banner1.jpeg');
    background-repeat: no-repeat;
    background-size: 100% 100%;
}
.my-container img {
    padding-top: 190px;
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
    border: 0.1px solid black;
    border-radius: 2px;
} 
.my-container input[type=Password] {
    padding-left: 10px;
    z-index: 1;
    position: relative;
    height: 30px;
    width: 340px;
    margin-bottom: 10px;
    border: 0.1px solid black;
    border-radius: 2px;
}
.my-container input[type=Submit] {
    padding-left: 10px;
    z-index: 1;
    position: relative;
    height: 40px;
    width: 150px;
    border-radius: 30px;
    background-color: transparent;
    color: white;
    border:1px solid white;
    cursor: pointer;
} 
.my-container input[type=Submit]:hover {
    background-color: white;
    color: black;
} 
</style>
<script src="js/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        if(getQueryVariable("ERROR") != false)
        {
            var data = getQueryVariable("ERROR").replace(/%20/g," ");
            alert(data);
            window.location.href = "/AAN Camp 2019/Login.php";
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
        <center><img src="Resources/images/logo.png" height="50px" style="padding-bottom: 10px;"></center>
        <form method="post">
            <input type="text" name="txtusername" placeholder="Enter Username"><br/>
            <input type="Password" name="txtpassword" placeholder="Enter Password"><br/>
            <input type="submit" name="btnsubmit" value="Login">
        </form>
    </div>
    <?php
        session_start();
        if(isset($_SESSION["ADMIN"]))
        {
            $select = "select * from Login_Master where Login_Id = ".$_SESSION["ADMIN"];
            $rs = $con->query($select);
            $count = 0;
            while ($row = $rs->fetch_assoc()) {
                if($row["Login_Type_Status"] == 1)
                {
                    header("location:Admin/Dashboard.php");
                }
                if($row["Login_Type_Status"] == 2)
                {
                    header("location:Cadet_Entry/Dashboard.php");
                }
                if($row["Login_Type_Status"] == 3)
                {
                    header("location:Camp/Dashboard.php");
                }
            }
        }
        if(isset($_POST["btnsubmit"]))
        {
            $select = "select * from Login_Master where Login_Username = '".$_POST["txtusername"]."' and Login_Password = '".$_POST["txtpassword"]."'";
            $rs = $con->query($select);
            $count = 0;
            while ($row = $rs->fetch_assoc()) {
                $count = 1;
                if($row["Login_active_deactive_Status"] == 0)
                {
                    echo "<script>alert('This User Is Block By The Admin');</script>";
                    break;
                }
                $_SESSION["ADMIN"] = $row["Login_Id"];
                if($row["Login_Type_Status"] == 1)
                {
                    header("location:Admin/Dashboard.php");
                }
                if($row["Login_Type_Status"] == 2)
                {
                    header("location:Cadet_Entry/Dashboard.php");
                }
                if($row["Login_Type_Status"] == 3)
                {
                    header("location:Camp/Dashboard.php");
                }
            }
            if($count == 0)
            {
                echo "<script>alert('Please Enter Valid Username and Password');</script>";
            }
        }
    ?>
</body>
</html>