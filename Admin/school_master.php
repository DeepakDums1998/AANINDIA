<?php
include '../header.php';
include '../connection.php';
       ?>
<script src="jquery.min.js"></script>
<script>
  function fetch_city(val)
  {
      $.ajax({
          type: 'post',
          url: 'load_city.php',
          data: {
              get_option: val
          },
          success: function (response) {
              document.getElementById("City_name").innerHTML = response;
          }
      });
  }
</script>
<div id="page-wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<b><h4 class="page-header">School Master</b></h4>
<div>
<div class="row">
<div class="col-lg-12">
   <div class="panel panel-default">
      <div style="color: red;" class="panel-heading">
         <b>Add School Here</b>
      </div>
      <form role="form" method="Post" enctype="multipart/form-data">
         <div class="panel-body">
            <div class="row">
              <div class="col-lg-4">
                  <div class="form-group">
                     <label>Troop Code / Reg Number</label>
                     <input type="text" pattern="[0-9]{4}" maxlength="4" class="form-control" placeholder="Ex :- 0006" name="school_code">
                  </div>
              </div>

              <div class="col-lg-4">
                  <div class="form-group">
                     <label>Select State</label>
                     <select class="form-control" name="state_name" onchange="fetch_city(this.value);">
                        <option selected="">Select State</option>
                        <?php
                      $query = "select * FROM state_master order by STATE_NAME ASC";
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
              </div>

              <div class="col-lg-4">
                  <div class="form-group">
                     <label>Select City</label>
                     <select class="form-control" name="City_name" id="City_name">
                     </select>
                  </div>
              </div>

              <div class="col-lg-4">
                  <div class="form-group">
                     <label>School Name</label>
                     <input style="text-transform: uppercase;" class="form-control" placeholder="PPSV" name="school_name">
                  </div>
              </div>

               <div class="col-lg-4">
                  <div class="form-group">
                     <label>School Short Name</label>
                     <input style="text-transform: uppercase;" class="form-control" placeholder="PPSV" name="school_short_name">
                  </div>
              </div>

              <div class="col-lg-4">
                  <div class="form-group">
                     <label>Incharge Name</label>
                     <input style="text-transform: uppercase;" class="form-control" placeholder="Bimal Ghelani" name="incharge_name">
                  </div>
              </div>

              <div class="col-lg-4">
                  <div class="form-group">
                     <label>Incharge Number</label>
                     <input type="number" class="form-control" placeholder="0123456789" name="incharge_no">
                  </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group" style="margin-top: 25px;">
                  <button type="submit" name="btnschool" class="btn btn-success">Register School</button>
                </div>
              </div>


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
if(isset($_POST["btnschool"]))
{
  if($_POST["school_code"] >= 0001 && $_POST["school_code"] <= 9999)
  {
    $count = 0;
    $sql = "select * from school_master where TROOP_CODE = ".$_POST["school_code"];
    $res = $con->query($sql);
    while ($row = $res->fetch_assoc()) {
      $count = 1;
    }

    if($count == 0)
    {
      $sql = "INSERT INTO school_master (SC_NAME,SC_SHORT_NAME,TROOP_CODE,STATE_ID,C_ID,SC_INCHARGE_NAME,SC_INCHARGE_NUMBER,SC_STATUS) VALUES ('".strtoupper($_POST["school_name"])."','".strtoupper($_POST["school_short_name"])."','".$_POST["school_code"]."',".strtoupper($_POST["state_name"]).",".$_POST["City_name"].",'". strtoupper($_POST["incharge_name"]) ."','". $_POST["incharge_no"] ."',1)";
      if($con->query($sql) == TRUE)
      {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
      <script>Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'School Add successfully...',
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
        title: 'Thid School Already Exists.',
        showConfirmButton: false,
        timer: 1500
      });</script>";
    }
    
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
OFFICER REPORT
</div>
<!-- /.panel-heading -->
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
<?php
   $query = "select * FROM school_master  
ORDER BY SC_ID DESC";
   $rs = $con->query($query);  
   ?>
<thead>
<tr>
<th>Sr.No</th>
<th>School Name</th>
<th>Troop Code</th>
<th>Incharge Name</th>
<th>Incharge No</th>
<th>Status</th>
<th>Edit</th>
<th>Enable/Disble</th>
</tr>
</thead>
<tbody>
<?php
  if(isset($_GET["did"]))
  {
    $query = "update school_master set SC_STATUS = 0 where SC_ID = ".$_GET["did"];
    
    if($con->query($query)){
      echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
      <script>Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'School Disable successfully...',
        showConfirmButton: false,
        timer: 1500
      });</script>";
    } 
  }
  if(isset($_GET["eid"]))
  {
    $query = "update school_master set SC_STATUS = 1 where SC_ID = ".$_GET["eid"];
    
    if($con->query($query)){
      echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
      <script>Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'School Enable successfully...',
        showConfirmButton: false,
        timer: 1500
      });</script>";
    } 
  }
   $query = "select * FROM school_master order by SC_STATUS DESC";
   $rs = $con->query($query);
   $count = 0;
   while($row = $rs->fetch_assoc())
   {
       $count = $count + 1;
       
        echo "<tr>";
        echo "<td>".$count."</td>";
        echo "<td><b>".$row['SC_NAME']."</b></td>";
        echo "<td><b>".$row['TROOP_CODE']."</b></td>";
        echo "<td><b>".$row['SC_INCHARGE_NAME']."</b></td>";
        echo "<td><b>".$row['SC_INCHARGE_NUMBER']."</b></td>";
        echo "<td><b>".$row['SC_STATUS']."</b></td>";
        echo "<td><a href='EditSchool.php?id=".$row['SC_ID']."'>Edit</a></td>";
        if($row['SC_STATUS'] == 1){
            echo "<td><a href='school_master.php?did=".$row['SC_ID']."' style='color:red' name='btndelete'>Disable</a></td>";
        }
        else{
          echo "<td><a href='school_master.php?eid=".$row['SC_ID']."' style='color:red' name='btndelete'>Enable</a></td>";
        }
        echo "</tr>";
    
   }
   ?>
</tbody>   
</div>
<?php include '../footer.php'; ?>