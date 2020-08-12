<?php
include '../header.php';
include '../connection.php';
       ?>
<div id="page-wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<b><h4 class="page-header">State Master</b></h4>
<div>
<div class="row">
<div class="col-lg-12">
   <div class="panel panel-default">
      <div style="color: red;" class="panel-heading">
         <b>Add State Here</b>
      </div>
      <form method="post" enctype="multipart/form-data">
         <div class="panel-body">
            <div class="row">

      <div class="col-lg-10">
                  <div class="form-group">
                     <label>State Name</label>
                     <input style="text-transform: uppercase;" class="form-control" placeholder="Ex :- GUJARART" name="state_name">
                  </div>
            

               
              
                  <div class="form-group">
                     <label>State Code</label>
                     <input style="text-transform: uppercase;" class="form-control" placeholder="GUJ" name="state_code">
                  </div>
                   <button type="submit" name="btnstate" class="btn btn-success">Register State</button>

                  
          </div>
            <!-- /.col-lg-12 -->
         </div>
         
                 
            
   </div>
</div>
</form>
<?php 
if (isset($_POST["btnstate"])) {
  $sql = "INSERT INTO state_master (STATE_NAME,STATE_CODE,STATE_STATUS) VALUES ('".$_POST["state_name"]."','".$_POST["state_code"]."',1)";
  if($con->query($sql) == TRUE)
  {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
                  <script>Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'State Add Successfully.',
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
STATE
</div>
<!-- /.panel-heading -->
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
<thead>
<tr>
<th>Sr.No</th>
<th>State Name</th>
<th>State Code</th>
<th>Status</th>
<th>Edit</th>
<th>Enable/Disble</th>
</tr>
</thead>
<tbody>
<?php

  if(isset($_GET["enchant_dict_describe(dict)"]))
  {
    $query = "update state_master set STATE_STATUS = 0 where STATE_ID = ".$_GET["enchant_dict_describe(dict)"];
    
    if($con->query($query)){
      echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
                  <script>Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'State Disable successfully...',
                    showConfirmButton: false,
                    timer: 1500
                  });</script>";
    } 
  }
  if(isset($_GET["eid"]))
  {
    $query = "update state_master set STATE_STATUS = 1 where STATE_ID = ".$_GET["eid"];
    
    if($con->query($query)){
      echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
                  <script>Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'State Enable successfully...',
                    showConfirmButton: false,
                    timer: 1500
                  });</script>";
    } 
  }
   $query = "select * FROM state_master order by STATE_STATUS DESC";
   $rs = $con->query($query);
   $count = 0;
   while($row = $rs->fetch_assoc())
   {
       $count = $count + 1;
        echo "<tr style='background-color:lightblue;'>";
        echo "<td><b>".$count."</b></td>";
        echo "<td><b>".$row['STATE_NAME']."</b></td>";
        echo "<td><b>".$row['STATE_CODE']."</b></td>";
        echo "<td><b>".$row['STATE_STATUS']."</b></td>";
        echo "<td><a href='EditState.php?id=".$row['STATE_ID']."'>Edit</a></td>";
        if($row['STATE_STATUS'] == 1){
            echo "<td><a href='state_master.php?enchant_dict_describe(dict)=".$row['STATE_ID']."' style='color:red' name='btndelete'>Disable</a></td>";
        }
        else{
          echo "<td><a href='state_master.php?eid=".$row['STATE_ID']."' style='color:red' name='btndelete'>Enable</a></td>";
        }
        echo "</tr>";
   }
   ?>

</tbody>   
</div>
<?php include '../footer.php'; ?>