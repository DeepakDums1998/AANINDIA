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
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            
            <!-- /.col-lg-6 -->
            <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <b>  Manage Fees Amount </b>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>SR.NO</th>
                          <th>YEAR</th>
                          <th>AMOUNT</th>
                          <th>EDIT</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql="SELECT * FROM tbl_feesstucture";
                        $result = $con->query($sql);
                        while ($row = $result->fetch_assoc()) {
                        
                        ?>
                        <tr>
                          
                          <td><?php echo $row["t_year"]; ?></td>
                          <td><?php
                            if($row["t_year"]==1)
                            {
                            echo "FIRST YEAR";
                            }
                            if($row["t_year"]==2)
                            {
                            echo "SECOND YEAR";
                            }
                            if($row["t_year"]==3)
                            {
                            echo "ATC";
                            }
                            if($row["t_year"]==4)
                            {
                            echo "STC";
                            }
                            if($row["t_year"]==5)
                            {
                            echo "OTC";
                            }
                          ?></td>
                          <td><?php echo $row["amount"]
                          ;?></td>
                          <td><a href="?update_id=<?php echo $row["t_year"]; ?>"> <i class="fa fa-edit"></i> </a></td>
                        </tr>
                        <?php }
                        
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
            <!-- /.col-lg-6 -->
          </div>
          <?php
          if(isset($_GET['update_id']))
          {
          ?>
          <form method="POST" role="form">
          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <b>  EDIT FEES FOR YEAR <?php
                  echo $_GET['update_id'];
                  ?> </b>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>YEAR</label>
                      <input type="hidden" name="t_year" value="<?php echo $_GET['update_id'];?>">
                       <input class="form-control" value="
                        <?php
                        if($_GET['update_id']==1)
                            {
                            echo "FIRST YEAR";
                            }
                            if($_GET['update_id']==2)
                            {
                            echo "SECOND YEAR";
                            }
                            if($_GET['update_id']==3)
                            {
                            echo "ATC";
                            }
                            if($_GET['update_id']==4)
                            {
                            echo "STC";
                            }
                            if($_GET['update_id']==5)
                            {
                            echo "OTC";
                            }
                        ?>
                       " Disabled>
                      
                    </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="form-group">
                                                    <label>AMOUNT</label>
                                                    <input class="form-control" type="text" name="txtamount" value="<?php
                                                    $get_fees="SELECT * FROM tbl_feesstucture WHERE t_year={$_GET['update_id']}";
                                                    echo $con->query($get_fees)->fetch_assoc()["amount"];

                                                    ?>" required >
                                                    
                                                </div>
                  </div>
                  <div class="col-lg-2">
                     <div class="form-group">
                                                     <label>EDIT FEES</label>
                                                    <input class="form-control btn btn-success" name="btnupdate" type="submit" value="UPDATE">
                                                    
                                                </div>
                  </div>
                  
                  <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
              </div>
              <!-- /.panel -->
            </div>
            <!-- /.col-lg-6 -->
            
            <!-- /.col-lg-6 -->
          </div>
        </form>
         

          <?php
          if(isset($_POST['btnupdate']))
          {
            $fees_update="UPDATE tbl_feesstucture SET amount={$_POST['txtamount']} where t_year={$_POST['t_year']} ";
            
            if($con->query($fees_update))
            {
              echo "<script>alert('FEES UPDATED SUCCESSFULLY');</script>";
            }
          }
          }
          ?>
          
          
          <!-- /.row (nested) -->
        </div>
        <!-- /.panel-body -->
      </div>
      <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
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