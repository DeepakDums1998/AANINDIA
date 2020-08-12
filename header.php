<?php
    session_start();
    include "connection.php";
    if(isset($_SESSION["ADMIN"]))
    {
       
    }
    else
    {
        header("location:../Login.php");
    }
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
            <link href="../Resources/css/bootstrap.min.css" rel="stylesheet">
            <link href="../Resources/css/metisMenu.min.css" rel="stylesheet">
            <link href="../Resources/css/dataTables/dataTables.bootstrap.css" rel="stylesheet">
            <link href="../Resources/css/startmin.css" rel="stylesheet">
            <link href="../Resources/css/font-awesome.min.css" rel="stylesheet" type="text/css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
                            $sql12 = "SELECT * FROM year_master WHERE Y_STATUS = 1";
                            //echo $con->query($sql12)->fetch_assoc()["Y_CODE"];
                         
                        ?> | HQ</a>
                    </div> 
                    <ul class="nav navbar-right navbar-top-links">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-user fa-fw"></i> HQ  <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="../Logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                                         <img src="../Resources/images/logo.png" alt="logo" width="100" height="60">
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
                                <?php
                                    $select = "select * from Login_Master where Login_Id = ".$_SESSION["ADMIN"];
                                    $rs = $con->query($select);
                                    while ($row = $rs->fetch_assoc()) {
                                        if($row["Login_Type_Status"] == 1)
                                        {
                                            $URI = $_SERVER['REQUEST_URI'];
                                            $Path = explode("/", $URI);
                                            ?>
                                          <li>
                                              <a href="<?php if($Path[2] != 'Admin'){ echo '../Admin/';} ?>Dashboard.php"><i class="fa fa-group fa-fw"></i> Enroll Cadet</a>
                                          </li>
                                          <!--
                                          <li>
                                              <a href="<?php if($Path[2] != 'Admin'){ echo '../Admin/';} ?>school_update.php"><i class="fa fa-university fa-fw"></i> Change Cadet School </a>
                                          </li>
                                          <li>
                                              <a href="<?php if($Path[2] != 'Admin'){ echo '../Admin/';} ?>view_cadet.php"><i class="fa fa-bar-chart-o fa-fw"></i> View Cadet</a>
                                          </li>
                                          <li>
                                              <a href="<?php if($Path[2] != 'Admin'){ echo '../Admin/';} ?>state_master.php"><i class="fa fa-stack-exchange fa-fw"></i> State Master</a>
                                          </li> --> 
                                            <li>
                                                <a href="<?php if($Path[2] != 'Admin'){ echo '../Admin/';} ?>city_master.php"><i class="fa fa-tasks fa-fw"></i> City Master</a>
                                            </li>
                                            <li>
                                                <a href="<?php if($Path[2] != 'Admin'){ echo '../Admin/';} ?>school_master.php"><i class="fa fa-university fa-fw"></i> School Master</a>
                                            </li>
                                            <li>
                                                <a href="<?php if($Path[2] != 'Admin'){ echo '../Admin/';} ?>year_master.php"><i class="fa fa-yoast fa-fw"></i> Year Master</a>
                                            </li>
                                            <li>
                                                <a href="<?php if($Path[2] != 'Admin'){ echo '../Admin/';} ?>officer_master.php"><i class="fa fa-cubes fa-fw"></i> Officer Master </a>
                                            </li>
                                            <li>
                                                <a href="<?php if($Path[2] != 'Camp'){ echo '../Camp/';} ?>Dashboard.php"><i class="fa fa-cubes fa-fw"></i> Camp Form Assign </a>
                                            </li>
                                             <li>
                                                <a href="Guidelines.php"><i class="fa fa-book"></i> Guidelines </a>
                                            </li>
                                            <li>
                                <a href="#"><i class="fa fa-wrench fa-fw"></i> Fees Management<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                   <li>
                                      <a href="feesmanagement.php"><i class="fa fa-money"></i> Manage Fees </a>
                                  </li>
                                    <li>
                                        <a href="feespaymentdate.php"><i class="fa fa-calendar-o"></i> Fees Payment Date</a>
                                    </li>
                                    <li>

                                        <a href="Feesreport.php"><i class="fa fa-desktop"></i> Fees Reports</a>
                                    </li>
                                    
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                                             
                                            <?php
                                        }
                                        if($row["Login_Type_Status"] == 2)
                                        {
                                            ?>
                                            <li>
                                                <a href="Dashboard.php"><i class="fa fa-group fa-fw"></i> Enroll Cadet</a>
                                            </li>
                                            <?php
                                        }
                                        if($row["Login_Type_Status"] == 3)
                                        {
                                            ?>
                                            <li><a href="Dashboard.php"><i class="fa fa-group fa-fw"></i> New Camp </a></li>
                                            <li>
                                                <a href="#"><i class="fa fa-tasks fa-fw"></i> Assign To School </a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fa fa-tasks fa-fw"></i> Assign To Cadet </a>
                                            </li>
                                            <li>
                                                <a href="Camp_form_assign.php"><i class="fa fa-cubes fa-fw"></i> Camp Form Assign </a>
                                            </li>
                                             
                                            <?php
                                        }
                                    }
                                ?>
                                </li>
                            </ul>
                            <?php
                                if(isset($_SESSION["erno"]))
                                {
                                    ?>
                                        <div style="border:1px solid red;margin-top: 10px;color:red;">
                                            <center>
                                                <h4>Last Action Enrollment Id</h4>
                                                <h3>
                                                    <?php
                                                        if(isset($_SESSION["erno"]))
                                                        {
                                                            echo $_SESSION["erno"];
                                                        }
                                                    ?>
                                                </h1>
                                            </center>
                                        </div>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </nav>