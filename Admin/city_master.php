<?php
include'../header.php';
include '../connection.php';
if(isset($_GET["did"]))
  {
    $query = "update city_master set C_STATUS = 0 where C_ID = ".$_GET["did"];
    
    if($con->query($query)){
      echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
      <script>Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'City Disable successfully...',
        showConfirmButton: false,
        timer: 1500
      });</script>";
    } 
  }
  if(isset($_GET["eid"]))
  {
    $query = "update city_master set C_STATUS = 1 where C_ID = ".$_GET["eid"];
    
    if($con->query($query)){
      echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
      <script>Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'City Enable successfully...',
        showConfirmButton: false,
        timer: 1500
      });</script>";
    } 
  }
       ?>
<div id="page-wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<b><h4 class="page-header">City Master</b></h4>
<div>
<div class="row">
<div class="col-lg-12">
   <div class="panel panel-default">
      <div style="color: red;" class="panel-heading">
         <b>Add City Here</b>
      </div>
      <form method="post" enctype="multipart/form-data">
         <div class="panel-body">
            <div class="row">

      <div class="col-lg-12">
                       <div class="form-group">
                     <label>Select State</label>
                  
                    <select class="form-control" name="state">
                      <option selected>Select State</option>
                      <?php
                      $query = "select * FROM state_master order by STATE_NAME DESC";
                      $rs = $con->query($query);
                      while($row = $rs->fetch_assoc())
                      {
                        ?>
                        <option value="<?php echo $row["STATE_ID"]; ?>"><?php echo $row["STATE_NAME"]; ?></option>
                        <?php
                      }
                       ?>
                     </select>
                  </div>
                  <div class="form-group">
                     <label>City Name</label>
                     <input style="text-transform: uppercase;" class="form-control" placeholder="SURAT" name="city_name">
                   </div>
                         <button type="submit" name="btncity" class="btn btn-success">Register City</button>
                  </div>
          </div>
            <!-- /.col-lg-12 -->
         </div>
   </div>
</div>
</form>
<?php 
if (isset($_POST["btncity"])) {
  $sql = "INSERT INTO city_master (CITY_NAME,STATE_ID,C_STATUS) VALUES ('".$_POST["city_name"]."','".$_POST["state"]."',1)";
  if($con->query($sql) == TRUE)
  {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
      <script>Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'City Add successfully...',
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
CITY
</div>
<!-- /.panel-heading -->
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
<?php
   $query = "select * FROM city_master order by C_STATUS DESC";
   $rs = $con->query($query);  
   ?>
<thead>
<tr>
<th>Sr.No</th>
<th>City Name</th>
<th>State Name</th>
<th>Status</th>
<th>Edit</th>
<th>Enable/Disble</th>
</tr>
</thead>
<tbody>
<?php
   $count = 0;
   while($row = $rs->fetch_assoc())
   {
       $count = $count + 1;
       
        echo "<tr style='background-color:lightblue;'>";
        echo "<td><b>".$count."</b></td>";
        echo "<td><b>".$row['CITY_NAME']."</b></td>";
        $query1="select * from state_master where  STATE_ID=".$row["STATE_ID"];
        $rs1=$con->query($query1);
        if($row1 = $rs1->fetch_assoc())
        {
          echo "<td><b>".$row1['STATE_NAME']."</b></td>";  
        }
        echo "<td><b>".$row['C_STATUS']."</b></td>";
        echo "<td><a href='EditCity.php?did=".$row['C_ID']."'>Edit</a></td>";
        if($row['C_STATUS'] == 1){
            echo "<td><a href='city_master.php?did=".$row['C_ID']."' style='color:red' name='btndelete'>Disable</a></td>";
        }
        else{
          echo "<td><a href='city_master.php?eid=".$row['C_ID']."' style='color:red' name='btndelete'>Enable</a></td>";
        }
        echo "</tr>";                   
   }
   ?>
   
</tbody>   
</div>
<?php include '../footer.php'; ?>