<?php
    include '../connection.php';
    session_start();
    if(isset($_SESSION["Clust"]))
    {
        
    }
    else
    {
        header("location:Cluster_Login.php");
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
            <title>AAN INDIA | CLUSTER</title>
            <link href="../Resources/css/bootstrap.min.css" rel="stylesheet">
            <link href="../Resources/css/metisMenu.min.css" rel="stylesheet">
            <link href="../Resources/css/dataTables/dataTables.bootstrap.css" rel="stylesheet">
            <link href="../Resources/css/startmin.css" rel="stylesheet">
            <link href="../Resources/css/font-awesome.min.css" rel="stylesheet" type="text/css">
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
                            echo $con->query($sql12)->fetch_assoc()["Y_CODE"];
                          
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
                                  <a href="#"><i class="fa fa-tasks fa-fw"></i> Home </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>