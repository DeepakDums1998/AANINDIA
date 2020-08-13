<?php
session_start();
ob_start();
$_SESSION["Login_id"]=22090;
if(isset($_SESSION["Login_id"]))
{
}
else
{
header("Location:Login.php");
}
include '../../../connection.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>AAN INDIA | CADET_ENTRY</title>
    <link href="../../../Resources/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../Resources/css/metisMenu.min.css" rel="stylesheet">
    <link href="../../../Resources/css/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../../../Resources/css/startmin.css" rel="stylesheet">
    <link href="../../../Resources/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
    $("#Search").keypress(function(){
    $.ajax({
    type: 'post',
    url: 'load_erno.php',
    data: {
    get_option: val
    },
    success: function (response) {
    // alert(response);
    var data = response.split("_");
    var counter;
    var options = "<option>-----select-----</option>";
    for(counter = 0;counter < data.length-1;counter++)
    {
    options = options + "<option>"+data[counter]+"</option>";
    }
    document.getElementById("state").innerHTML = options;
    }
    });
    });
    });
    </script>
    <script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  </head>
  <body>
    <div id="wrapper">
      <nav class="navbar navbar-inverse " role="navigation">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <div class="navbar-header">
          <a class="navbar-brand" href="#">AAN YEAR
            <?php
            $sql12 = "SELECT * FROM `year_master` ORDER BY Y_ID DESC LIMIT 1";
            echo $con->query($sql12)->fetch_assoc()["Y_CODE"];
            
          ?> | HQ</a>
        </div>
        <div style="float: right;"   id="google_translate_element"></div>
        <ul class="nav navbar-right navbar-top-links">
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="fa fa-user fa-fw"></<i></i> HQ  <b class="caret"></b>
            </a>
            <ul class="dropdown-menu dropdown-user">
              <li><a href="myprofile.php"><i class="fa fa-user-circle-o"></i> Your Profile</a>
            </li>
            <li><a href="Logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
          </li>
        </ul>
      </li>
    </ul>
    <div class="navbar-default sidebar" role="navigation">
      <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
          <a href="#">
            <center><li class="sidebar-search">
              <div class="input-group custom-search-form">
                <img src="../../../Resources/images/logo.png" alt="logo" width="100" height="60">
              </div>
            </li></center>
          </a>
          <li class="sidebar-search">
            <div class="input-group custom-search-form">
              <input type="text" id="Search" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="button">
                <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </li>
          <li>
            <li>
              <a href="../Dashboard.php"><i class="fa fa-group fa-fw"></i> Home</a>
            </li>
        </li>
        <li>
          <li class="nav-item">
            <a class="nav-link collapsed text-truncate" href="#submenu1" data-toggle="collapse" data-target="#submenu1"><i class="fa fa-table"></i> Course <span class="fa arrow"></span>
          </a>
          <ul class="nav nav-second-level">
            <li>
              <li>
                <a href="coursedashboard.php"> <i class="fa fa-list-alt"></i> Module</a>
              </li>
            </li>
            <li>
              <li>
                <a href="ViewGuidelines.php"><i class="fa fa-book"></i> Guidelines
                </a>
              </li>
            </li>
            <li>
              <li>
                <a href="Progress.php"><i class="fa fa-bar-chart"></i> Progress</a>
              </li>
            </li>
          </ul>
          </li>
        </li>
        
        <li>
          <li>
            <a href="../FeesPayment.php"><i class="fa fa-credit-card"></i> Fees Payment
            <img style="float: right;" src="../../../Resources/images/new.gif"></a>
          </li>
        </li>
        <li>
          <li>
            <a href="../fees_details.php"><i class="fa fa-print"></i> Fees Details</a>
          </li>
        </li>
      </ul>
    </div>
  </div>
</nav>