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
         <b>Update State Here</b>
      </div>
      <form method="post" enctype="multipart/form-data">
        <?php
                                  $sname = "";
                                  $scode = "";
                                  $sql = "select * from state_master where STATE_ID = ".$_GET["id"];
                                  $res = $con->query($sql);
                                  while ($row = $res->fetch_assoc()) {
                                    $sname = $row["STATE_NAME"];
                                    $scode = $row["STATE_CODE"];
                                  }
                                ?>
         <div class="panel-body">
            <div class="row">

      <div class="col-lg-10">
                  <div class="form-group">
                     <label>State Name</label>
                     <input style="text-transform: uppercase;" class="form-control" placeholder="Ex :- GUJARART" name="state_name" value="<?php echo $sname; ?>">
                  </div>
            

               
              
                  <div class="form-group">
                     <label>State Code</label>
                     <input style="text-transform: uppercase;" class="form-control" placeholder="GUJ" name="state_code" value="<?php echo $scode; ?>">
                  </div>
                   <button type="submit" name="btnstate" class="btn btn-success">Update State</button>

                  
          </div>
            <!-- /.col-lg-12 -->
         </div>
         
                 
            
   </div>
</div>
</form>
<?php
if (isset($_POST["btnstate"])) {
  $na = strtoupper($_POST["state_name"]);
  $code= strtoupper($_POST["state_code"]); 

  $sql = "update state_master set STATE_NAME = '". $na ."', STATE_CODE = '". $code ."' where STATE_ID = ".$_GET["id"];
  if($con->query($sql))
  {
    echo "<script>function delay(){window.location.href = 'state_master.php';}</script>";
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
                  <script>Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'State Update Successfully.',
                    showConfirmButton: false,
                    timer: 1500
                  });setInterval(delay,2000);</script>";
  }
  
  else
  {
    echo "asdsadsa";
  }
}

?>
</div>
<br>

<?php include '../footer.php'; ?>