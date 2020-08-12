<?php
include '../connection.php';
include '../header.php';
?>
<!-- Page Content -->
<script src="../Resources/js/jquery.min.js"></script>
<script type="text/javascript">
  var malecount = 0;
  var femalecount = 0;
  var total = 0;
  
  $(document).ready(function(){

    $.ajax({
   type: 'post',
   url: 'load_state.php',
   data: {
     get_option: "stateload"
   },
   success: function (response) {
     var data = response.split("_");
     document.getElementById("school_state").innerHTML = data;
   }
 });
  });

  function checkschool(data,cid,sid,male,female,squadtype,squadno)
  {
   if(squadtype == 1)
   {
    squadtype = "M";
   } 
   else
   {
    squadtype = "F";
   }
    if($("#"+data.id).prop("checked") == true){
        malecount = malecount + male;
        femalecount = femalecount + female;
        total = total + (male + female);
        $.ajax({
         type: 'post',
         url: 'assign_school.php',
         data: {
           set_cid: cid,
           set_sid: sid,
           no: squadno,
           opration: "I"
         },
         success: function (response) {
          
         }
       });
    }
    else if($("#"+data.id).prop("checked") == false){
        malecount = malecount - male;
        femalecount = femalecount - female;
        total = total - (male + female);
        $.ajax({
         type: 'post',
         url: 'assign_school.php',
         data: {
           set_cid: cid,
           set_sid: sid,
           no: squadno,
           opration: "D"
         },
         success: function (response) {
          
         }
       });
    }
    document.getElementById("pcount").innerHTML = '<span style="font-size: 17px;">Male - <span style="color: red;"><b> ' + malecount + '</b></span> Female - <span style="color: red;"><b>' + femalecount + '</b></span> Total - <span style="color: red;"><b>' + total + '</b></span></span>';
  }
</script>
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <b><h4 class="page-header">Adding Schools</b></h4>
        <div>
          <div class="row">
            <div class="col-lg-12">
             <div class="panel panel-default">
              <div style="color: red;" class="panel-heading">
               <b>Add School In 
                <?php
                $sql = "select * from camp_master where srno = ".$_GET["Id"];
                $res = $con->query($sql);
                echo $res->fetch_assoc()["Camp_Id"];
                ?>
              </b>
            </div>
            <form method="Post" enctype="multipart/form-data">
             <div class="panel-body">
              <div class="row">
                <div class="col-lg-3">
                  <div class="form-group">
                    <label>Select State</label>
                    <select class="form-control"  name="school_state" id="school_state">
                      <option>select state</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <label>Select gender</label>
                    <select class="form-control"  name="squad_gender" id="squad_gender">
                      <option value="1">Male</option>
                      <option value="2">Female</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <label>Select squad</label>
                    <select class="form-control"  name="squad_no" id="squad_no">
                      <?php
                        $nos = 0;
                        $squadno = "select * from squad_master where  C_ID = ".$_GET["Id"];
                        $res =$con->query($squadno);
                        while ($row = $res->fetch_assoc()) {
                          echo "<option value='".$row["S_No"]."'>Squad".$row["CS_No"]."</option>";
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <button type="submit" style="margin-top: 25px;" name="btnsubmit" id="btnsubmit" class="btn btn-success">Show Schools</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>

  </div>
  <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <b>SQUAD'S</b>
          </div>
          <div class="panel-body">
            <div class="table table-striped table-bordered table-hover">
              <table class="table">
                <thead>
                  <tr>
                    <th>Squads</th>
                    <th>Schools</th>
                    <th>Edit</th>
                  </tr>
                </thead>
                <tbody id="squad_school">
                  <?php
                      $squads = "select * from squad_master where C_Id = ".$_GET["Id"];
                      $res = $con->query($squads);
                      while ($row = $res->fetch_assoc()) {
                        echo "<tr><td style='width:120px;'>";
                        if($row["S_type"] == Null)
                        {
                          echo "Squad".$row["CS_No"];
                        }
                        elseif($row["S_type"] == "M")
                        {
                          echo "Squad".$row["CS_No"]." - <b>Male</b>";
                        }
                        else
                        {
                          echo "Squad".$row["CS_No"]." - <b>Female</b>";
                        }
                        echo "</td>";
                        $flag = 0;
                        echo "<td>";
                        $schools = "select * from school_assign,school_master,state_master where state_master.STATE_ID = school_master.STATE_ID and school_master.SC_ID = school_assign.school_Id and squad_no = ".$row["S_No"]." and camp_Id = ".$_GET["Id"];
                        $reschool = $con->query($schools);
                        while ($schoolrow = $reschool->fetch_assoc()) {
                          echo " <b>[ ". $schoolrow["STATE_CODE"] . " - " .$schoolrow["TROOP_CODE"] . " ]</b> ,";
                          $flag = 1;
                        }
                        echo "</td>";
                        
                        if($flag != 0)
                        {
                          echo "<td> <a href='Add_School.php?Id=".$_GET["Id"]."&sid=".$row["S_No"]."'>Edit</a> </td>";
                        }
                        else
                        {
                          echo "<td></td>";
                        }
                        echo "</tr>";
                      }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <b><?php if(isset($_POST["btnsubmit"])){ echo "Selection of ".$_POST["squad_gender"]." Squad for ".$_POST["school_state"]; }else  { echo "SCHOOLS"; } ?></b>
            <?php
              if(isset($_GET["sid"]))
              {

              }
              else
              {
                ?>
                  <div id="pcount" style="float: right;">
              <span style="font-size: 17px;">Male - <span style="color: red;"><b>0</b></span> Female - <span style="color: red;"><b>0</b></span> Total - <span style="color: red;"><b>0</b></span></span>
            </div>
                <?php
              }
            ?>
            
          </div>
          <!-- /.panel-heading -->
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                  <tr>
                    <th>Add</th>
                    <th>Name</th>
                    <th>Troop Code</th>
                    <?php
                      if(isset($_GET["sid"]))
                      {
                          echo "<th>No Of Male</th>";
                      }
                      if(isset($_POST["btnsubmit"]))
                      {
                        if($_POST["squad_gender"] == "1")
                        {
                          echo "<th>No Of Male</th>";
                        }
                        else
                        {
                          echo "<th>No Of Female</th>";
                        }

                      }
                    ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if(isset($_GET["sid"]))
                  {
                    $sql = "select * from school_assign,squad_master where squad_master.S_No = school_assign.squad_no and squad_no = ".$_GET["sid"]." and camp_Id = ".$_GET["Id"];
                    $res = $con->query($sql);
                    while ($row = $res->fetch_assoc()) {
                      $sql = "select * from camp_master where srno = ".$_GET["Id"];
                      $year = "20".explode("-", $con->query($sql)->fetch_assoc()["Camp_Id"])[0];
                      $camp = explode("-", $con->query($sql)->fetch_assoc()["Camp_Id"])[1];
                      $gender = $row["S_type"];
                      $squad_no = $row["squad_no"];

                      $school = "select * from school_master where SC_ID = ".$row["school_Id"];

                      echo "<tr>";

                      $sql = "select count(*) as count,gender from enroll_master where c_year = '".$year."' and enrollment_id like '%".$con->query($school)->fetch_assoc()["STATE_ID"]."%' and enrollment_id like '%".$con->query($school)->fetch_assoc()["TROOP_CODE"]."%' and ".strtolower($camp)." = 1 GROUP BY gender;";
                      $res1 = $con->query($sql);

                      $male = 0;
                      $female = 0;
                      while ($rows = $res1->fetch_assoc()) {
                        if($rows["gender"] == "M")
                        {
                          $male = $rows["count"];
                        }
                        if($rows["gender"] == "F")
                        {
                          $female = $rows["count"];
                        }
                      }

                      $sql1 = "select * from school_master where STATE_ID = ".$con->query($school)->fetch_assoc()["STATE_ID"]." and TROOP_CODE = ".$con->query($school)->fetch_assoc()["STATE_ID"];
                        $squad = "select * from camp_master where srno = ".$_GET["Id"];
                        $result1 = $con->query($squad);
                        
                        if($row["S_type"] == "M")
                        {
                          $click = "checkschool(this,".$_GET["Id"].",".$con->query($school)->fetch_assoc()["SC_ID"].",".$male.",".$female.",1,".$squad_no.");";
                                echo "<tr><td><input type='checkbox' id='check".$con->query($school)->fetch_assoc()["SC_ID"]."' onclick='".$click."' checked/></td><td>".$con->query($school)->fetch_assoc()["SC_NAME"]."</td><td>".$con->query($school)->fetch_assoc()["TROOP_CODE"] . "</td><td>". $male ."</td></tr>";
                          
                        }
                        else
                        {

                          $click = "checkschool(this,".$_GET["Id"].",".$con->query($school)->fetch_assoc()["SC_ID"].",".$male.",".$female.",2,".$squad_no.");";

                                echo "<tr><td><input type='checkbox' id='check".$con->query($school)->fetch_assoc()["SC_ID"]."' onclick='".$click."' checked/></td><td>".$con->query($school)->fetch_assoc()["SC_NAME"]."</td><td>".$con->query($school)->fetch_assoc()["TROOP_CODE"] . "</td><td>". $female ."</td></tr>";
                        }
                        
                      }
                      echo "</tr>";
                    
                    }

                  if(isset($_POST["btnsubmit"]))
                  {
                    $types = "";
                    if($_POST["squad_gender"] == "1")
                    {
                      $types = "M";
                    }
                    else
                    {
                      $types = "F";
                    }

                    $squad_update = "update squad_master set S_type = '{$types}' where S_No = ".$_POST["squad_no"];
                    $con->query($squad_update);
                    if(isset($_GET["sid"]))
                    {
                      echo "<script>window.location.replace('Add_School.php?Id=".$_GET["Id"]."');</script>";
                    }

                    $updatesquad = "";

                    if($_POST["school_state"] != "")
                    {
                      $sql = "select * from camp_master where srno = ".$_GET["Id"];
                      $year = "20".explode("-", $con->query($sql)->fetch_assoc()["Camp_Id"])[0];
                      $camp = explode("-", $con->query($sql)->fetch_assoc()["Camp_Id"])[1];
                      
                      $query = "select * from enroll_master where (";
                      $count = 0;
                      $sql = "select * from school_master where STATE_ID = ".$_POST["school_state"];
                      
                      $res = $con->query($sql);
                      if(mysqli_num_rows($res) != 0)
                      {
                        while ($row = $res->fetch_assoc()) {
                          if($count == 0)
                          {
                            $query = $query . " enrollment_id like '%".$row["TROOP_CODE"]."%'";
                          }
                          else
                          {
                            $query = $query . " or enrollment_id like '%".$row["TROOP_CODE"]."%'";
                          }
                          $count = $count + 1;
                        }
                        $query = $query . ") and ".strtolower($camp)." = 1";

                        //echo $query;

                        $troop_codes = array();
                        $result = $con->query($query);

                        if(mysqli_num_rows($result) != 0)
                        {
                          while ($row = $result->fetch_assoc()) {
                            $g = "";
                            if($_POST["squad_gender"] == "1")
                            {
                              $g = "M";
                            }
                            else
                            {
                              $g = "F";
                            }

                            $assignschools = "select * from school_assign,school_master,squad_master where school_assign.school_id = school_master.SC_ID and squad_master.S_No = school_assign.squad_no and S_type = '".$g."'";
                            $assignschoolsres = $con->query($assignschools);
                            $assigncount = 0;
                            while ($row1 = $assignschoolsres->fetch_assoc()) {
                              if(explode("-", $row["enrollment_id"])[1] == $row1["TROOP_CODE"])
                              {
                                if($row1["camp_Id"] == $_GET["Id"])
                                {
                                  $assigncount = $assigncount + 1;
                                }
                                if($row1["camp_Id"] != $_GET["Id"])
                                {
                                  $assigncount = $assigncount + 1;
                                }
                              }
                            }

                            if($assigncount == 0)
                            {
                              array_push($troop_codes, explode("-", $row["enrollment_id"])[1]);
                            }
                          }

                          $troop_codes = array_unique($troop_codes);
                          $count = 1;
                          foreach ($troop_codes as $value) {
                            $sql = "select count(*) as count,gender from enroll_master where c_year = '".$year."' and enrollment_id like '%".$value."%' and enrollment_id like '%".$_POST["school_state"]."%' and ".strtolower($camp)." = 1 GROUP BY gender;";
                            $res1 = $con->query($sql);

                            $male = 0;
                            $female = 0;
                            while ($row = $res1->fetch_assoc()) {
                              if($row["gender"] == "M")
                              {
                                $male = $row["count"];
                              }
                              if($row["gender"] == "F")
                              {
                                $female = $row["count"];
                              }
                            }

                            $sql = "select * from school_master where STATE_ID = ".$_POST["school_state"]." and TROOP_CODE = ".$value;
                            $squad = "select NOS from camp_master where srno = ".$_GET["Id"];
                            $result1 = $con->query($squad);
                            
                            if($_POST["squad_gender"] == "1")
                            {
                              if($male != 0)
                              {
                                $female = 0;
                                $gender = $_POST["squad_gender"];
                                $click = "checkschool(this,".$_GET["Id"].",".$con->query($sql)->fetch_assoc()["SC_ID"].",".$male.",".$female.",".$gender.",".$_POST["squad_no"].");";
                                echo "<tr><td><input type='checkbox' id='check".$con->query($sql)->fetch_assoc()["SC_ID"]."' onclick='".$click."'/></td><td>".$con->query($sql)->fetch_assoc()["SC_NAME"]."</td><td>".$value . "</td><td>". $male ."</td></tr>";
                              }
                            }
                            else
                            {
                              if($female != 0)
                              {
                                $male = 0;
                                $gender = $_POST["squad_gender"];
                                $click = "checkschool(this,".$_GET["Id"].",".$con->query($sql)->fetch_assoc()["SC_ID"].",".$male.",".$female.",".$gender.",".$_POST["squad_no"].");";
                                echo "<tr><td><input type='checkbox' id='check".$con->query($sql)->fetch_assoc()["SC_ID"]."' onclick='".$click."'/></td><td>".$con->query($sql)->fetch_assoc()["SC_NAME"]."</td><td>".$value . "</td><td>". $female ."</td></tr>";
                              }
                            }
                            $count = $count + 1;
                            
                          }
                        }
                      }

                    }
                    
                  }
                  ?>
                </tbody>
                </table>
                <div class="col-lg-3">
                  <div class="form-group">
                    <form method="post">
                    
                    <button type="submit" name="btnsave" id="btnsave" class="btn btn-success">Save Data</button>
                    </form>
                  </div>
                </div>
                
              </div>
          </div>
        </div>
      </div>
    </div>

              <?php
              if(isset($_POST["btnsave"]))
              {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
        				<script>Swal.fire({
        				  position: 'center',
        				  icon: 'success',
        				  title: 'Your work has been saved',
        				  showConfirmButton: false,
        				  timer: 1500
        				});setInterval(function(){ window.open('/AANINDIA/Camp/Add_School.php?Id=".$_GET["Id"]."','_self'); },1500);</script>";
              }
              include '../footer.php';
              ?>