<?php
include '../connection.php';
include '../header.php';
?>
<style type="text/css">
li{
  text-align: left;
  font-size: 12px;
}
</style>
<!-- Page Content -->
<script src="../Resources/js/jquery.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
<script type="text/javascript">
  $.ajax({
       type: 'post',
       url: 'load_state.php',
       data: {
           get_option: "stateload"
       },
       success: function (response) {
         var data = response.split("_");
         document.getElementById("cluster_state").innerHTML = data;
       }
   });

  $(document).ready(function() {
    $("#cluster_state").change(function(){
      var state = $("#cluster_state").val();
      $.ajax({
       type: 'post',
       url: 'load_city.php',
       data: {
           get_option: state
       },
       success: function (response) {
         var data = response.split("_");
         document.getElementById("cluster_city").innerHTML = data;
       }
      });
    });
  });
</script>
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <b><h4 class="page-header">Create Cluster</b></h4>
        <div>
          <div class="row">
            <div class="col-lg-12">
             <div class="panel panel-default">
              <div style="color: red;" class="panel-heading">
               <b>Add New Cluster Here</b>
             </div>
             <form method="Post" enctype="multipart/form-data">
               <div class="panel-body">
                <div class="row">
                  <div class="col-lg-2">
                    <div class="form-group">
                      <label>Cluster Commandant</label>
                      <select class="form-control" name="commandant_id" id="commandant_id" required="">
                        <option value="0">select</option>
                        <option value="1">Vatsal</option>
                        <option value="2">Pradip</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-2">
                  	<div class="form-group">
                      <label>Cluster Name</label>
                      <input class="form-control" style="text-transform: uppercase;" name="cluster_name" id="cluster_name">
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-gr1oup">
                      <label>Cluster Password</label>
                      <input class="form-control" type="Password" name="cluster_password" id="cluster_password">
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-gr1oup">
                      <label>No of Camps</label>
                      <input class="form-control" type="number" name="cluster_camps" id="cluster_camps">
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group">
                      <label>Cluster Start Date</label>
                      <input class="form-control" type="Date" name="cluster_startdate" id="cluster_startdate">
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group">
                      <label>Cluster End Date</label>
                      <input class="form-control" type="Date" name="cluster_enddate" id="cluster_enddate">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Cluster Address</label>
                      <textarea class="form-control" name="cluster_address" id="cluster_address" style="height: 34px;resize: none;"></textarea>
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group">
                      <label>Cluster State</label>
                      <select class="form-control" name="cluster_state" id="cluster_state">
                        <option></option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group">
                      <label>Cluster City</label>
                      <select class="form-control" name="cluster_city" id="cluster_city">
                        <option></option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group">
                      <label>Cluster Zipcode</label>
                      <input class="form-control" name="cluster_zipcode" id="cluster_zipcode">
                    </div>
                  </div>
                </div> 
                <div class="row">
                  <div class="col-lg-2">
                    <div class="form-group">
                      <button type="submit" name="btnsubmit" class="btn btn-success">Create Cluster</button>
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
        $commandant_id = $_POST["commandant_id"];
        $cluster_name = strtoupper($_POST["cluster_name"]);
        $cluster_password = $_POST["cluster_password"];
        $NOC = $_POST["cluster_camps"];
        $start_date = date("Y/m/d",strtotime($_POST["cluster_startdate"]));
        $end_date = date("Y/m/d",strtotime($_POST["cluster_enddate"]));
        $address = strtoupper($_POST["cluster_address"]);
        $city = $_POST["cluster_city"];
        $zipcode = $_POST["cluster_zipcode"];

        $errorflag = 0;
        $errormsg = "<ul>";
        if($commandant_id == 0)
        {
          $errorflag = 1;
          $errormsg = $errormsg . "<li>Please Select Cluster Commandand.</li>";
        }
        if($cluster_name == NULL)
        {
          $errorflag = 1; 
          $errormsg = $errormsg . "<li>Please Enter A Cluster Name.</li>"; 
        }
        elseif(!preg_match("/^[a-zA-Z0-9]*$/",$cluster_name))
        {
          $errorflag = 1; 
          $errormsg = $errormsg . "<li>Please Enter Valid Cluster Name.</li>";
        }

        if($cluster_password == NULL)
        {
          $errorflag = 1; 
          $errormsg = $errormsg . "<li>Please Enter A Cluster Password.</li>"; 
        }
        elseif(!preg_match("/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/",$cluster_password))
        {
          $errorflag = 1; 
          $errormsg = $errormsg . "<li>Please Make More Secure Password.</li>";
        }
        if($NOC == NULL)
        {
          $errorflag = 1; 
          $errormsg = $errormsg . "<li>Please Enter A Camps.</li>";
        }
        if(!preg_match("/^[0-9]*$/",$NOC))
        {
          $errorflag = 1; 
          $errormsg = $errormsg . "<li>Please Enter Valid Camps Count.</li>";
        }
        $curdate=strtotime(date('Y/m/d'));
        $mydate=strtotime($start_date);

        if($start_date == "1970/01/01")
        {
          $errorflag = 1; 
          $errormsg = $errormsg . "<li>Please Enter A Start Date.</li>";
        }
        elseif($curdate >= $mydate)
        {
          $errorflag = 1; 
          $errormsg = $errormsg . "<li>Please Enter Start Date Greater Then Current Date.</li>";
        }

        $startdate=strtotime($start_date);
        $enddate=strtotime($end_date);
        if($end_date == "1970/01/01")
        {
          $errorflag = 1; 
          $errormsg = $errormsg . "<li>Please Enter A End Date.</li>";
        }
        elseif($startdate > $enddate)
        {
          $errorflag = 1; 
          $errormsg = $errormsg . "<li>Please Enter End Date Greate Then Start Date.</li>";
        }

        if($address == NULL)
        {
          $errorflag = 1; 
          $errormsg = $errormsg . "<li>Please Enter A Cluster Address.</li>"; 
        }
        elseif(preg_match('/^\\d+ [a-zA-Z ]+, \\d+ [a-zA-Z ]+, [a-zA-Z ]+$/', $address))
        {
          $errorflag = 1; 
          $errormsg = $errormsg . "<li>Please Enter Valid Address.</li>";
        }

        if($city == NULL || $city == "select city")
        {
          $errorflag = 1; 
          $errormsg = $errormsg . "<li>Please Select A City.</li>";
        }

        if($zipcode == NULL)
        {
          $errorflag = 1; 
          $errormsg = $errormsg . "<li>Please Enter A Zipcode.</li>";
        }
        elseif (!preg_match("/^[0-9]{6}$/", $zipcode)) {
          $errorflag = 1; 
          $errormsg = $errormsg . "<li>Please Enter Valid Zipcode.</li>"; 
        }
        $errormsg = $errormsg ."</ul>";


        if($errorflag == 1)
        {
          echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
            <script>Swal.fire({
              position: 'center',
              icon: 'warning',
              title: '".$errormsg."'
            });</script>";
        }
        else
        {
          $row_cnt = 0;
          $check = "select * from cluster_master where Cluster_Name = '".$cluster_name."'";
          $res = $con->query($check);
          while ($row = $res->fetch_assoc()) {
            $row_cnt = $row_cnt + 1;
          }
          
          if($row_cnt >=1)
          {
              echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
            <script>Swal.fire({
              position: 'center',
              icon: 'warning',
              title: '".$cluster_name." Cluster Name Is Already Taken By Another Cluster.'
            });</script>";
          }
          else
          {
              $sql = "insert into cluster_master(Command_Id,Cluster_Name,Clust_Password,NOF_Camp,Clust_Address,Clust_City,Clust_Zipcode,Clust_Start_date,Clust_End_date,Clust_Status) values({$commandant_id},'{$cluster_name}','{$cluster_password}',{$NOC},'{$address}',{$city},'{$zipcode}','{$start_date}','{$end_date}',1)";

            if($con->query($sql) == TRUE)
            {
              $sqlclusterid = "select Clust_Id from cluster_master order by Clust_Id DESC limit 1";
              $resclusterid = $con->query($sqlclusterid);
              $clusterid = $resclusterid->fetch_assoc()["Clust_Id"];

              $squadMCO = "insert into squad_master(CS_No,Password,U_Type,C_ID,S_Status, S_C_Time) values(0,'".random_num(12)."',1,".$clusterid.",1,'".date('Y/m/d H:i')."');";
              $con->query($squadMCO);

              $squadSRO = " insert into squad_master(CS_No,Password,U_Type,C_ID,S_Status, S_C_Time) values(0,'".random_num(12)."',2,".$clusterid.",1,'".date('Y/m/d H:i')."');";
              $con->query($squadSRO);

              echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
                <script>Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Cluster Successfully Created...',
                  showConfirmButton: false,
                  timer: 1500
                });</script>";
            }
          }
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
    <br>

    <div>
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <b>CLUSTER CREATION REPORT</b>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <?php
                  $query = "select * FROM cluster_master,city_master where cluster_master.Clust_City = city_master.C_ID";
                  $rs = $con->query($query);  
                  ?>
                  <thead>
                    <tr>
                      <th>Sr.No</th>
                      <th>Cluster Name</th>
                      <th>Command Id</th>
                      <th>NOF Camp</th>
                      <th>Address</th>
                      <th>Cluster Start Date</th>
                      <th>Cluster End Date</th>
                      <th>Add Camps</th>
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
        echo "<td><b>".$row['Cluster_Name']."</b></td>";
        echo "<td><b>".$row['Command_Id']."</b></td>";
        echo "<td><b>".$row['NOF_Camp']."</b></td>";
        echo "<td><b>".($row['Clust_Address']." ".$row['CITY_NAME']." ".$row['Clust_Zipcode'])."</b></td>";
        echo "<td><b>".$row['Clust_Start_date']."</b></td>";
        echo "<td><b>".$row['Clust_End_date']."</b></td>";
        echo "<td><a href='create_camp.php?Id=".$row['Clust_Id']."'>Add Camp</a></td>";
        echo "</tr>";
  }
  ?>
</tbody>   
</div>
<?php
include '../footer.php';
?>