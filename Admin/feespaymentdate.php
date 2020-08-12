<?php
require_once("../header.php");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <b><h4 class="page-header">FEES MANAGEMENT</b></h4>
        </b>
      </div>
    </div>
    <div>
      <?php
                  $get_YEAR="SELECT * FROM year_master WHERE Y_STATUS=1";
                  $C_YEAR= $con->query($get_YEAR)->fetch_assoc()["c_year"];
                  //echo $C_YEAR;
                  $check="Select count(*) as co from fees_payment_date where C_YEAR = {$C_YEAR}";
                  if($con->query($check)->fetch_assoc()["co"]==0)
                  {


                  ?>

      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            
            <!-- /.col-lg-6 -->
            <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <b style="color: red;"> SELECT DATE FOR FEES PAYMENT OF CURRENT YEAR </b>
                </div>
                <!-- /.panel-heading -->
                <form role="form" method="Post" enctype="multipart/form-data">
                  <div class="panel-body">
                    <div class="row">
                      
                      
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label>START DATE</label>
                          <input type="date" class="form-control" placeholder="Start Date" name="start_date" value="
                          ">
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label>END DATE</label>
                          <input type="date" class="form-control" placeholder="PPSV" name="end_date" required>
                        </div>
                      </div>
                      
                      
                      <div class="col-lg-3">
                        <div class="form-group" style="margin-top: 25px;">
                          <button type="submit" name="btn_DATE" class="btn btn-success" required>ADD PAYMENT DATE</button>
                        </div>
                      </div>
                      
                    </div>
                    <?php
                    if(isset($_POST['btn_DATE']))
                    {
                    echo $_POST['start_date'] >= date("Y/m/d");
                    if($_POST['start_date'] >= date("Y-m-d") && $_POST['end_date'] >= date("Y-m-d"))
                    {
                    $fees_insert="INSERT INTO fees_payment_date(A_ID,C_YEAR,START_DATE,END_DATE) VALUES({$_SESSION['ADMIN']},{$C_YEAR},'{$_POST['start_date']}','{$_POST['end_date']}') ";
                    if($con->query($fees_insert))
                    {
                    echo "<b style='color:blue;'>NEW PAYMENT ADDED SUCCESSFULLY.</b>";
                    }
                    }
                    else
                    {
                    echo "<b style='color:Red;'>Select Valid Dates!</b>";
                    // echo "<script>alert('Select Valid Dates!');</script>";
                    
                    }
                    
                    // if($con->query($fees_update))
                    
                    }
                    
                    ?>
                    
                  </div>
                  <!-- /.col-lg-12 -->
                </div>
                
              </div>
            </div>
          </form>
          <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
      </div>
      <?php
    }
    if(isset($_GET['update_id']))
    {
      ?>
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            
            <!-- /.col-lg-6 -->
            <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-heading">

                  <b style="color: red;"> EDIT FEES PAYMENT DATE FOR YEAR <?php 
                  $query="SELECT * FROM fees_payment_date WHERE PD_ID={$_GET['update_id']}";

                  echo  $con->query($query)->fetch_assoc()["C_YEAR"]; ?> </b>
                </div>
                <!-- /.panel-heading -->
                <form role="form" method="Post" enctype="multipart/form-data">
                  <div class="panel-body">
                    <div class="row">
                      
                      
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label>START DATE</label>
                          <input type="hidden" name="UPDATE_ID" value="<?php echo $_GET['update_id'];?>">
                          <input type="date" class="form-control" placeholder="Start Date" name="start_date" value="
                          <?php
                          echo $con->query($query)->fetch_assoc()["START_DATE"];
                          ?>">
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label>END DATE</label>
                          <input type="date" class="form-control" placeholder="PPSV" name="end_date" 
                          value=" <?php
                         // echo 'date('d-m-Y',strtotime($con->query($query)->fetch_assoc()["END_DATE"]))';
                          
                          ?>" required>
                        </div>
                      </div>
                      
                      
                      <div class="col-lg-3">
                        <div class="form-group" style="margin-top: 25px;">
                          <button type="submit" name="btn_DATE" class="btn btn-success" required>ADD PAYMENT DATE</button>
                        </div>
                      </div>
                      
                    </div>
                    <?php
                    if(isset($_POST['btn_DATE']))
                    {
                    echo $_POST['start_date'] >= date("Y/m/d");
                    if($_POST['start_date'] >= date("Y-m-d") && $_POST['end_date'] >= date("Y-m-d"))
                    {
                    $fees_insert="UPDATE fees_payment_date SET START_DATE='{}',END_DATE='{}' WHERE C_YEAR='{$_POST['UPDATE_ID']}'";
                    if($con->query($fees_insert))
                    {
                    echo "<b style='color:blue;'>UPDATED SUCCESSFULLY.</b>";
                    }
                    }
                    else
                    {
                    echo "<b style='color:Red;'>Select Valid Dates!</b>";
                    // echo "<script>alert('Select Valid Dates!');</script>";
                    
                    }
                    
                    
                    
                    }
                    
                    ?>
                    
                  </div>
                  <!-- /.col-lg-12 -->
                </div>
                
              </div>
            </div>
          </form>
          <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
      </div>

        <button type="button" class="btn btn-primary"><a href="feespaymentdate.php" style="color:white;">BACK</a></button>
      <?php
    }
    else
    {
      ?>

       <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                   <b style="color: red;"> FEES PAYMENT DATE DETAILS</b>
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>SR.NO</th>
                                                    <th>YEAR</th>
                                                    <th>START DATE</th>
                                                    <th>END DATE</th>
                                                    <th>EDIT</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <?php
                                                  $count=1;
                                                 $dates="Select *  from fees_payment_date";
                                                  $result = $con->query($dates);
                                                 while ($row = $result->fetch_assoc()) {
                                              ?>
                                              <tr>
                                                <td><?php
                                                echo $count++;
                                                ?></td>
                                                <td><?php
                                                echo $row['C_YEAR'];
                                                ?></td>
                                                <td>
                                                  <?php
                                                echo $row['START_DATE'];
                                                ?>
                                                </td>
                                                <td><?php
                                                echo $row['END_DATE'];
                                                ?></td>
                                                <td><a href="?update_id=<?php echo $row["PD_ID"];?>"> <i class="fa fa-edit"></i> </a></td>
                                              </tr>
                                              <?php
                                            }
                                              ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                  
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
      <!-- /.col-lg-6 -->
    </div>
  
    <!-- /.row (nested) -->
  </div>
  <!-- /.panel-body -->
</div>
<?php
}
?>
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