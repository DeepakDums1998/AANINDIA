<?php
include '../header.php';
include '../connection.php';
include '../sendmsg.php';
$visible = "hidden";
?>
<style type="text/css">
#campyear{
visibility: hidden;
}
.visiblehide{
visibility: hidden;
}
.visibledata{
visibility: visible;
}
</style>
<script src="../Resources/js/jquery.min.js"></script>
<script src="https://cdn.tiny.cloud/1/cc6jviaafuf1u9xp4rzd86otv36kqqxneq7cwy7pw3r4lq8s/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <b>
        <h4 class="page-header">GUIDELINES</h4>
        </b>
           <div class="form-group">
              
        <div class="row">

          <div class="col-lg-12">
            
            <div class="panel panel-default">
              <div style="color: red;" class="panel-heading">
                <b>MANAGE GUIDELINES</b>
              </div>
              <form role="form" method="Post" action="NewGuideline.php" enctype="multipart/form-data">
                <div class="panel-body">
                  <div class="row">
                   
                    
                      <div class="form-group">
                        <div class="col-lg-2">
                          <button type="submit" name="new" class="btn btn-success">ADD NEW</button>
                        </div>
                      </div>
                      <div class="panel-heading">
                 
                </div>
                  <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                      <thead>
                        <tr>
                          <th>SR.NO</th>
                          <th>TITLE</th>
                          <th>DATETIME</th>
                          <th>GUIDELINES</th>
                          <th>EDIT</th>
                          <th>DELETE</th>
                        </tr>
                        </thead>
                        <?php
                        $sql="SELECT * FROM tbl_guidelines 
                                         ORDER BY timestamp DESC
                                       "; 
                                //  echo $con->query($sql)->fetch_assoc()["Guidelines"];
                        $result=$con->query($sql);
                        $COUNT=1;
                        while($row = $result->fetch_assoc()) {
                        ?>    <tr>
                          <td><?php  echo $COUNT++; ?></td>
                          <td><?php echo $row["TITLE"]?></td>
                          <td><?php echo $row["timestamp"]?></td>
                          <td><?php echo $row["Guidelines"]?></td>
                          <td><a href="EditGuideline.php?gid=<?php echo $row['g_id']; ?>"><i class="fa fa-edit" style="font-size:28px;color:#1E90FF"></i></a></td>
                         
                          <td><a href="DeleteGuideline.php?gid=<?php echo $row['g_id']; ?>"><i class="fa fa-trash" style="font-size:28px;color:red"></i></i></td>
                         
                        </tr>
                        <?php
                      }
                        ?>
                      </tbody>
                    </table>
                    </div>                        
                    </div>
                  </div>

                    
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
  <?php
  
  include '../footer.php';
  ?>