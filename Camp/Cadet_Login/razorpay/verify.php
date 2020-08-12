<?php
session_start();
ob_start();
if(isset($_SESSION["Login_id"]))
{

}
else
{
  header("Location: ../Login.php");
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
                                            <li>
                                                <a href="../FeesPayment.php"><i class="fa fa-credit-card"></i> Fees Payment<img style="float: right;" src="../../../Resources/images/new.gif"></a>
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

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<div id="page-wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<b><h4 class="page-header">Fees Details</b></h4>

</b>
</div>
</div>

<div>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">
<b>Fees Payment For Year</b>
</div>
<!-- /.panel-heading -->
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
<thead>
<tr>
<th>Enrollment ID</th>
<th>Year</th>
<th>For training Year</th>
<th>Transaction id</th>
<th>Fees Amount Paid</th>
<th>Download Receipt</th>

</tr>
<?php

require('config.php');

@session_start();

require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true && empty($_POST['razorpay_payment_id']) === false)
{
     $sql = "INSERT INTO fees_payment(payment_id, order_id, signature_hash, created_date, e_id, amount, recipt_id , year,fees_for_year) VALUES ('".$_POST['razorpay_payment_id']."','".$_SESSION['razorpay_order_id']."','".$_POST['razorpay_signature']."',CURRENT_TIMESTAMP,'".$_SESSION["Login_id"]."','".$_SESSION['Payment_details']['amount']."','".$_SESSION['Payment_details']['merchant_order_id']."',YEAR(CURRENT_DATE),'".$_SESSION['Payment_details']['for_year']."')";
      //  echo $sql;
    // echo $con->query($sql);
     if($con->query($sql) == TRUE)
     {
        //22090
            $update_year="UPDATE enroll_master SET t_year= (SELECT t_year FROM enroll_master WHERE e_id ='".$_SESSION["Login_id"]."') + 1 , c_year = (SELECT c_year FROM enroll_master WHERE e_id ='".$_SESSION["Login_id"]."')+1 WHERE e_id = '".$_SESSION["Login_id"]."'";
            //echo $update_year;
             if($con->query($update_year) == TRUE)
             {
                $sql="SELECT * FROM enroll_master WHERE e_id ='".$_SESSION["Login_id"]."'";
                $get_year=$con->query($sql)->fetch_assoc()["t_year"];
                $atc=0;
                $stc=0;
                $otc=0;
                if($get_year == 3)
                {
                     $atc=1;
                }
                else if($get_year == 4)
                {
                     $stc=1;
                }
                else if($get_year == 5)
                {
                     $otc=1;
                }
                $tc="UPDATE enroll_master SET atc={$atc} , stc={$stc} , otc={$otc} where e_id ={$_SESSION["Login_id"]}";
               // echo $tc;
                $receipt="SELECT * from fees_payment where e_id={$_SESSION["Login_id"]} and year=YEAR(CURRENT_DATE)";
                if($con->query($tc) == TRUE)
                {
                    ?>
                    <td><?php echo $con->query($sql)->fetch_assoc()["enrollment_id"];  ?></td>
                    <td><?php echo $con->query($sql)->fetch_assoc()["c_year"]; ?></td>
                    <td><?php echo $con->query($receipt)->fetch_assoc()["fees_for_year"]; ?></td>
                    <td><?php echo $con->query($receipt)->fetch_assoc()["payment_id"]; ?></td>
                    <td>&#8377;<?php echo $con->query($receipt)->fetch_assoc()["amount"]; ?></td>
                    <td><a href="../Receipt.php?year=<?php echo $con->query($receipt)->fetch_assoc()["year"]; ?>">Download Receipt</a></td>
                    <?php

            $html = "<p>Your payment was successful<p>";
             }
            }
         }
}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

echo $html;
?>
</thead>
<tbody>
  <tr>
    
       
  </tr>
</tbody>   
</div>
                </div>
        <script src="../../../Resources/js/jquery.min.js"></script>
        <script src="../../../Resources/js/bootstrap.min.js"></script>
        <script src="../../../Resources/js/metisMenu.min.js"></script>
        <script src="../../../Resources/js/dataTables/jquery.dataTables.min.js"></script>
        <script src="../../../Resources/js/dataTables/dataTables.bootstrap.min.js"></script>
        <script src="../../../Resources/js/metisMenu.min.js"></script>
        <script src="../../../Resources/js/startmin.js"></script>
        <script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>
    </body>
</html>
