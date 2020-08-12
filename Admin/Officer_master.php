<?php
include '../header.php';
include '../connection.php';
       ?>
<div id="page-wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<b><h4 class="page-header">State Master</b></h4>
<div>
<div class="row">
<div class="col-lg-12">
   <div class="panel panel-default">
      <div style="color: red;" class="panel-heading">
         <b>Add State Here</b>
      </div>
      <form method="post" enctype="multipart/form-data">
         <div class="panel-body">
            <div class="row">
                <div class="col-lg-3">
                  <div class="form-group">
                     <label>Select Year</label>
                     <input style="text-transform: uppercase;" class="form-control" placeholder="Ex :- GUJARART" name="state_name">
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                     <label>Select State</label>
                     <input style="text-transform: uppercase;" class="form-control" placeholder="GUJ" name="state_code">
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                     <label>Officer No</label>
                     <input style="text-transform: uppercase;" class="form-control" placeholder="GUJ" name="state_code">
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                     <button type="submit" name="btnstate" class="btn btn-success">Register State</button>
                  </div>
                </div>
            </div>
          </div>
      </form>
    </div>
  </div>
</div>
<?php 
if (isset($_POST["btn"])) {
  
}
?>
</div>
<br>





<div>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">
STATE
</div>
<!-- /.panel-heading -->
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
<thead>
<tr>
<th>Sr.No</th>
<th>State Name</th>
<th>State Code</th>
<th>Status</th>
<th>Edit</th>
<th>Enable/Disble</th>
</tr>
</thead>
<tbody>
</tbody>
</div>
<?php include '../footer.php'; ?>