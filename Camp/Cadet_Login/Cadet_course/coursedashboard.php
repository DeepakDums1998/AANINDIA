<?php
require_once("header.php");
?>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<div id="page-wrapper">
  <div class="container-fluid">
  <div class="row">
     <div class="col-lg-12">
        <b>
           <h4 class="page-header">COURSE DETAILS</h4>
        </b>
           <div class="row">
              <div class="col-lg-8">
                 <div class="panel panel-default">
                    <div style="color: red;" class="panel-heading">
                       <b>COURSE NAME</b>
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
                                   <label> <h3> AAN LEARNING PORTAL</h3></label>
                                </div>
                                  <div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/v64KOxKVLVg" allowfullscreen></iframe>
</div>
                             </div>
                        </div>
                       </form>
                 </div >
                 
               
                        
                 </div>
              </div>
              <div class="col-lg-4">
                <div class="panel panel-default">
                    <div style="color: red;" class="panel-heading">
                       <b>Introduction of the L&D Software </b>
                    </div>
                  
                     <form role="form" method="Post" enctype="multipart/form-data">
                       <div class="panel-body">
                          <div class="row">
                             <div class="col-lg-12">
                              
                                <div class="form-group">
                                   <label> <h6> This software will give you  </h6></label>
                                  <div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/v64KOxKVLVg" allowfullscreen></iframe>
</div>
                                </div>

                             </div>
                        </div>
                       </form>
                 </div >


              </div>

              </div>
              <div class="col-lg-4">
                <div class="panel panel-default">
                    <div style="color: red;" class="panel-heading">
                       <b>INSTRUCTOR IN CHARGE </b>
                    </div>
                  
                     <form role="form" method="Post" enctype="multipart/form-data">
                       <div class="panel-body">
                          <div class="row">
                             <div class="col-lg-6">
                              
                                <div class="form-group">
                                   <label> <h6> CI Anant Dave  </h6></label>
                                   <img src="" alt="IMAGE"><br>
                                    <label> <h6>ADJT </h6></label>
                                </div>

                             </div>
                              <div class="col-lg-6">
                              
                                <div class="form-group">
                                   <label> <h6> CI Unmesh Pandya </h6></label>
                                   <img src="" alt="IMAGE"><br>
                                   <label> <h6> CI CMDT  </h6></label>
                                 
                                </div>

                             </div>
                        </div>
                       </form>
                 </div >
              
                <?php
              }
            }
                ?>
              </div>
           </div>
         </div>
       </div>
        <script src="../../../Resources/js/jquery.min.js"></script>
        <script src="../../../Resources/js/bootstrap.min.js"></script>
        <script src="../../../Resources/js/metisMenu.min.js"></script>
        <script src="../../../Resources/js/dataTables/jquery.dataTables.min.js"></script>
        <script src="../../../Resources/js/dataTables/dataTables.bootstrap.min.js"></script>
        <script src="../../../Resources/js/metisMenu.min.js"></script>
        <script src="../../../Resources/js/startmin.js"></script>
        <script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>
    </body>
</html>