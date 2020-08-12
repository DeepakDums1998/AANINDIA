<?php
require_once("header.php");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <b><h4 class="page-header">CADET DETAILS </b></h4>
        </b>
      </div>
    </div>
    <div>
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <form role="form" id="enroll_detail" method="Post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-lg-4">
                    <b>CADET DETAILS GENDER WISE </b>
                  </div>
                </div>
              </div >
              <div class="panel-body">
                 <div class="row">
                    <?php
                  $sortkey="";
                  $sql="SELECT * FROM school_master WHERE SC_ID='{$_SESSION['inLogin_id']}'";
                  $troop_code=$con->query($sql)->fetch_assoc()["TROOP_CODE"];
                  $S_ID=$con->query($sql)->fetch_assoc()["STATE_ID"];
                  $get_state="SELECT * FROM state_master where STATE_ID='{$S_ID}'";
                  $state_code=$con->query($get_state)->fetch_assoc()["STATE_CODE"];
                  $sortkey= $sortkey."-".$troop_code."-".$state_code;
                  ?>
                        <div class="col-lg-2 col-md-2">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        
                                        <div class="col-xs-12 ">
                                            <div><b><?php $total_first="SELECT COUNT(*) as tf FROM `enroll_master`WHERE SUBSTR(enrollment_id,3,9) = '{$sortkey}' and t_year=1 and c_year=(select c_year from year_master where Y_STATUS=2 )"; 

                                            ?>

                    FIRST YEAR </b></div>
                    <div class="huge "><?php echo $con->query($total_first)->fetch_assoc()["tf"]; ?></div>
                                            
                                        </div>
                                    </div>
                                </div>
                               
                                    <div class="panel-footer">
                                       <a href="#">
                                        <span class="pull-left">  MALE: <?php $total_first_M="SELECT COUNT(*) as tf FROM `enroll_master`WHERE SUBSTR(enrollment_id,3,9) = '{$sortkey}' and t_year=1 and gender='M' and c_year=(select c_year from year_master where Y_STATUS=2)";
                    echo $con->query( $total_first_M)->fetch_assoc()["tf"];
                    ?>
                    <br>
                    FEMALE: <?php $total_first_F="SELECT COUNT(*) as tf FROM `enroll_master`WHERE SUBSTR(enrollment_id,3,9) = '{$sortkey}' and t_year=1 and gender='F' and c_year=(select c_year from year_master where Y_STATUS=2)";
                    echo $con->query( $total_first_F)->fetch_assoc()["tf"];
                    ?></span>
                                       
                            
                                        <div class="clearfix"></div>
                                      </a>
                                    </div>
                                
                            </div>
                        </div>
                        
                      
                        <div class="col-lg-2 col-md-2">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                       
                                        <div class="col-xs-12">
                                           
                                            <div> <?php $total_first="SELECT COUNT(*) as tf FROM `enroll_master`WHERE SUBSTR(enrollment_id,3,9) = '{$sortkey}' and t_year=2 and c_year=(select c_year from year_master where Y_STATUS=2)" ;?>
                    <b> SECOND YEAR </b><div class="huge" ><?php echo $con->query($total_first)->fetch_assoc()["tf"]; ?></div></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">MALE: <?php $total_first_M="SELECT COUNT(*) as tf FROM `enroll_master`WHERE SUBSTR(enrollment_id,3,9) = '{$sortkey}' and t_year=2 and gender='M' and c_year=(select c_year from year_master where Y_STATUS=2)";
                    echo $con->query( $total_first_M)->fetch_assoc()["tf"];
                    ?>
                    <br>
                    FEMALE: <?php $total_first_F="SELECT COUNT(*) as tf FROM `enroll_master`WHERE SUBSTR(enrollment_id,3,9) = '{$sortkey}' and t_year=2 and gender='F' and c_year=(select c_year from year_master where Y_STATUS=2)";
                    echo $con->query( $total_first_F)->fetch_assoc()["tf"];
                    ?></span>
                                       

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                       
                                        <div class="col-xs-12 ">
                                           
                                            <div><?php $total_first="SELECT COUNT(*) as tf FROM `enroll_master`WHERE SUBSTR(enrollment_id,3,9) = '{$sortkey}' and t_year=3 and c_year=(select c_year from year_master where Y_STATUS=2)";?>
                    <b>THIRD YEAR </b> <div class="huge"> <?php echo $con->query($total_first)->fetch_assoc()["tf"]; ?></div></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">MALE: <?php $total_first_M="SELECT COUNT(*) as tf FROM `enroll_master`WHERE SUBSTR(enrollment_id,3,9) = '{$sortkey}' and t_year=3 and gender='M' and c_year=(select c_year from year_master where Y_STATUS=2)";
                    echo $con->query( $total_first_M)->fetch_assoc()["tf"];
                    ?>
                    <br>
                    FEMALE: <?php $total_first_F="SELECT COUNT(*) as tf FROM `enroll_master`WHERE SUBSTR(enrollment_id,3,9) = '{$sortkey}' and t_year=3 and gender='F' and c_year=(select c_year from year_master where Y_STATUS=2)";
                    echo $con->query( $total_first_F)->fetch_assoc()["tf"];
                    ?></span>
                                       

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                      
                                        <div class="col-xs-12 ">
                                           
                                            <div> <?php $total_first="SELECT COUNT(*) as tf FROM `enroll_master`WHERE SUBSTR(enrollment_id,3,9) = '{$sortkey}' and t_year=4 and c_year=(select c_year from year_master where Y_STATUS=2)";?>
                    <b> FORTH YEAR </b><div class="huge"> <?php echo $con->query($total_first)->fetch_assoc()["tf"]; ?> </div></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">MALE: <?php $total_first_M="SELECT COUNT(*) as tf FROM `enroll_master`WHERE SUBSTR(enrollment_id,3,9) = '{$sortkey}' and t_year=4 and gender='M' and c_year=(select c_year from year_master where Y_STATUS=2)";
                    echo $con->query( $total_first_M)->fetch_assoc()["tf"];
                    ?>
                    <br>
                    FEMALE: <?php $total_first_F="SELECT COUNT(*) as tf FROM `enroll_master`WHERE SUBSTR(enrollment_id,3,9) = '{$sortkey}' and t_year=4 and gender='F' and c_year=(select c_year from year_master where Y_STATUS=2)";
                    echo $con->query( $total_first_F)->fetch_assoc()["tf"];
                    ?></span>
                                       

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <div class="panel" style="background-color:black; color: white;">
                                <div class="panel-heading">
                                    <div class="row">
                                       
                                        <div class="col-xs-12">
                                           
                                            <div> <?php $total_first="SELECT COUNT(*) as tf FROM `enroll_master`WHERE SUBSTR(enrollment_id,3,9) = '{$sortkey}' and t_year=5 and c_year=(select c_year from year_master where Y_STATUS=2)";?>
                    <b>FIFTH YEAR </b><div class="huge"> <?php echo $con->query($total_first)->fetch_assoc()["tf"]; ?></div></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">MALE: <?php $total_first_M="SELECT COUNT(*) as tf FROM `enroll_master`WHERE SUBSTR(enrollment_id,3,9) = '{$sortkey}' and t_year=5 and gender='M' and c_year=(select c_year from year_master where Y_STATUS=2)";
                    echo $con->query( $total_first_M)->fetch_assoc()["tf"];
                    ?>
                    <br>
                    FEMALE: <?php $total_first_F="SELECT COUNT(*) as tf FROM `enroll_master`WHERE SUBSTR(enrollment_id,3,9) = '{$sortkey}' and t_year=5 and gender='F' and c_year=(select c_year from year_master where Y_STATUS=2)";
                    echo $con->query( $total_first_F)->fetch_assoc()["tf"];
                    ?></span>
                                       

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <div class="panel " style="background-color:red; color: white;">
                                <div class="panel-heading">
                                    <div class="row">
                                       
                                        <div class="col-xs-12 ">
                                           
                                            <div> <?php
                    $total="SELECT COUNT(*) as total_students FROM `enroll_master`WHERE SUBSTR(enrollment_id,3,9) = '{$sortkey}' and c_year=(select c_year from year_master where Y_STATUS=2)";
                    //echo $total;
                    ?>
                    <b> TOTAL COUNT </b><div class="huge"><?php echo $con->query($total)->fetch_assoc()["total_students"]; ?>
                    </div></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">MALE: <?php $total_first_M="SELECT COUNT(*) as tf FROM `enroll_master`WHERE SUBSTR(enrollment_id,3,9) = '{$sortkey}'  and gender='M' and c_year=(select c_year from year_master where Y_STATUS=2)";
                    echo $con->query( $total_first_M)->fetch_assoc()["tf"];
                    ?>
                    <br>
                    FEMALE: <?php $total_first_F="SELECT COUNT(*) as tf FROM `enroll_master`WHERE SUBSTR(enrollment_id,3,9) = '{$sortkey}'  and gender='F' and c_year=(select c_year from year_master where Y_STATUS=2)";
                    echo $con->query( $total_first_F)->fetch_assoc()["tf"];
                    ?></span>
                                       

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        
                        
                    </div>
                
              </div>
            </div>
          </form>
          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <form role="form" id="enroll_detail" method="Post" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-lg-4">
                        <b>Search Cadet By Year </b>
                      </div>
                      
                      <div class="col-lg-2" style="float: right;">
                        <select class="form-control" name="drpyear" style="float: right;">
                          <option selected>Select Year</option>
                          <?php
                          $sql = "SELECT * FROM year_master ";
                          $result = $con->query($sql);
                          while ($row = $result->fetch_assoc()) {
                          $id = $row["Y_CODE"];
                          
                          ?>
                          <option value=<?php echo substr($id,2); ?> <?php
                            if(isset($_POST['drpyear']))
                            {
                            if($_POST['drpyear']==substr($id,2))
                            {
                            echo "selected";
                            }
                            }
                          ?>  ><?php echo $id; ?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div >
                  </div>
                  
                  <div class="panel-body">
                    
                    <br>
                    <div class="row">
                      <div class="col-lg-2" >
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="Year_1" value="1" name="chk_f_year" <?php if(isset($_POST['chk_f_year'])){echo "checked";} ?> >
                          <label class="form-check-label" for="Year_1"   >FIRST YEAR</label>
                        </div>
                      </div>
                      <div class="col-lg-2" >
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="Year_2" value="2" name="chk_s_year" <?php if(isset($_POST['chk_s_year'])){echo "checked";} ?> >
                          <label class="form-check-label" for="Year_2"   >SECOND YEAR</label>
                        </div>
                      </div><div class="col-lg-2" >
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="Year_3" value="3" name="chk_t_year"  <?php if(isset($_POST['chk_t_year'])){echo "checked";} ?> >
                        <label class="form-check-label" for="Year_3"  >THIRD YEAR</label>
                      </div>
                    </div><div class="col-lg-2" >
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="Year_4" value="4" name="chk_four_year" <?php if(isset($_POST['chk_four_year'])){echo "checked";} ?> >
                      <label class="form-check-label" for="Year_4"  >FORTH YEAR</label>
                    </div>
                  </div>
                  <div class="col-lg-2" >
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="Year_5" value="5" name="chk_fifth_year" <?php if(isset($_POST['chk_fifth_year'])){echo "checked";} ?> >
                      <label class="form-check-label" for="Year_5"   >FIFTH YEAR</label>
                    </div>
                  </div>
                  <div class="col-lg-2" >
                    <div class="form-check">
                      <input class="btn btn-success" type="submit" name="btnfilter" value="SEARCH">
                    </div>
                    
                    
                  </div>
                </div >
              </form>
            </div>
          </div>
          <!-- /.panel-heading -->
          <?php
          $key="";
          if(isset($_POST['btnfilter']))
          {
          if($_POST['drpyear']!="Select Year")
          {
          $key=$_POST['drpyear'];
          $sql="SELECT * FROM school_master WHERE SC_ID='{$_SESSION['inLogin_id']}'";
          $troop_code=$con->query($sql)->fetch_assoc()["TROOP_CODE"];
          $S_ID=$con->query($sql)->fetch_assoc()["STATE_ID"];
          $get_state="SELECT * FROM state_master where STATE_ID='{$S_ID}'";
          $state_code=$con->query($get_state)->fetch_assoc()["STATE_CODE"];
          $key=$key."-".$troop_code."-".$state_code;
          }
          else
          {
          echo "<script>alert('Please Select Year');</script>";
          }
          
          }
          
          ?>
          <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <b>Cadet Details</b>
                                </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                  <tr>
                    <th>SR.NO</th>
                    <th>ENROLLMENT ID</th>
                    <th>FULL NAME</th>
                    <th>STD</th>
                    <th>FORM NO</th>
                    <th>TROOP YEAR</th>
                    <th>ADDRESS</th>
                    <th>MOBILE NO</th>
                    <th>GENDER</th>
                    <th>ADHARCHARD NO</th>
                    <th>BLOOD GROUP</th>
                    <th>BIRTH DATE</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i=1;
                  $s_data="SELECT * FROM `enroll_master`WHERE SUBSTR(enrollment_id,1,11) = '{$key}'";
                  $flag=0;
                  if(isset($_POST["chk_f_year"]) || isset($_POST["chk_s_year"]) || isset($_POST["chk_t_year"]) || isset($_POST["chk_four_year"]) || isset($_POST["chk_fifth_year"]))
                  {
                    $s_data=$s_data." and (";
                    if(isset($_POST["chk_f_year"])){
                             $s_data=$s_data."t_year = {$_POST["chk_f_year"]} or ";
                    }
                    if(isset($_POST["chk_s_year"])){
                       $s_data=$s_data."t_year = {$_POST["chk_s_year"]} or ";
                    }
                    if(isset($_POST["chk_t_year"])){
                      $s_data=$s_data."t_year = {$_POST["chk_t_year"]} or ";
                    }
                    if(isset($_POST["chk_four_year"])){
                       $s_data=$s_data."t_year = {$_POST["chk_four_year"]} or ";
                    }
                    if(isset($_POST["chk_fifth_year"])){
                       $s_data=$s_data."t_year = {$_POST["chk_fifth_year"]} or ";
                    }
                    $s_data=substr($s_data,0,strlen($s_data)-3);
                    $s_data=$s_data.")";



                  }
               // echo $s_data;
                  $result = $con->query($s_data);
                  while ($row = $result->fetch_assoc()) {
                  
                  ?>
                  <tr>
                    <td>
                      <?php
                      echo $i++;
                      ?>
                    </td>
                    <td>
                      <?php
                      echo $row['enrollment_id'];
                      ?>
                    </td>
                    <td>
                      <?php
                      
                      echo $row['first_name']." ".$row['middle_name']." ".$row['last_name'];
                      
                      
                      ?>
                    </td>
                    <td>
                      <?php
                      
                      echo $row['std'];
                      
                      
                      ?>
                    </td>
                    <td>
                      <?php
                      
                      echo $row['form_no'];
                      
                      
                      ?>
                    </td>
                    <td>
                      <?php
                      
                      echo $row['t_year'];
                      
                      
                      ?>
                    </td>
                    <td>
                      <?php
                      
                      echo $row['address'];
                      
                      
                      ?>
                    </td>
                    <td><?php
                      
                      echo $row['mobile1'];
                      
                      
                    ?> </td>
                    <td>  <?php
                      
                      if($row['gender']=='M')
                      {
                      echo "MALE";
                      }
                      else
                      {
                      echo "FEMALE";
                      }
                      
                      
                    ?></td>
                    <td> <?php
                      if($row['aadharcard_no']=="")
                      {
                      echo "N/A";
                      }
                      echo $row['aadharcard_no'];
                      
                      
                    ?></td>
                    <td>
                      <?php
                      if($row['blood_group']=="")
                      {
                      echo "N/A";
                      }
                      echo $row['blood_group'];
                      
                      
                    ?></td>
                    <td>
                      <?php
                      if($row['birthdate']=="")
                      {
                      echo "N/A";
                      }
                      echo $row['birthdate'];
                      
                      
                    ?></td>
                  </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <script src="../Resources/js/jquery.min.js"></script>
          <script src="../Resources/js/bootstrap.min.js"></script>
          <script src="../Resources/js/metisMenu.min.js"></script>
          <script src="../Resources/js/dataTables/jquery.dataTables.min.js"></script>
          <script src="../Resources/js/dataTables/dataTables.bootstrap.min.js"></script>
          <script src="../Resources/js/metisMenu.min.js"></script>
          <script src="../Resources/js/startmin.js"></script>
          <script>
          $(document).ready(function() {
          $('#dataTables-example').DataTable({
          responsive: true,
          language: {
          processing: "<img src='../Resources/images/new.gif'>"
          }
          });
          });
          </script>
        </body>
      </html>