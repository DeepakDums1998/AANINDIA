<?php
include '../connection.php';
include '../header.php';
?>
<!-- Page Content -->
<script src="../Resources/js/jquery.min.js"></script>
<script type="text/javascript">

    $.ajax({
       type: 'post',
       url: 'get_schools.php',
       data: {
         set_state:0,
         set_camp_Id:<?php echo $_GET["Id"]; ?>
       },
       success: function (response) {
        document.getElementById("camp_school").innerHTML = response;
       }
     });

    $("#camp_state").change(function(){
      var state = $("#camp_state").val();
      $.ajax({
       type: 'post',
       url: 'get_schools.php',
       data: {
         set_state:state,
         set_camp_Id:<?php echo $_GET["Id"]; ?>
       },
       success: function (response) {
        document.getElementById("camp_school").innerHTML = response;
       }
     });
    });
</script>
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <b><h4 class="page-header">Camp Forms</b></h4>
        <div>
          <div class="row">
            <div class="col-lg-12">
             <div class="panel panel-default">
              <div style="color: red;" class="panel-heading">
               <b>Report Of Camp</b>
             </div>
             <form method="Post" enctype="multipart/form-data">
               <div class="panel-body">
                <div class="row">
                  <div class="col-lg-2">
                    <div class="form-group">
                      <label>Camp State</label>
                      <select class="form-control"  name="camp_state" id="camp_state">
                        <option value="0">All State</option>
                        <?php
                          $state = array();
                          $sql = "select * from school_assign,school_master where school_master.SC_ID = school_assign.school_Id and school_assign.camp_Id = ".$_GET["Id"];
                          $res = $con->query($sql);
                          while ($row = $res->fetch_assoc()) {
                            array_push($state, $row["STATE_ID"]);
                          }

                          $state = array_unique($state);
                          foreach ($state as $value) {
                            $statesql = "select * from state_master where STATE_ID = ".$value;
                            echo "<option value='".$con->query($statesql)->fetch_assoc()["STATE_ID"]."'>".$con->query($statesql)->fetch_assoc()["STATE_CODE"]."</option>";
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-4">
                  	<div class="form-group">
                      <label>Camp School</label>
                      <select class="form-control" name="camp_school" id="camp_school">
                        <option value="0">All School</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group">
                      <label>Cadet No</label>
                      <input type="text" class="form-control" name="cadet_no" id="cadet_no">
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group">
                      <button type="submit" style="margin-top: 25px;" name="btnsubmit" id="btnsubmit" class="btn btn-success">Genrate PDF</button>
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
      $state = $_POST["camp_state"];
      $state_array = array();
      $troop_code = $_POST["camp_school"];
      $school_array = array();
      $no = $_POST["cadet_no"];
      $no_array = array();

      if($state == 0)
      {
        $sqlstate = "select * from school_assign,school_master where school_master.SC_ID = school_assign.school_Id";
        $resstate = $con->query($sqlstate);
        while ($row = $resstate->fetch_assoc()) {
          array_push($state_array, $row["STATE_ID"]);
        }
        $state_array = array_unique($state_array);
      }
      else
      {
        array_push($state_array, $state);
      }

      if($troop_code == 0)
      {
        $sql = "select * from school_assign,school_master where school_master.SC_ID = school_assign.school_Id";
        $res = $con->query($sql);
        while ($row = $res->fetch_assoc()) {
          array_push($school_array, $row["TROOP_CODE"]."&(gender = '".$row["squad_type"]."')");
        }
      }
      else
      {
        $school_state = "select * from school_master where TROOP_CODE = '".$troop_code."' and (";
        foreach ($state_array as $vstate) {
          $school_state = $school_state . " STATE_ID = ".$vstate." or";
        }
        $school_state = substr($school_state, 0,-3);
        $school_state = $school_state . " )";
        
        $sql = "select * from school_assign where school_Id = ".($con->query($school_state)->fetch_assoc()["SC_ID"])." and camp_Id = ".$_GET["Id"];

        $gendersql = $con->query($sql);
        $gender = "( ";
        while ($row = $gendersql->fetch_assoc()) {
          $sqlsquad_type = "select * from squad_master where S_No = ".$row["squad_no"];
          $gender = $gender . "gender = '".$con->query($sqlsquad_type)->fetch_assoc()["S_type"]."' or ";
        }
        $gender = substr($gender, 0,-3);
        $gender = $gender . " )";
        array_push($school_array, $troop_code."&".$gender);
      }

      $query = "select * from enroll_master where (";
      
      foreach ($state_array as $vstate) {
        $sql = "select * from state_master where STATE_ID = ".$vstate;
        $query = $query . "enrollment_id like '%".$con->query($sql)->fetch_assoc()["STATE_CODE"]."%' or ";
      }
      $query = substr($query, 0,-3);
      $query = $query . ") and (";
      
      foreach ($school_array as $vschool) {
        $query = $query . " ( enrollment_id like '%".explode("&", $vschool)[0]."%' and ".explode("&", $vschool)[1]." ) or ";
      }
      $query = substr($query, 0,-3);

      $sqltype = "select * from camp_master where srno = ".$_GET["Id"];

      $enrollment_no = "";

      if($no != null and $no != "")
      {
        $enrollment_no = "and enrollment_id like '%".$no."%' ";
      }

      $query = $query . ") {$enrollment_no} and ".strtolower(explode("-", $con->query($sqltype)->fetch_assoc()["Camp_Id"])[1]) . " = 1 and c_year = '20".explode("-", $con->query($sqltype)->fetch_assoc()["Camp_Id"])[0]."'";

      $_SESSION["query"] = $query;
      
      echo $query;

       echo "<script>window.location.replace('view_camp_form.php?Id=".$_GET["Id"]."');</script>";
    }

    include '../footer.php';
    ?>