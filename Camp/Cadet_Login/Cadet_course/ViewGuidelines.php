<?php
require_once("header.php");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <b>
        <h4 class="page-header">GuideLines</h4>
        </b>
      <div class="col-lg-12">
        
        <div class="row">
          <div class="col-lg-8">
          <?php  $sql="SELECT * FROM tbl_guidelines where Status=0
          ORDER BY timestamp DESC
          ";
          //  echo $con->query($sql)->fetch_assoc()["Guidelines"];
          $result=$con->query($sql);
          $flag=0;
          while($row = $result->fetch_assoc()) {
            $flag++;
          ?>
          <div class="col-lg-12">
            <div class="panel panel-default">
              <div style="color: blue;" class="panel-heading">
                <b>
                  <i class="fa fa-envelope" style="font-size:24px"></i> 
                 
                
                  <?php echo substr($row['timestamp'],0,10);  ?>
                  |<?php echo $row['TITLE'];?>
                  <div style="float: right;">
                  <?php echo substr($row['timestamp'],11);  ?>
                </div>

                </b>
              </div>
              
              <div class="panel-body">
                <div class="row">
                  <div class="col-lg-12">
                    
                    <?php
                    echo $row["Guidelines"];

                    ?>
                    
                  </div>
                </div>
                
              </div >
              
              
              
            </div>
          </div>
          <?php
          }
          ?>
        </div>
        <div class="col-lg-4">
          <div class="col-lg-12" >
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
          <div class="col-lg-12" style="float:right;">
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
              
              
            </div>
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