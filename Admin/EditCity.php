<?php
include'../header.php';
include '../connection.php';
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
         <b>Update City Here</b>
      </div>
      <form method="post" enctype="multipart/form-data">
        <?php
                                  
                                  $name = "";
                                  $sql = "select * from city_master where C_ID = ".$_GET["did"];
                                  $res = $con->query($sql);
                                  while ($row = $res->fetch_assoc()) {
                                    $name = $row["CITY_NAME"];
                                  }
                                ?>
         <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
                  <div class="form-group">
                     <label>Select State</label>
                  
                    <select class="form-control" name="state">
                      <option selected>Select State</option>
                     
                        <?php
                        $state_id = 1;
                        $q = "select * from city_master where C_ID = ".$_GET["did"];
                        $res = $con->query($q);
                        while ($row = $res->fetch_assoc()) {
                          $state_id = $row["STATE_ID"];
                        }

                        $query = "select * FROM state_master order by STATE_NAME DESC";
                        $rs = $con->query($query);
                        while($row = $rs->fetch_assoc())
                        {
                          ?>
                          <option value="<?php echo $row["STATE_ID"]; ?>"  <?php 
                          if($row["STATE_ID"] == $state_id)
                            { echo "selected"; }
                          ?> ><?php echo $row["STATE_NAME"]; ?></option>
                          <?php
                        }
                         ?>
                     </select>
                  </div>    
                  <div class="form-group">
                     <label>City Name</label>
                     <input style="text-transform: uppercase;" id="name" class="form-control"  name="cname" value="<?php echo $name; ?>">
                   </div>
                         <button type="submit" name="btncity" class="btn btn-success">Update City</button>
              </div>
            </div>
            <!-- /.col-lg-12 -->
         </div>
   </div>
</div>
</form>
<?php
if (isset($_POST["btncity"])) {
  $na = strtoupper($_POST["cname"]); 
  $state=strtoupper($_POST["state"]);
  $sql = "update city_master set CITY_NAME = '". $na ."', STATE_ID = '". $state ."' where C_ID = ".$_GET["did"];
  if($con->query($sql))
  {
    echo "<script>function delay(){window.location.href = 'city_master.php';}</script>";
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
      <script>Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'City Update successfully...',
        showConfirmButton: false,
        timer: 1500
      }); setInterval(delay,2000);</script>";
    
  }
}
?>
</div>
<br>



<!-- /.panel-heading -->
<?php include '../footer.php'; ?>