<?php 
include '../header.php';
include '../connection.php';
       ?>
<!-- Page Content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<div id="page-wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<b><h4 class="page-header">Year Master</b></h4>
<div>
<div class="row">
<div class="col-lg-12">
   <div class="panel panel-default">
      <div style="color: red;" class="panel-heading">
         <b>Add New Year Here</b>
      </div>
      <form method="Post" enctype="multipart/form-data">
         <div class="panel-body">
            <div class="row">

      <div class="col-lg-12">
                  <div class="form-group">
                     <label>Enter Year</label>
                     <input class="form-control" placeholder="Ex :- 2019" name="txtyear" autofocus="TRUE" required="TRUE">
                  </div>
                   <button type="submit" name="btnaddyear" class="btn btn-success">Create New Year</button>

               
               </div>   
          </div>
            <!-- /.col-lg-12 -->
         </div>
          <div class="col-lg-2">
                
               </div>
   </div>
</div>
</form>
<?php 
  if (isset($_POST["btnaddyear"])) {
    $count = 0;
$check = "select * from year_master where Y_CODE = '".$_POST["txtyear"]."'";
$res = $con->query($check);
while ($row = $res->fetch_assoc()) {
  $count = 1;
}
if($count == 0){

  $sql = "INSERT INTO year_master(Y_CODE, Y_STATUS) VALUES ('".$_POST["txtyear"]."',1)";
  if($con->query($sql) == TRUE)
  {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
      <script>Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Year Add successfully...',
        showConfirmButton: false,
        timer: 1500
      });</script>";
  }
}
else
{
  echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
      <script>Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Year Already Exits...',
        showConfirmButton: false,
        timer: 1500
      });</script>";
}
}
?>
</div>
<br>
<div>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">
<b>TRAINING YEAR REPORT</b>
</div>
<!-- /.panel-heading -->
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
<?php
   $query = "select * FROM year_master order by Y_ID DESC limit 5";
   $rs = $con->query($query);  
   ?>
<thead>
<tr>
<th>Sr.No</th>
<th>Year</th>
</tr>
</thead>
<tbody>
<?php
   $count = 0;
   while($row = $rs->fetch_assoc())
   {
       $count = $count + 1;
       if($count == 1)
       {
        echo "<tr>";
        echo "<td><b>".$count."</b></td>";
        echo "<td><b>".$row['Y_CODE']."</b></td>";
        echo "</tr>";
       }
       else
       {
        echo "<tr>";
        echo "<td>".$count."</td>";
        echo "<td><b>".$row['Y_CODE']."</b></td>";
        echo "</tr>";
    }
   }
   ?>
</tbody>   
</div>
<?php include '../footer.php'; ?>