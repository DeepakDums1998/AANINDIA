<?php
require_once("header.php");
?>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<div id="page-wrapper">
  <div class="container-fluid">
  <div class="row">
     <div class="col-lg-12">
        <b>
           <h4 class="page-header">CADET PROFILE</h4>
        </b>
           <div class="row">
              <div class="col-lg-12">
                 <div class="panel panel-default">
                    <div style="color: red;" class="panel-heading">
                       <b>CADET DETAILS</b>
                    </div>
                    <?php
                    $sql = "SELECT * FROM enroll_master WHERE e_id = ".$_SESSION["Login_id"]."";
                  //echo $sql;
                  if($con->query($sql)->num_rows!=0)
                  {
                  if($con->query($sql)->fetch_assoc()["e_id"] ==$_SESSION["Login_id"])
                  {
                    $next_year=$con->query($sql)->fetch_assoc()["t_year"]+1;
                    $year=$con->query($sql)->fetch_assoc()["c_year"]+1;
                    $enrollment_id = $con->query($sql)->fetch_assoc()["enrollment_id"];
                    $gender = $con->query($sql)->fetch_assoc()["gender"];
                  ?>
                   .
                    <form role="form" method="Post" enctype="multipart/form-data">
                       <div class="panel-body">
                          <div class="row">
                             <div class="col-lg-12">
                              
                                <div class="form-group">
                                   <label> <h3> YOUR ENROLLMENT ID :<?php echo  $enrollment_id; ?> </h3></label>
                                </div>

                             </div>
                        </div>
                       </form>
                 </div>
                 
               
                    
                       <form role="form" id="enroll_detail" method="Post" enctype="multipart/form-data">
                          <div class="panel-body">
                             <div class="row">
                              <div class="col-lg-12">
                                 <div class="panel panel-default">
                                    <div style="color: red;" class="panel-heading">
                                       <b>Personal Details </b>
                                    </div>
                                    <div class="panel-body">
                                      <div class="row">
                                        <div class="col-lg-4">
                                           <div class="form-group">
                                              <label>First Name <b><span style="color:red;"> * </span></b> </label>
                                              <input style="text-transform: uppercase;" class="form-control" id="firstname" placeholder="Cadet Name " name="cdt_first_name" value=<?php
                                              echo  $con->query($sql)->fetch_assoc()["first_name"];
                                               ?> disabled >
                                           </div>
                                        </div>
                                        <div class="col-lg-4">
                                           <div class="form-group">
                                              <label>Middle Name <b><span style="color:red;"> * </span></b></label>
                                              <input style="text-transform: uppercase;" class="form-control" id="middlename" placeholder="Father Name " name="cdt_middle_name" value=<?php
                                              echo  $con->query($sql)->fetch_assoc()["middle_name"];
                                               ?> disabled >
                                           </div>
                                        </div>
                                        <div class="col-lg-4">
                                           <div class="form-group">
                                              <label>Last Name <b><span style="color:red;"> * </span></b></label>
                                              <input style="text-transform: uppercase;" class="form-control" id="lastname" placeholder="Surname " name="cdt_last_name"  value=<?php
                                              echo  $con->query($sql)->fetch_assoc()["last_name"];
                                               ?> disabled>
                                           </div>
                                        </div>
                                        <div class="col-lg-4">
                                         <div class="form-group">
                                            <label>STD <b><span style="color:red;"> * </span></b></label>
                                            <input style="text-transform: uppercase;" type='text' class="form-control" name="cdt_std" id="std" value=<?php
                                              echo  $con->query($sql)->fetch_assoc()["std"];
                                               ?> disabled />
                                         </div>
                                      </div>
                                      <div class="col-lg-4">
                                         <div class="form-group">
                                            <label> Form Number <b><span style="color:red;"> * </span></b></label>
                                            <input class="form-control" type="number" placeholder="Ex :- 1028" name="cdt_form_no" id="cdt_form_no" pattern="[0-9]{4,6}" value=<?php
                                              echo  $con->query($sql)->fetch_assoc()["form_no"];
                                               ?> disabled>
                                         </div>
                                      </div>
                                      <div class="col-lg-4">
                                         <div class="form-group">
                                            <label>Select Training Year <b><span style="color:red;"> * </span></b></label>
                                           <input class="form-control" type="number" placeholder="Ex :- 1028" name="cdt_form_no" id="t_year" pattern="[0-9]{4,6}" value=<?php
                                              echo  $con->query($sql)->fetch_assoc()["t_year"];
                                               ?> disabled>
                                         </div>
                                      </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>



                                <div class="col-lg-12">
                                  <div class="panel panel-default">
                                    <div style="color: red;" class="panel-heading">
                                       <b> Address & Mobile </b>
                                    </div>
                                    <div class="panel-body">
                                      <div class="row">
                                        <div class="col-lg-8">
                                         <div class="form-group">
                                            <label> Address Line</label>
                                            <input style="text-transform: uppercase;" class="form-control" name="cdt_add" id="cdt_add" value=<?php
                                              echo  $con->query($sql)->fetch_assoc()["address"];
                                               ?> disabled>
                                         </div>
                                      </div>
                                      <div class="col-lg-4">
                                         <div class="form-group">
                                            <label>City / Village</label>
                                            <input style="text-transform: uppercase;" class="form-control" placeholder="Ex :- Mandvi" name="cdt_city" id="cdt_city" value=<?php
                                              echo  $con->query($sql)->fetch_assoc()["city"];
                                               ?> disabled>
                                         </div>
                                      </div>
                                      <div class="col-lg-3">
                                         <div class="form-group">
                                            <label>Mobile Number </label>
                                            <input class="form-control" type="number" placeholder="Ex :- 7698320138" name="cdt_mo1" id="cdt_mo1" value=<?php
                                              echo  $con->query($sql)->fetch_assoc()["mobile1"];
                                               ?> disabled>
                                         </div>
                                      </div>
                                      <div class="col-lg-3">
                                         <div class="form-group">
                                            <label>Phone Number</label>
                                            <input class="form-control" type="number" placeholder="Ex :- 7698320138" name="cdt_mo2" id="cdt_mo2">
                                         </div>
                                      </div>

                                      <div class="col-lg-6" id="campyear" style="visibility: hidden;">
                                        <div class="form-group">
                                          <label>Camp Year</label><br/>
                                          <div class="col-lg-3">
                                              <div class="form-group">
                                                <input type="radio" id="rdATC" name="rdcampyear" value="ATC" > <label>ATC</label><br/>
                                                <input type="checkbox" id="checkATC" name="checkcampyear" disabled=""> <label>ATC Done</label>
                                              </div>
                                          </div>
                                          <div class="col-lg-3">
                                              <div class="form-group">
                                                <input type="radio" id="rdSTC" value="STC" name="rdcampyear" value="ATC" disabled=""> <label> STC</label>
                                                <br/>
                                                <input type="checkbox" id="checkSTC" name="checkcampyear" disabled=""> <label>STC Done</label>
                                              </div>
                                          </div>
                                          <div class="col-lg-3">
                                              <div class="form-group">
                                                <input type="radio" id="rdOTC" value="OTC" name="rdcampyear" disabled=""> <label> OTC</label>
                                              </div>
                                          </div>
                                          <div class="col-lg-3">
                                              <div class="form-group">
                                                <input type="radio" id="rdNULL" value="NULL" name="rdcampyear" checked=""> <label> NULL</label>
                                              </div>
                                          </div>
                                        </div>
                                      </div>
                                      
                                      </div>
                                    </div>
                                  </div>
                                </div>


                                <div class="col-lg-12">
                                  <div class="panel panel-default">
                                    <div style="color: red;" class="panel-heading">
                                       <b> Other Details </b>
                                    </div>
                                    <div class="panel-body">
                                      <div class="row">
                                        <div class="col-lg-3">
                                           <div class="form-group">
                                              <label>Blood Group</label>
                                             <input class="form-control" type="text" placeholder="Ex :- 7698320138" name="cdt_mo1" id="cdt_mo1" value=<?php
                                              echo  $con->query($sql)->fetch_assoc()["blood_group"];
                                               ?> disabled>
                                           </div>
                                        </div>
                                        <div class="col-lg-3">
                                           <div class="form-group">
                                              <label>Gender</label>
                                             <input class="form-control" type="text" placeholder="Ex :- 7698320138" name="cdt_mo1" id="cdt_mo1" value=<?php
                                              if( $con->query($sql)->fetch_assoc()["gender"] == 'M'){
                                                echo "MALE";
                                              }
                                              else if($con->query($sql)->fetch_assoc()["gender"] == 'F'){
                                                      echo "FEMALE";
                                              };
                                               ?> disabled>
                                           </div>
                                        </div>
                                        <div class="col-lg-3">
                                           <div class="form-group">
                                              <label> Birth Date </label>
                                              <input  type="date"  class="form-control " name="cdt_dob" id="cdt_dob" value=<?php
                                              echo  $con->query($sql)->fetch_assoc()["birthdate"];
                                               ?> disabled>
                                           </div>
                                        </div>
                                        <div class="col-lg-3">
                                           <div class="form-group">
                                              <label>Aadhar Card No</label>
                                              <input class="form-control" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}" maxlength="14" placeholder="Ex :- 7698 - 3201 - 3812 " name="cdt_aadhar" id="cdt_aadhar"
                                           value= <?php
                                              echo  $con->query($sql)->fetch_assoc()["aadharcard_no"];
                                               ?> disabled>
                                              
                                           </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>


                              </div>
                                
                                <div id="oldcadet">
                                  <div class="form-group">
                                    <div class="col-lg-2">
                                       <button type="submit" name="btnedit" class="btn btn-success">Edit Cadet</button>
                                    </div>
                                  </div>
                                </div>
                                
                          </div>
                        </form>
                        
                 </div>
              </div>
              </div>
              
                <?php
              }
            }
                ?>
              </div>
           </div>
         </div>
       </div>
        <script src="../../Resources/js/jquery.min.js"></script>
        <script src="../../Resources/js/bootstrap.min.js"></script>
        <script src="../../Resources/js/metisMenu.min.js"></script>
        <script src="../../Resources/js/dataTables/jquery.dataTables.min.js"></script>
        <script src="../../Resources/js/dataTables/dataTables.bootstrap.min.js"></script>
        <script src="../../Resources/js/metisMenu.min.js"></script>
        <script src="../../Resources/js/startmin.js"></script>
        <script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>
    </body>
</html>