<?php
    include '../header.php';
    include '../connection.php';
?>
	<style type="text/css">
		.visible{
			visibility: hidden;
		}
	</style>
  	<script src="../Resources/js/jquery.min.js"></script>
    <script>
    	$(document).ready(function(){
    		$("#rdall").click(function(){
	            if($(this).is(":checked")){
	                $("#dfromdate").addClass("visible");
	                $("#dtodate").addClass("visible");
	            }
	        });
	        $("#rddate").click(function(){
	            if($(this).is(":checked")){
	                $("#dfromdate").removeClass("visible");
	                $("#dtodate").removeClass("visible");
	            }
	        });
    	});
    </script>
    <!-- Page Content -->
    <form role="form" method="Post" enctype="multipart/form-data">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <b>
                            <h4 class="page-header">Print Master</h4>
                        </b>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <b><label>Select Year</label></b>
                                <select class="form-control" name="cd_year" id="cd_year">
                                    <?php
                                      $query = "select * FROM year_master ORDER BY Y_CODE DESC limit 7";
                                      $rs = $con->query($query);
                                      while($row = $rs->fetch_assoc())
                                      {
                                        ?>
                                        <option value="<?php echo $row['Y_CODE']; ?>">
                                            <?php echo $row["Y_CODE"]; ?>
                                        </option>
                                    <?php
                                      }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <b style="color: red;">Print Master</b>
                                        </div>

                                        <div class="panel-body">
                                            <div class="row">
                                            	<div class="col-lg-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <b style="color: red;">Create Report</b>
                                                        </div>
                                                        <div class="panel-body">
		                                            		<div class="col-lg-1">
			                                            		<div class="form-group">
			                                                        <input type="radio" id="rdall" name="rdall" value="ALL" checked=""> <b>ALL</b>
			                                                    </div>
			                                                </div>
			                                                <div class="col-lg-2">
			                                                    <div class="form-group">
			                                                        <input type="radio" id="rddate" value="DATE" name="rdall"> <b>DATE</b>
			                                                    </div>
			                                            	</div>
			                                            </div>
			                                        </div>
                                            	</div>
                                                <div class="col-lg-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <b style="color: red;">Create Report</b>
                                                        </div>
                                                        <div class="panel-body">
                                                        	<div class="col-lg-3">
                                                                <b><label>Training Year</label></b>
                                                                <div class="form-group">
                                                                    <select class="form-control" name="tr_year" id="tr_year">
                                                                        <option value="All">All</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <b><label>Enroll Year</label></b>
                                                                <div class="form-group">
                                                                    <select class="form-control" name="en_year" id="en_year">
                                                                        <option value="All">All</option>
                                                                    <?php
                                                                        $query = "SELECT SUBSTRING(Y_CODE,3,2) AS Y_CODE FROM  year_master";
                                                                        $rs = $con->query($query);
                                                                        while($row = $rs->fetch_assoc())
                                                                        {
                                                                    ?>
                                                                            <option value="<?php echo $row["Y_CODE"]; ?>">
                                                                                <?php echo $row["Y_CODE"]; ?>
                                                                            </option>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <b><label>Troop Code</label></b>
                                                                <input class="form-control" name="troop_code" id="troop_code">
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <b><label>State Code</label></b>
                                                                <div class="form-group">
                                                                    <select class="form-control" name="state_code" id="state_code">
                                                                        <option value="">--Select--</option>
                                                                        <?php
                                                                            $query = "SELECT * FROM state_master WHERE STATE_STATUS=1 ORDER BY STATE_CODE ASC";
                                                                            $rs = $con->query($query);
                                                                            while($row = $rs->fetch_assoc())
                                                                            {
                                                                        ?>
                                                                            <option value="<?php echo $row["STATE_CODE"]; ?>">
                                                                                <?php echo $row["STATE_CODE"]; ?>
                                                                            </option>
                                                                        <?php
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <b><label>Start Cadet No.</label></b>
                                                                <div class="form-group">
                                                                	<input class="form-control" name="uno" id="uno">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <b><label>End Cadet No.</label></b>
                                                                <div class="form-group">
                                                                	<input class="form-control" name="uno1" id="uno1">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3 visible"  id="dfromdate">
			                                        			<label>From Date</label>
			                                        			<div class="form-group">
		                                                        	<input type="date" class="form-control" name="fromdate" 
		                                                        	value="<?php echo date('Y-m-d'); ?>">
		                                                        </div>
			                                            	</div>
			                                            	<div class="col-lg-3 visible" id="dtodate">
			                                            		<label>To Date</label>
			                                            		<div class="form-group">
		                                                        	<input type="date" class="form-control" name="todate" value="<?php echo date('Y-m-d'); ?>">
		                                                        </div>
			                                            	</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <b style="color: red;">Type of Report</b>
                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <input type="radio" name="rdreport" value="View Cadets" checked=""> <b> View Cadets </b>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <input type="radio" name="rdreport" value="Genrate Data File">  <b> Genrate Data File </b>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <input type="radio" name="rdreport" value="Print Certificate"> <b> Print Certificate </b>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <input type="radio" name="rdreport" value="Print Camp form"> <b> Print Camp form </b>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <input type="radio" name="rdreport" value="Full Report"> <b> Full Report </b>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <input type="radio" name="rdreport" value="Correction Report"> <b> Correction Report </b>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <input type="radio" name="rdreport" value="Summary Report"> <b> School Summary Report </b>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <input type="radio" name="rdreport" value="Camp Summary"> <b> Camp Summary </b>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <input type="radio" name="rdreport" value="Total Sammary Report"> <b> Total Summary </b>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <input type="radio" name="rdreport" value="School Changing Report"> <b> School Changing Report </b>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="float: right;">
                                                <div class="col-lg-12">
                                                    <button type="submit" name="btnsubmit" class="btn btn-success"> Submit </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    </form>
    <div>
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
                                        <th>Address</th>
                                        <th>City</th>
                                    </tr>
                                </thead>
                                <?php
                                if(isset($_POST["btnsubmit"]))
                                {
                                    $year = $_POST["cd_year"];
                                    $tr_year = $_POST["tr_year"];
                                    $en_year = $_POST["en_year"];
                                    $troop_code = $_POST["troop_code"];
                                    $state_code = $_POST["state_code"];
                                    $uno = $_POST["uno"];
                                    $uno1 = $_POST["uno1"];

                                    $enrollid = $en_year . "-" . $troop_code . "-" . $state_code . "-" . $uno;
                                    $enrollid1 = $en_year . "-" . $troop_code . "-" . $state_code . "-" . $uno1;

                                    $query = "";

                                    if($en_year == "All" || $en_year == NULL)
                                    {
                                    $year_count = 1;
                                    $query = $query . "SELECT * FROM enroll_master WHERE (";
                                    $sql = "select count(*) as 'count' from year_master";
                                    $resss = $con->query($sql);
                                    $counts = $resss->fetch_assoc()["count"];

                                    $sql = "select * from year_master";
                                    $resss = $con->query($sql);    
                                    while ($row = $resss->fetch_assoc()) {
                                      if($year_count == $counts)
                                      {
                                        $query = $query . " yoe = '" . ($row["Y_CODE"][2].$row["Y_CODE"][3]) . "' ";
                                        break;
                                      }
                                      $query = $query . "yoe = '" . ($row["Y_CODE"][2].$row["Y_CODE"][3]) . "' OR ";
                                      $year_count = $year_count + 1;
                                    }
                                    $query = $query . " )";
                                    }
                                    else
                                    {
                                    $query = $query . "SELECT * FROM enroll_master WHERE yoe = '".$en_year."'";
                                    }

                                    if($year != NULL)
                                    {
                                    	$query = $query . " AND c_year = '".$year[0].$year[1].$year[2].$year[3]."' ";
                                    }

                                    if($troop_code != NULL)
                                    {
                                      $query = $query . " AND enrollment_id like '%".$troop_code."%' ";
                                    }
                                    else
                                    {

                                    }

                                    if($state_code == "--Select--")
                                    {

                                    }
                                    else
                                    {
                                      $query = $query . " AND enrollment_id like '%".$state_code."%' ";
                                    }

                                    if ($uno1 == NULL && $uno != NULL) {
                                    	if($_POST["en_year"] == "All")
                                    	{
                                    		$number = 0;
                                    		$query = $query . " AND (";
                                    		$sql1 = "select count(*) as 'counts' from year_master";
                                    		$rs1 = $con->query($sql1);
                                    		while($row = $rs1->fetch_assoc())
                                    		{
                                    			$number = $row["counts"];
                                    		}

                                    		$sql = "select * from year_master";
                                    		$rs = $con->query($sql);
                                    		$count = 0;
                                    		while ($row = $rs->fetch_assoc()) {
                                    			if($count >= ($number - 1))
                                    			{
                                    				$query = $query . " enrollment_id = '".($row["Y_CODE"]. "-" . $troop_code . "-" . $state_code . "-" . $uno)."'";
                                    			}
                                    			else
                                    			{
                                    				$query = $query . " enrollment_id = '".($row["Y_CODE"]. "-" . $troop_code . "-" . $state_code . "-" . $uno)."' or";
                                    			}
                                    			$count++;
                                    		}
                                    		$query = $query . ")";
                                    	}
                                    	else
                                    	{
                                    		$query = $query . " AND enrollment_id = '".$enrollid."'";
                                    	}
                                    }
                                    else if($uno1 != NULL && $uno != NULL)
                                    {
                                    	$query = $query . " AND enrollment_id >= '".$enrollid."' AND enrollment_id <= '".$enrollid1."'";
                                    }

                                    if($_POST["tr_year"] != "All")
                                    {
                                        $query = $query . " AND t_year = ".$_POST["tr_year"];
                                    }

	                                else if ($_POST["rdall"] == "DATE") 
	                                {
	                                	if($_POST["fromdate"] == $_POST["todate"])
	                                	{
	                                		$query = $query . "AND date_time like '%".$_POST["fromdate"]."%'";
	                                	}
	                                	else
	                                	{
	                                		$query = $query . "AND date_time between '".$_POST["fromdate"]."' and '".$_POST["todate"]."' OR date_time like '%".$_POST["todate"]."%'";
	                                	}
	                                }

                                    $query = $query . " ORDER BY t_year ASC";
                                    $_SESSION["query"] = $query;

                                    if($_POST["rdreport"] == "View Cadets")
                                    {
                                        $rs = $con->query($query);  
                                         $count = 0;
                                         while($row = $rs->fetch_assoc())
                                         {
                                             $count = $count + 1;
                                              echo "<tr style='background-color:lightblue;'>";
                                              echo "<td><b>".$count."</b></td>";
                                              echo "<td><b>".$row['enrollment_id']."</b></td>";
                                              echo "<td><b>".($row['last_name']. " " .$row['first_name'] . " " . $row['middle_name'])."</b></td>";
                                              echo "<td><b>".$row['std']."</b></td>";
                                              echo "<td><b>".$row['t_year']."</b></td>";
                                              echo "<td><b>".$row['yoe']."</b></td>";
                                              echo "<td><b>".$row['c_year']."</b></td>";
                                              echo "<td><b>".$row['address']."</b></td>";
                                              echo "<td><b>".$row['city']."</b></td>";
                                              echo "</tr>";
                                         }
                                    }
                                    if($_POST["rdreport"] == "Genrate Data File")
                                    {
                                        echo "<script>window.open('/AANINDIA/Admin/PDFreport.php','_blank');</script>";
                                    }
                                    if($_POST["rdreport"] == "Print Certificate")
                                    {
                                        echo "<script>window.open('/AANINDIA/Admin/trainig_certificate_print.php','_blank');</script>";
                                    }
                                    if($_POST["rdreport"] == "Print Camp form")
                                    {
                                        echo "<script>window.open('/AANINDIA/Admin/camp_form.php','_blank');</script>";
                                    }
                                    if($_POST["rdreport"] == "Full Report")
                                    {
                                        $_SESSION["cd_year"] = $_POST["cd_year"];
                                        echo "<script>window.open('/AANINDIA/Admin/Full_Data.php','_blank');</script>";
                                    }

                                    if($_POST["rdreport"] == "Camp Summary")
                                    {
                                        $_SESSION["cd_year"] = $_POST["cd_year"];
                                        echo "<script>window.open('/AANINDIA/Admin/Camp_Summary.php','_blank');</script>";   
                                    }

                                    if($_POST["rdreport"] == "School Changing Report")
                                    {
                                        $_SESSION["cd_year"] = $_POST["cd_year"];
                                        echo "<script>window.open('/AANINDIA/Admin/School_Change.php','_blank');</script>";  
                                    }

                                    if($_POST["rdreport"] == "Total Sammary Report")
                                    {
                                        $_SESSION["cd_year"] = $_POST["cd_year"];
                                        echo "<script>window.open('/AANINDIA/Admin/Total_Summary.php','_blank');</script>";
                                    }

                                    if($_POST["rdreport"] == "Summary Report")
                                    {
                                        $troop = "All";
                                        $state = "All";
                                        if($_POST["troop_code"] == "")
                                        {
                                            $troop = "All";
                                        }
                                        else
                                        {
                                            $troop = $_POST["troop_code"];
                                        }
                                        if($_POST["state_code"] == "--Select--")
                                        {
                                            $state = "All";
                                        }
                                        else
                                        {
                                            $state = $_POST["state_code"];
                                        }

                                        $_SESSION["cd_year"] = $_POST["cd_year"];
                                        $_SESSION["troop_code"] = $troop;
                                        $_SESSION["state_code"] = $state;
                                        echo "<script>window.open('/AANINDIA/Admin/summary.php','_blank');</script>";
                                    }
                                    if($_POST["rdreport"] == "Correction Report")
                                    {
                                        echo "<script>window.open('/AANINDIA/Admin/correction.php','_blank');</script>";
                                    }
                                }
                                     ?>
            </tbody>
</div>
<?php include '../footer.php'?>