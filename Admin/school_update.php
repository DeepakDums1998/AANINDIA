<?php
	include '../header.php';
	include '../connection.php';
?>
<style type="text/css">
	.btns{
		color:red;
		background-color: transparent;
		border: none;
	}
</style>
<script src="../Resources/js/jquery.min.js"></script>
<script>
	function fetch_city(val)
	{
	  $.ajax({
	      type: 'post',
	      url: 'load_city.php',
	      data: {
	          get_option: val
	      },
	      success: function (response) {
	          document.getElementById("selcity").innerHTML = response;
	      }
	  });
	}
	function fetch_school(val)
	{
		$.ajax({
	      type: 'post',
	      url: 'load_school.php',
	      data: {
	          get_city: val
	      },
	      success: function (response) {
	          document.getElementById("selschool").innerHTML = response;
	      }
	  });
	}
	function fetch_erno(val)
   	{
   		$.ajax({
       		type: 'post',
       		url: 'load_erno.php',
       		data: {
     	  		get_option: val
       		},
   			success: function (response) {
            	var data = response.split("_");
         		var counter;
         		var options = "<option>-----select-----</option>";
         		for(counter = 0;counter < data.length-1;counter++)
         		{
           			options = options + "<option>"+data[counter]+"</option>";
         		}
         		document.getElementById("state").innerHTML = options;
       		}
	   	});
   	}
 	function visibleupdatepanel()
   {
   		document.getElementById("updatepanel").removeAttribute("style");
   }
</script>
<div id="page-wrapper">
  <div class="container-fluid">
<div class="row">
     <div class="col-lg-12">
        <b>
           <h4 class="page-header">Enrollment Master</h4>
        </b>
           <div class="row">
              <div class="col-lg-12">
                 <div class="panel panel-default">
                    <div style="color: red;" class="panel-heading">
                       <b>Enrollment Id</b>
                    </div>
                    <form role="form" method="Post" enctype="multipart/form-data">
                       <div class="panel-body">
                          <div class="row">
                             <div class="col-lg-2">
                                <div class="form-group">
                                   <select class="form-control" name="year" id="erid" onchange="clearsss(this.value)">
                                      <?php
                                        $query = "SELECT SUBSTRING(Y_CODE,3,2) AS Y_CODE FROM  year_master";
                                        $rs = $con->query($query);
                                        while($row = $rs->fetch_assoc())
                                        {
                                          ?>
                                          <option value="<?php echo $row["Y_CODE"]; ?>"><?php echo $row["Y_CODE"]; ?></option>
                                          <?php
                                        }
                                       ?>
                                   </select>
                                </div>
                             </div>
                             <div class="col-lg-2">
                              <div class="form-group">
                                <input class="form-control" name="troop_code" id=troop_code onchange="fetch_erno(this.value);" required>
                                </div>
                             </div>
                             <div class="col-lg-2">
                              <div class="form-group">
                                <select class="form-control" name="state" id="state">
                                   <option value=" "></option>
                                   <?php
                                      $query = "select * FROM state_master order by STATE_NAME DESC";
                                      $rs    = $con->query($query);
                                      while ($row = $rs->fetch_assoc()) {
                                      ?>
                                          <option value="<?php echo $row["STATE_CODE"];?>" selected>
                                            <?php echo $row["STATE_CODE"];?></option>
                                   
                                   <?php
                                      }
                                      ?>
                                </select>
                              </div>
                             </div>
                                <div class="col-lg-2">
                                  <div class="form-group">
                                    <input class="form-control" name="uno" id="uno" pattern="[0-9]{3}" title="Three Digit Cadet Form No." required>
                                  </div>
                               </div>
                               <div class="col-lg-2">
                                <div class="form-group">
                                  <button type="submit" id="btnentercadets" name="btnentercadets" class="btn btn-success">View Cadets</button>
                                </div>
                               </div>
                          </div>
                       </div>
                       </form>
                 </div>
                 </div>
             </div>
             <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        View Master
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Enrollment id</th>
                                        <th>Full Name</th>
                                        <th>STD</th>
                                        <th>Training Year</th>
                                        <th>Year of Enroll</th>
                                        <th>Cadet Year</th>
                                        <th>Update School</th>
                                    </tr>
                                </thead>
                                <?php
			                 	if(isset($_POST["btnentercadets"]))
			                 	{
			                 		$er_no = $_POST["year"] . "-" . $_POST["troop_code"] . "-" . $_POST["state"] . "-" . $_POST["uno"];
			                 		$_SESSION["ernodata"] = $er_no;
			                 		$count = 0;
			                 		$query = "select * from enroll_master where enrollment_id = '".$er_no."'";
			                 		$rs = $con->query($query);
                                 	while($row = $rs->fetch_assoc())
                                 	{
                                     	$count = 1;
                                      	echo "<tr style='background-color:lightblue;'>";
                                      	echo "<td><b>".$count."</b></td>";
                                      	echo "<td><b>".$row['enrollment_id']."</b></td>";
                                      	echo "<td><b>".($row['last_name']. " " .$row['first_name'] . " " . $row['middle_name'])."</b></td>";
                                      	echo "<td><b>".$row['std']."</b></td>";
                                      	echo "<td><b>".$row['t_year']."</b></td>";
                                      	echo "<td><b>".$row['yoe']."</b></td>";
                                      	echo "<td><b>".$row['c_year']."</b></td>";
                                      	echo "<td><button class='btns' name='btnupdates' onclick='visibleupdatepanel()'><b>Update</b></button></td>";
                                      	echo "</tr>";
                                      	
                                 	}

                                 	if($count == 0)
                                 	{
                                 		echo "<script>alert('This Enrollment Id Is Unavailable.');</script>";
                                 	}
			                 	}
			                 ?>
			             </table>
			         </div>
			     </div>
			 </div>
			</div>

			<div class="col-lg-12" id="updatepanel" style="visibility: hidden;">
				<form role="form" method="Post" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Change School
                    </div>
                    <div class="panel-body">
                    	<div class="row">
							<div class="col-lg-12">
								<div class="col-lg-3">
									<div class="form-group">
										<b><label>Select State</label></b>
										<?php
											$sql = "select * from state_master";
										?>
										<select name="selstate" id="selstate" class="form-control" onchange="fetch_city(this.value);">
											<option>Select State</option>
											<?php 
												$rs = $con->query($sql); 
												while ($row = $rs->fetch_assoc()) {
													?><option value="<?php echo $row['STATE_ID']; ?>"><?php echo $row["STATE_NAME"]; ?></option><?php		
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<b><label>Select City</label></b>
										<select name="selcity" id="selcity"  onchange="fetch_school(this.value);" class="form-control">
											<option></option>
										</select>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<b><label>Select School</label></b>
										<select name="selschool" id="selschool" class="form-control">
											<option></option>
										</select>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<br/>
										<input type="submit" class="btn btn-primary" value="Update" name="btnupdate">
									</div>
								</div>	
							</div>
						</div>
                    </div>
                </div>
                </form>
                <?php
                	if(isset($_POST["btnupdate"]))
                	{
                		$sql = "select * from update_school_details where enrollment_id = '".$_SESSION["ernodata"]."'";
                		$rs = $con->query($sql);
                		$count = 0;
                		while ($row = $rs->fetch_assoc()) {
                			$count = 1;
                		}

                		if($count == 0)
                		{
                			$flag = 0;
                			$sql = "insert into update_school_details(enrollment_id,state_id,city_id,troop_code,year) value('".$_SESSION["ernodata"]."',".$_POST["selstate"].",".$_POST["selcity"].",'".$_POST["selschool"]."',".date('Y').")";
                			if($con->query($sql) == TRUE)
                			{
                				$flag = 1;
                			}

                			$sql = "update enroll_master set school_update_status = 1 where enrollment_id = '".$_SESSION["ernodata"]."'";
                			if($con->query($sql) == TRUE)
                			{
                				$flag = 2;
                			}

                			if($flag == 2)
                			{
                        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
                  <script>Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'School Update Successfully.',
                    showConfirmButton: false,
                    timer: 1500
                  }); setInterval(data,2000);</script>";
                			}
                		}
                		elseif ($count == 1) {
                			$flag = 0;
                			$sql = "update update_school_details set state_id = ".$_POST["selstate"].",city_id = ".$_POST["selcity"].",troop_code = '".$_POST["selschool"]."',year = ".date('Y')." where enrollment_id = '".$_SESSION["ernodata"]."'";
                			if($con->query($sql) == TRUE)
                			{ 
                				$flag = 1;
                			}

                			$sql = "update enroll_master set school_update_status = 1 where enrollment_id = '".$_SESSION["ernodata"]."'";
                			if($con->query($sql) == TRUE)
                			{
                				$flag = 2;
                			}

                			if($flag == 2)
                			{
                        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
                  <script>Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'School Update Successfully.',
                    showConfirmButton: false,
                    timer: 1500
                  }); setInterval(data,2000);</script>";
                			}
                		}
                	}
                ?>
            </div>
		</div>
         </div>
     </div>
 </div>
</div>
<?php
	include '../footer.php';
?>