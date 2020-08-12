<?php
session_start();
ob_start();
if(isset($_SESSION["Login_id"]))
{

}
else
{
  header("Location:Login.php");
}
include '../../connection.php';
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
            <link href="../../Resources/css/bootstrap.min.css" rel="stylesheet">
            <link href="../../Resources/css/metisMenu.min.css" rel="stylesheet">
            <link href="../../Resources/css/dataTables/dataTables.bootstrap.css" rel="stylesheet">
            <link href="../../Resources/css/startmin.css" rel="stylesheet">
            <link href="../../Resources/css/font-awesome.min.css" rel="stylesheet" type="text/css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script>
            </script>
        </head>
        <body>
            <div id="wrapper">
                <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
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
                    <ul class="nav navbar-right navbar-top-links">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-user fa-fw"></i> HQ  <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
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
                                         <img src="../../Resources/images/logo.png" alt="logo" width="100" height="60">
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
                                                <a href="Dashboard.php"><i class="fa fa-group fa-fw"></i> Home</a>
                                            </li>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<div id="page-wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<b><h4 class="page-header">Change Password</b></h4>

</b>
</div>
</div>

<div>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">
<b style="color: red;">Change Password Form (Recommended)</b>
</div>
<form method="Post" enctype="multipart/form-data">
               <div class="panel-body">
                <div class="row">
                  <?php
                    $sel = "select password from enroll_master where e_id = '".$_SESSION["Login_id"]."'";
                    $res = $con->query($sel);
                    if($res->fetch_assoc()["password"] != NULL)
                    {
                      ?>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label>Old Password</label>
                          <input type="password" class="form-control" name="old_pass">
                        </div>
                      </div>
                      <?php
                    }
                  ?>
                  
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label>New Password</label>
                      <input type="password" class="form-control" name="new_pass">
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label>Retype New Password</label>
                      <input type="password" class="form-control" name="retype_pass">
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <input type="submit" style="margin-top: 25px;" value="changed" class="btn btn-primary" name="btnsubmit">
                    </div>
                  </div>
                </div>                
</div>
</form>
</div>
</div>
                </div>
              </div>
              <?php
                if(isset($_POST["btnsubmit"]))
                {
                    $sel = "select password from enroll_master where e_id = '".$_SESSION["Login_id"]."'";
                    $res = $con->query($sel);
                    if($res->fetch_assoc()["password"] == NULL)
                    {
                      $new_pass = $_POST["new_pass"];
                      $retype_pass = $_POST["retype_pass"];
                      if($new_pass == $retype_pass)
                      {
                        $up = "update enroll_master set password = '".$new_pass."' where e_id = '".$_SESSION["Login_id"]."'";
                        if($con->query($up) == TRUE)
                        {
                          header("Location:Dashboard.php");
                        }
                      }
                    }
                    else
                    {
                      $sel = "select password from enroll_master where e_id = '".$_SESSION["Login_id"]."'";
                      $res = $con->query($sel);
                      if($res->fetch_assoc()["password"] == $_POST["old_pass"])
                      {
                        $new_pass = $_POST["new_pass"];
                        $retype_pass = $_POST["retype_pass"];
                        if($new_pass == $retype_pass)
                        {
                          $up = "update enroll_master set password = '".$new_pass."' where e_id = '".$_SESSION["Login_id"]."'";
                          if($con->query($up) == TRUE)
                          {
                            header("Location:Dashboard.php");
                          }
                        }
                    }
                }
              }
              ?>
        <script src="../../Resources/js/jquery.min.js"></script>
        <script src="../../Resources/js/bootstrap.min.js"></script>
        <script src="../../Resources/js/metisMenu.min.js"></script>
        <script src="../../Resources/js/dataTables/jquery.dataTables.min.js"></script>
        <script src="../../Resources/js/dataTables/dataTables.bootstrap.min.js"></script>
        <script src="../../Resources/js/metisMenu.min.js"></script>
        <script src="../../Resources/js/startmin.js"></script>
        <script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>
    </body>
</html>