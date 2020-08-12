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
         <b>Update School Here</b>
      </div>
      <form role="form" method="Post" enctype="multipart/form-data">
        <?php
          $tcode = "";
          $scname = "";
          $shortname = "";
          $iname = "";
          $inumber = "";
          $sql = "select * from school_master where SC_ID = ".$_GET["id"];
          $res = $con->query($sql);
          while ($row = $res->fetch_assoc()) {
            $tcode = $row["TROOP_CODE"];
            $scname = $row["SC_NAME"];
            $shortname = $row["SC_SHORT_NAME"];
            $iname = $row["SC_INCHARGE_NAME"];
            $inumber = $row["SC_INCHARGE_NUMBER"];

        }
        ?>
         <div class="panel-body">
            <div class="row">
              <div class="col-lg-4">
                  <div class="form-group">
                     <label>Troop Code / Reg Number</label>
                     <input type="text" pattern="[0-9]{4}" maxlength="4" class="form-control" placeholder="Ex :- 0006" name="school_code" value="<?php echo $tcode; ?>">
                  </div>
              </div>

              <div class="col-lg-4">
                  <div class="form-group">
                     <label>Select State</label>
                     <select class="form-control" name="state_name" onchange="fetch_city(this.value);">
                        <option selected="">Select State</option>
                       <?php
                      $state_id = 1;
                      $q = "select * from school_master where SC_ID = ".$_GET["id"];
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
              </div>

              <div class="col-lg-4">
                  <div class="form-group">
                     <label>Select City</label>
                     <select class="form-control" name="City_name" id="City_name">
                      <?php
                      $city_id = 1;
                      $q = "select * from school_master where SC_ID = ".$_GET["id"];
                      $res = $con->query($q);
                      while ($row = $res->fetch_assoc()) {
                        $state_id = $row["C_ID"];
                      }

                      $query = "select * FROM city_master order by CITY_NAME DESC";
                      $rs = $con->query($query);
                      while($row = $rs->fetch_assoc())
                      {
                        ?>
                        <option value="<?php echo $row["C_ID"]; ?>"  <?php 
                        if($row["C_ID"] == $city_id)
                          { echo "selected"; }
                        ?> ><?php echo $row["CITY_NAME"]; ?></option>
                        <?php
                      }
                       ?>
                     </select>
                  </div>
              </div>

              <div class="col-lg-4">
                  <div class="form-group">
                     <label>School Name</label>
                     <input style="text-transform: uppercase;" class="form-control" placeholder="PPSV" name="school_name" value="<?php echo $scname; ?>">
                  </div>
              </div>

               <div class="col-lg-4">
                  <div class="form-group">
                     <label>School Short Name</label>
                     <input style="text-transform: uppercase;" class="form-control" placeholder="PPSV" name="school_short_name" value="<?php echo $shortname; ?>">
                  </div>
              </div>

              <div class="col-lg-4">
                  <div class="form-group">
                     <label>Incharge Name</label>
                     <input style="text-transform: uppercase;" class="form-control" placeholder="Bimal Ghelani" name="incharge_name" value="<?php echo $iname; ?>">
                  </div>
              </div>

              <div class="col-lg-4">
                  <div class="form-group">
                     <label>Incharge Number</label>
                     <input type="number" class="form-control" placeholder="0123456789" name="incharge_no" value="<?php echo $inumber; ?>">
                  </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group" style="margin-top: 25px;">
                  <button type="submit" name="btnschool" class="btn btn-success">Update School</button>
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
    $sql = "select * from school_master where troop_code = ".$_POST["school_code"];
    $res = $con->query($sql);
    while ($row = $res->fetch_assoc()) {
      $count = 1;
    }

    
      $sname = strtoupper($_POST["school_name"]);
      $shortname=strtoupper($_POST["school_short_name"]);
      $scode=strtoupper($_POST["school_code"]);
      $stname=strtoupper($_POST["state_name"]);
      $cname=strtoupper($_POST["City_name"]);
      $iname=strtoupper($_POST["incharge_name"]);
      $inumber=strtoupper($_POST["incharge_no"]);
      $sql = "update school_master  set SC_NAME = '". $sname ."',TROOP_CODE = '".$scode."',SC_SHORT_NAME = '".$shortname."', SC_INCHARGE_NAME = '".$iname."', SC_INCHARGE_NUMBER = '".$inumber."', STATE_ID = '".$stname."', C_ID = '".$cname."' where SC_ID= ".$_GET["id"];

      
      if($con->query($sql) == TRUE)
      {
        echo "<script>function delay(){window.location.href = 'school_master.php';}</script>";
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
      <script>Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'School Update successfully...',
        showConfirmButton: false,
        timer: 1500
      }); setInterval(delay,2000);</script>";
      }
    
    else
    {
      echo "<script>alert('Already Exists.');</script>";
    }
    
  }
}

 ?>

</div>
<br>




<?php include '../footer.php'; ?>