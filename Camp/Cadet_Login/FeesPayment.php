<?php
require_once("header.php");
?>		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<b><h4 class="page-header">Fees Payment</b></h4>
				</b>
			</div>
		</div>
		<div>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<b>Fees Payment For Year</b>
						</div>
						<!-- /.panel-heading -->
						<div class="panel-body">
							
							<?php
							$feesdata="SELECT * FROM fees_payment_date where C_YEAR=(SELECT c_year from year_master where Y_STATUS=1) and CURRENT_DATE >= START_DATE AND CURRENT_DATE<=END_DATE";
							if($con->query($feesdata)->num_rows!=0)
							{
							$sql = "SELECT * FROM enroll_master WHERE e_id = ".$_SESSION["Login_id"]." and c_year = YEAR(CURRENT_DATE)-1 and t_year<5";
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
							<div class="row">
								<?php
								$feesdata="SELECT * FROM fees_payment_date where C_YEAR=(SELECT c_year from year_master where Y_STATUS=1)";
								?>
								<div class="col-lg-6">
									<b>START DATE:<i style="color: red;"><?php
									echo $con->query($feesdata)->fetch_assoc()["START_DATE"];
									?></i></b>
								</div>
								<div class="col-lg-6">
									<b style="float: right;">END DATE:<i style="color: red;"><?php
									echo $con->query($feesdata)->fetch_assoc()["END_DATE"];
									?></i></b>
								</div>
							</div>
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
										<tr>
											<th>Enrollment ID </th>
											<th>For The Training Year</th>
											<th>Fees Amount</th>
											<th>Click on Pay</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<?php
											
													$_SESSION['Payment_details']=array("Name"=>$con->query($sql)->fetch_assoc()["first_name"]." ".$con->query($sql)->fetch_assoc()["middle_name"]." ".$con->query($sql)->fetch_assoc()["last_name"],
														"for_year"=>$next_year,
												"Mail_id"=>$con->query($sql)->fetch_assoc()["e_id"],
												"Contact_no"=>$con->query($sql)->fetch_assoc()["mobile1"],
												"address"=>$con->query($sql)->fetch_assoc()["address"],
												"merchant_order_id"=>date("Y-m-d")."-".$con->query($sql)->fetch_assoc()["e_id"]
												
											);
												
											echo "<tr><td>{$enrollment_id}</td>";
											$query="select amount from tbl_feesstucture where t_year = $next_year";
											$amount=$con->query("select amount from tbl_feesstucture where t_year = $next_year")->fetch_assoc()["amount"];
											
											$_SESSION['Payment_details']["amount"]=$amount;
											echo "<td>". $next_year ."</td>";
											echo "<td>&#8377;". $amount .".00</td>";
											echo "<td>";
																				require_once ("razorpay/pay.php");
											echo "</td>";
										echo "</tr>";
									?></tr>
								</tbody>
							</table>
						</div>
					
					<?php	}
				}
					else
					{
					echo "YOUR FEES IS PAID FOR CURRENT YEAR.";
					}
					
					}
					else
					{
						echo "<b>FEES PAYMENT IS NOT STARTED YET!</b>";
					}
					?>
					</div>
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
</div>
</body>
</html>