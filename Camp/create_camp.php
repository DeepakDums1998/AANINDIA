<?php
include '../connection.php';
include '../header.php';
?>
<style type="text/css">
  li{
    font-size: 13px;
    text-align: left;
  }
</style>
<!-- Page Content -->
<script src="../Resources/js/jquery.min.js"></script>
<script type="text/javascript">
  $.ajax({
   type: 'post',
   url: 'load_year.php',
   data: {
     get_option: "yearload"
   },
   success: function (response) {
     var data = response.split("_");
     document.getElementById("camp_year").innerHTML = data;
   }
 });

  $(document).ready(function(){
    $("#camp_type").change(function(){
      var year = $("#camp_year").val();
      var type = $("#camp_type").val();

      if(year != "")
      {
        if(type!= "")
        {
          $.ajax({
           type: 'post',
           url: 'find_camp_id.php',
           data: {
             set_year:year,
             set_type:type
           },
           success: function (response) {
             $("#camp_id").val(response);
             //$("#btnsubmit").click();
           }
         });
        }
        else
        {
          alert("Please Select Type...");
        }
      }
      else{
        alert("Please Select Year...");
      }
    });
  });
</script>
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <b><h4 class="page-header">Create Camp</b></h4>
        <div>
          <div class="row">
            <div class="col-lg-12">
             <div class="panel panel-default">
              <div style="color: red;" class="panel-heading">
               <b>Add New Camp Here</b>
             </div>
             <form method="Post" enctype="multipart/form-data">
               <div class="panel-body">
                <div class="row">
                  <div class="col-lg-2">
                    <div class="form-group">
                      <label>Camp Year</label>
                      <select class="form-control"  name="camp_year" id="camp_year">
                        <option>select year</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group">
                      <label>Camp Type</label>
                      <select class="form-control" name="camp_type" id="camp_type">
                        <option>select type</option>
                        <option>ATC</option>
                        <option>STC</option>
                        <option>OTC</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-gr1oup">
                      <label>Camp Id</label>
                      <input class="form-control" type="number" name="camp_id" id="camp_id" readonly="">
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group">
                      <label>Camp Start Date</label>
                      <input class="form-control" type="date" name="Camp_startdate" id="Camp_startdate">
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group">
                      <label>Camp End Date</label>
                      <input class="form-control" type="date" name="Camp_enddate" id="Camp_enddate">
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group">
                      <label>No Of Squads</label>
                      <input class="form-control" type="number" name="Camp_NOS" id="Camp_NOS">
                    </div>
                  </div>
                </div>
                <div class="row">
                  
                  
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label>Form Front Page</label>
                      <input class="form-control" type="file" name="form_f" id="form_f">
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label>Form Back Page</label>
                      <input class="form-control" type="file" name="form_b" id="form_b">
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <button type="submit" style="margin-top: 25px;" name="btnsubmit" id="btnsubmit" class="btn btn-success">Create Camp</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>

    </div>

    <?php
    if(isset($_POST["btnsubmit"]))
    {
      $year = $_POST["camp_year"];
      $type = $_POST["camp_type"];
      $id = $_POST["camp_id"];
      $camp_id = $year."-".$type."-".$id;

      $camp_startdate = date("Y/m/d",strtotime($_POST["Camp_startdate"]));
      $camp_enddate = date("Y/m/d",strtotime($_POST["Camp_enddate"]));
      $cluster_id = $_GET["Id"];
      $NOS = $_POST["Camp_NOS"];

      $errorflag = 0;
      $errormsg = "<ul>";
      if($year == 0)
      {
        $errormsg = $errormsg . "<li>Please Select Camp Year</li>";
        $errorflag = 1;
      }
      if($type == "select type")
      {
        $errormsg = $errormsg . "<li>Please Select Camp Type</li>";
        $errorflag = 1;
      }
      if($_FILES["form_f"]["error"] != 0) {
        $errormsg = $errormsg . "<li>Please Select Camp Front Page</li>";
        $errorflag = 1;
      }
      if($_FILES["form_b"]["error"] != 0) {
        $errormsg = $errormsg . "<li>Please Select Camp Back Page</li>";
        $errorflag = 1;
      }
      $errormsg = $errormsg . "</ul>";

      if($errorflag == 0)
      {
        $campcount = 0;
        $campres = 0;
        $campsql = "select count(*) as 'count' from camp_master where Cluster_Id = ".$_GET["Id"];
        $campcount = $con->query($campsql)->fetch_assoc()["count"];

        $clustersql = "select * from cluster_master where Clust_Id = ".$_GET["Id"];
        $campres = $con->query($clustersql)->fetch_assoc()["NOF_Camp"];

        if((strtotime(date("Y/m/d",strtotime($con->query($clustersql)->fetch_assoc()["Clust_Start_date"]))) < strtotime($camp_startdate)) && (strtotime(date("Y/m/d",strtotime($con->query($clustersql)->fetch_assoc()["Clust_End_date"]))) > strtotime($camp_enddate))) 
        {
          if($campcount >= $campres)
          {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
              <script>Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'All Camps Already Created...',
                showConfirmButton: false,
                timer: 1500
              });</script>";
          }
          else
          {
            $Front_image = "f".$year."-".$type."-".$id.".jpg";
            $Back_image = "b".$year."-".$type."-".$id.".jpg";

            $targetFilePath = "../Resources/images/camp_forms/";

            move_uploaded_file($_FILES["form_f"]["tmp_name"], $targetFilePath.$Front_image);
            move_uploaded_file($_FILES["form_b"]["tmp_name"], $targetFilePath.$Back_image);
            $sql = "insert into camp_master(Camp_Id,Camp_startdate,Camp_enddate,Cluster_Id,NOS,Main_Page_Form,Back_Page_Form,SMS_Status,Camp_Status,Camp_C_Time) values('{$camp_id}','{$camp_startdate}','{$camp_enddate}',{$cluster_id},{$NOS},'{$Front_image}','{$Back_image}',0,1,'".date('Y/m/d H:i')."')";

            if($con->query($sql) == TRUE)
            {
              $camp = "select * from camp_master order by srno limit 1";
              $camp_id = $con->query($camp)->fetch_assoc()["srno"];
              $cluster_id = $con->query($camp)->fetch_assoc()["Cluster_Id"];
              for ($i=1; $i <= $NOS; $i++) { 
                $sno = "".$i;
                $squad = "insert into squad_master(CS_No,Password,U_Type,C_ID,S_Status,S_C_Time) values(".$sno.",'".random_num(12)."',3,".$camp_id.",1,'".date('Y/m/d H:i')."')";
                if($con->query($squad) == TRUE)
                {
                  
                }
              }

              echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
              <script>Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Camp Create successfully...',
                showConfirmButton: false,
                timer: 1500
              });</script>";

              
            }
          }
        }
        else
        {
          echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
              <script>Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Please Select Camp Date Between ". $con->query($clustersql)->fetch_assoc()["Clust_Start_date"] ." To ". $con->query($clustersql)->fetch_assoc()["Clust_End_date"] ."',
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
                icon: 'error',
                title: '".$errormsg."',
                showConfirmButton: false,
                timer: 1500
              });</script>";
      }
      
    }

    function random_num($size) {
      $alpha_key = '';
      $keys = range('A', 'Z');
      
      for ($i = 0; $i < 2; $i++) {
        $alpha_key .= $keys[array_rand($keys)];
      }
      
      $length = $size - 2;
      
      $key = '';
      $keys = range(0, 9);
      
      for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
      }
      
      return $alpha_key . $key;
    }

    ?>

<div>
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <b>CAMP REPORT</b>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <?php
                  $query = "SELECT * FROM camp_master where Cluster_Id = ".$_GET["Id"];
                  $rs = $con->query($query);  
                  ?>
                  <thead>
                    <tr>
                      <th>Sr.No</th>
                      <th>Camp Id</th>
                      <th>Camp Start Date</th>
                      <th>Camp End Date</th>
                      <th>Cluster Name</th>
                      <th>No Of Squad</th>
                      <th>Add Camps</th>
                      <th>Camp Forms</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
  
   $count = 0;
   while($row = $rs->fetch_assoc())
   {
       $count = $count + 1;
       echo "<tr>";
        echo "<td>".$count."</td>";
        echo "<td><b>".$row['Camp_Id']."</b></td>";
        echo "<td><b>".$row['Camp_startdate']."</b></td>";
        echo "<td><b>".$row['Camp_enddate']."</b></td>";
        $sql = "select * from cluster_master where Clust_Id = ".$row['Cluster_Id'];
        echo "<td><b>".$con->query($sql)->fetch_assoc()["Cluster_Name"]."</b></td>";
        echo "<td><b>".$row['NOS']."</b></td>";
        echo "<td><b><a href='Add_School.php?Id=".$row['srno']."'>Add Schools</a></b></td>";
        echo "<td><b><a href='Camp_Forms.php?Id=".$row['srno']."'>Camp Forms</a></b></td>";
        echo "</tr>";
  }
  ?>
</tbody>   
</div>
    <?php
    include '../footer.php';
    ?>