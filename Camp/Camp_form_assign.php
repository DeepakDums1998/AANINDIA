<?php
	include '../connection.php';
	include '../header.php';
?>
<div id="page-wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<b><h4 class="page-header">Create Camp</b></h4>
<div>
<div class="row">
<div class="col-lg-12">
   <div class="panel panel-default">
      <div style="color: red;" class="panel-heading">
         <b>Add New Camp Here</b>
      </div>
      <form method="Post" enctype="multipart/form-data">
         <div class="panel-body">
            <div class="row">
             	<div class="col-lg-3">
					<div class="form-group">
                     	<label>State</label>
                     	<select class="form-control" name="Camp_Type" id="Camp_Type" onchange="create_camp_code()">
                     		<option>------ select ------</option>
                        	<?php
                        		$sql = "select * from state_master";
                        		
                        	?>
                     	</select>
                  	</div>
                </div>
                <div class="col-lg-3">
					<div class="form-group">
                     	<label>City</label>
                     	<select class="form-control" name="Camp_Type" id="Camp_Type" onchange="create_camp_code()">
                     		<option>------ select ------</option>
                        	<option>ATC</option>
                     		<option>STC</option>
                     		<option>OTC</option>
                     	</select>
                  	</div>
                </div>
                <div class="col-lg-3">
					<div class="form-group">
                     	<label>School</label>
                     	<select class="form-control" name="Camp_Type" id="Camp_Type" onchange="create_camp_code()">
                     		<option>------ select ------</option>
                        	<option>ATC</option>
                     		<option>STC</option>
                     		<option>OTC</option>
                     	</select>
                  	</div>
                </div>
                <div class="col-lg-3">
					<div class="form-group">
                     	<label>Traning Year</label>
                     	<select class="form-control" name="Camp_Type" id="Camp_Type" onchange="create_camp_code()">
                     		<option>------ select ------</option>
                        	<option>ATC</option>
                     		<option>STC</option>
                     		<option>OTC</option>
                     	</select>
                  	</div>
                </div> 
               <div class="row">
               		<div class="col-lg-12">
               			<button type="submit" name="btnaddyear" class="btn btn-success">Add New Camp</button>
               		</div>
               </div>
          </div>
         </div>
   </div>
</div>
</form>
<?php 
if (isset($_POST["btnaddyear"])) {
  $camp_code = $_POST["Camp_year"] . "-" . $_POST["Camp_Type"] . "-" . $_POST["camp_no"];
  $camp_start_date = $_POST["camp_start_date"];
  $camp_end_date = $_POST["camp_end_date"];
  $camp_address = $_POST["camp_address"];
  $camp_city = $_POST["camp_city"];
  $count = 0;

  $select = "select * from camp_master where Camp_Code like '%".$camp_code."%'";
  $rs = $con->query($select);
  while ($row = $rs->fetch_assoc()) {
    $count = 1;
  }

  if($count == 0)
  {
    $sql = "INSERT INTO camp_master(Camp_Code,Camp_Start_Date,Camp_End_Date,Camp_Address,Camp_City,Camp_datetime,Camp_Status) VALUES ('".$camp_code."','".$camp_start_date."','".$camp_end_date."','".$camp_address."','".$camp_city."','".date('Y-m-d H:i:s')."',1)";
    if($con->query($sql) == TRUE)
    {
      echo "<script>alert('Camp Create Successfully.');</script>";
    }
  }
  else
  {
    echo "<script>alert('Camp Is Already Added.');</script>";
  }
}
?>
</div>
<br>
<div>
</div>
<?php
	include '../footer.php';
?>