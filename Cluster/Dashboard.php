<?php
include 'header.php';
?>
<script src="../Resources/js/jquery.min.js"></script>
<script type="text/javascript">
  
</script>
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <b><h4 class="page-header">
          <?php
            $sql = "select * from cluster_master where Clust_Id = ".$_SESSION["Clust"];
            echo $con->query($sql)->fetch_assoc()["Cluster_Name"];
          ?>
         DASHBOARD</h4></b>
        <div>
          <div class="row">
            <div class="col-lg-12">
             <div class="panel panel-default">
              <div style="color: red;" class="panel-heading">
               <b>Cluster Details</b>
             </div>
             <div class="panel-body">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                       <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>Title</th>
                              <th>Value</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                                
                                $sql = "select * from cluster_master where Clust_Id = ".$_SESSION["Clust"];
                                $Name = $con->query($sql)->fetch_assoc()["Cluster_Name"];
                                $city = "select * from city_master where C_ID = ".$con->query($sql)->fetch_assoc()["Clust_City"];
                                $state = "select * from state_master where STATE_ID = ".$con->query($city)->fetch_assoc()["STATE_ID"];
                                $Address = $con->query($sql)->fetch_assoc()["Clust_Address"].",".$con->query($city)->fetch_assoc()["CITY_NAME"].",".$con->query($state)->fetch_assoc()["STATE_NAME"]." - ".$con->query($sql)->fetch_assoc()["Clust_Zipcode"];
                                $nofcamp = $con->query($sql)->fetch_assoc()["NOF_Camp"];
                                $startdate = $con->query($sql)->fetch_assoc()["Clust_Start_date"];
                                $enddate = $con->query($sql)->fetch_assoc()["Clust_End_date"];
                              ?>
                            <tr>
                              <th>Name</th>
                              <td><?php echo $Name; ?></td>
                            </tr>
                            <tr>
                              <th>Address</th>
                              <td><?php echo $Address; ?></td>
                            </tr>
                            <tr>
                              <th>No Of Camps</th>
                              <td><?php echo $nofcamp . " [ ";
                                $camps = "select * from camp_master where Cluster_Id = ".$_SESSION["Clust"];
                                $res = $con->query($camps);
                                while ($row = $res->fetch_assoc()) {
                                  echo explode("-", $row["Camp_Id"])[1].",";
                                }
                                echo " ]";
                               ?></td>
                            </tr>
                            <tr>
                              <th>Clsuter Stating Date</th>
                              <td><?php echo $startdate; ?></td>
                            </tr>
                            <tr>
                              <th>Clsuter Ending Date</th>
                              <td><?php echo $enddate; ?></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div>
          <div class="row">
            <div class="col-lg-12">
             <div class="panel panel-default">
              <div style="color: red;" class="panel-heading">
               <b>Camp Details</b>
             </div>
             <div class="panel-body">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                       <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>SR NO</th>
                              <th>Camp Id</th>
                              <th>Camp Type</th>
                              <th>No Of Squads</th>
                              <th>Camp Start Date</th>
                              <th>Camp End Date</th>
                              <th>Camp Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <?php
                                $count = 1;
                                $sql = "select * from camp_master where Cluster_Id = ".$_SESSION["Clust"];
                                $res = $con->query($sql);
                                while ($row = $res->fetch_assoc()) {
                                  echo "<tr>";
                                  echo "<td>".$count."</td>";
                                  echo "<td>".$row["Camp_Id"]."</td>";
                                  echo "<td>".explode("-", $row["Camp_Id"])[1]."</td>";
                                  echo "<td>".$row["NOS"]."</td>";
                                  echo "<td>".$row["Camp_startdate"]."</td>";
                                  echo "<td>".$row["Camp_enddate"]."</td>";
                                  echo "<td>";if($row["Camp_Status"] == 1){ echo "Active"; }else{ echo "Close"; } echo "</td>";
                                  echo "</tr>";
                                  $count = $count + 1;
                                }
                              ?>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div>
          <div class="row">
            <div class="col-lg-12">
             <div class="panel panel-default">
              <div style="color: red;" class="panel-heading">
               <b>Cadet Details</b>
             </div>
             <div class="panel-body">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                       
                            <?php
                            
                              $campsql = "select * from camp_master where Cluster_Id = ".$_SESSION["Clust"];
                              $campres = $con->query($campsql);
                              while ($row = $campres->fetch_assoc()) {
                                $campid = $row["Camp_Id"];
                                $total = 0;
                                $vtotal = 0;
                                $dtotal = 0;
                                $school = array();
                                $schools = "select * from school_assign where camp_Id = ".$row["srno"];
                                $schoolres = $con->query($schools);
                                while ($schoolrow = $schoolres->fetch_assoc()) {
                                  $troop = $con->query("select * from school_master where SC_ID = ".$schoolrow["school_Id"])->fetch_assoc()["TROOP_CODE"];
                                  array_push($school, $troop);
                                }

                                $school = array_unique($school);

                                $cadetcount = "select count(*) as count,gender from enroll_master where (";
                                foreach ($school as $value) {
                                  $cadetcount = $cadetcount . "enrollment_id like '%".$value."%' or ";
                                }
                                $cadetcount = substr($cadetcount,0,-3);
                                $cadetcount = $cadetcount . " ) and ".strtolower(explode("-", $campid)[1])."=1 group by gender";


                                $vcadets = array();
                                $dcadets = array();
                                $vdcadetcount = "select * from Form_Logs where camp_Id = ".$row["srno"];
                                $vdcadetcountres = $con->query($vdcadetcount);
                                while ($row = $vdcadetcountres->fetch_assoc()) {
                                  if($row["form_status"] == "v")
                                  {
                                    array_push($vcadets, $row["cadet_Id"]);
                                  }
                                  else if($row["form_status"] == "d")
                                  {
                                    array_push($dcadets, $row["cadet_Id"]);
                                  }
                                }
                                $vcadets = array_unique($vcadets);
                                $dcadets = array_unique($dcadets);

                                $vcadetcount = 0;
                                if(!empty($vcadets))
                                {
                                  $vcadetcount = "select count(*) as count,gender from enroll_master where (";
                                  foreach ($vcadets as $value) {
                                    $vcadetcount = $vcadetcount . "e_id = ".$value." or ";
                                  }
                                  $vcadetcount = substr($vcadetcount,0,-3);
                                  $vcadetcount = $vcadetcount . " ) group by gender";
                                }

                                $dcadetcount = 0;
                                if(!empty($dcadets))
                                {
                                  $dcadetcount = "select count(*) as count,gender from enroll_master where (";
                                  foreach ($dcadets as $value) {
                                    $dcadetcount = $dcadetcount . "e_id = ".$value." or ";
                                  }
                                  $dcadetcount = substr($dcadetcount,0,-3);
                                  $dcadetcount = $dcadetcount . " ) group by gender";
                                }
                                ?>
<div class="row">
            <div class="col-lg-12">
             <div class="panel panel-default">
              <div style="color: red;" class="panel-heading">
               <b><?php echo $campid; ?> Camp Details</b>
             </div>
             <div class="panel-body">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                                <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                              <th></th>
                              <th>Total</th>
                              <th>Camp Form View</th>
                              <th>Camp Form Download</th>
                            </tr>
                          </thead>
                          <tbody>
                          <tr>
                              <th>Male Cadets</th>
                              <td>
                              <?php  
                              $cadetres = $con->query($cadetcount);
                                while ($value = $cadetres->fetch_assoc()) {
                                  if($value["gender"] == "M")
                                  {
                                    echo $value["count"];
                                    $total = $total + $value["count"];
                                  }
                                }
                              ?></td>
                              <td><?php
                              if(!$vcadetcount == 0)
                              {
                                $cadetres = $con->query($vcadetcount);
                                while ($value = $cadetres->fetch_assoc()) {
                                  if($value["gender"] == "M")
                                  {
                                    echo $value["count"];
                                    $vtotal = $vtotal + $value["count"];
                                  }
                                  else
                                  {
                                    echo "0";
                                  }
                                }
                              }
                              else
                              {
                                echo "0";
                              }

                              ?></td>
                               <td><?php
                              if(!$dcadetcount == 0)
                              {
                                $cadetres = $con->query($dcadetcount);
                                while ($value = $cadetres->fetch_assoc()) {
                                  if($value["gender"] == "M")
                                  {
                                    echo $value["count"];
                                    $dtotal = $dtotal + $value["count"];
                                  }
                                  else
                                  {
                                    echo "0";
                                  }
                                }
                              }
                              else
                              {
                                echo "0";
                              }

                              ?></td>
                            </tr>
                            <tr>
                              <th>Female Cadets</th>
                              <td><?php  
                              $cadetres = $con->query($cadetcount);
                                while ($value = $cadetres->fetch_assoc()) {
                                  if($value["gender"] == "F")
                                  {
                                    echo $value["count"];
                                    $total = $total + $value["count"];
                                  }
                                }
                              ?></td>
                             <td><?php
                              if(!$vcadetcount == 0)
                              {
                                $cadetres = $con->query($vcadetcount);
                                while ($value = $cadetres->fetch_assoc()) {
                                  if($value["gender"] == "F")
                                  {
                                    echo $value["count"];
                                    $vtotal = $vtotal + $value["count"];
                                  }
                                  else
                                  {
                                    echo "0";
                                  }
                                }
                              }
                              else
                              {
                                echo "0";
                              }

                              ?></td>
                               <td><?php
                              if(!$dcadetcount == 0)
                              {
                                $cadetres = $con->query($dcadetcount);
                                while ($value = $cadetres->fetch_assoc()) {
                                  if($value["gender"] == "F")
                                  {
                                    echo $value["count"];
                                    $dtotal = $dtotal + $value["count"];
                                  }
                                  else
                                  {
                                    echo "0";
                                  }
                                }
                              }
                              else
                              {
                                echo "0";
                              }

                              ?></td>
                            </tr>
                            <tr>
                              <th>Total Cadets</th>
                              <th><?php
                                echo $total;
                              ?></th>
                              <th><?php

                              echo $vtotal;
                              ?></th>
                              <th><?php

                              echo $dtotal;
                              ?></th>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
                                <?php
                              }
                            ?>
                            
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
</div>
<?php
include '../footer.php';
?>