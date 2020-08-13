<?php
require_once("header.php");

$sel = "select password from enroll_master where e_id = '".$_SESSION["Login_id"]."'";
$res = $con->query($sel);
if($res->fetch_assoc()["password"] == NULL)
{
  header("location:change_pass.php");
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
 <div id="google_translate_element"></div>
<div id="page-wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<b><h4 class="page-header">Camp Details</b></h4>

</b>
</div>
</div>

<div>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">
<b>CAMP FORMS</b>
</div>
<!-- /.panel-heading -->
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
<thead>
<tr>
<th>Sr.No</th>
<th>Camp Code</th>
<th>Camp Type</th>
<th>View</th>
<th>Download</th>
</tr>
</thead>
<tbody>
  <tr>
       
  </tr>
</tbody>   
</div>

                </div>


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