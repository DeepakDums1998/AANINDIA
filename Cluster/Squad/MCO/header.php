<?php
include '../../../connection.php';
session_start();
if(!isset($_SESSION["Id"]))
{
    header("location:../Squad_login.php");
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
        <title>AAN INDIA | CADET_ENTRY_SRO</title>
        <link href="../../../Resources/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../../Resources/css/metisMenu.min.css" rel="stylesheet">
        <link href="../../../Resources/css/dataTables/dataTables.bootstrap.css" rel="stylesheet">
        <link href="../../../Resources/css/startmin.css" rel="stylesheet">
        <link href="../../../Resources/css/font-awesome.min.css" rel="stylesheet" type="text/css">  
    </head>
    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">AAN CAMP 2019 | 
                        <?php
                        $sql = "select * from squad_master where S_No = ".$_SESSION["Id"];
                        $res = $con->query($sql);
                        while ($row = $res->fetch_assoc()) {
                            if($row["U_Type"] == 1)
                            {
                                echo "MCO";
                            }
                            if($row["U_Type"] == 2)
                            {
                                echo "SRO";
                            }
                            if($row["U_Type"] == 3)
                            {
                                echo "CADET ENTRY SQUAD - ".$row["CS_No"];
                            }
                        }
                        ?>
                    </a>
                </div>
                
                <ul class="nav navbar-right navbar-top-links">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> SRO  <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="../Logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <a href="index.php">
                            <center><li class="sidebar-search">
                                <div class="input-group custom-search-form">

                                     <img src="../../../Resources/images/logo.png" alt="logo" width="100" height="60">
                                
                                </div>
                            </li></center>
                              </a>
                            <li>                
                                <a href="index.php"><i class="fa fa-group fa-fw"></i>Outpass Entry</a>    
                                    </li>
                            
                            
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>