<?php
require_once("header.php");
?>	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<b><h4 class="page-header">Fees Details</b></h4>
						</b>
					</div>
				</div>
				<div>
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default">
								
								<div class="panel-heading">
									<b>Fees Payment Done For Years</b>
								</div>
									<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover" id="dataTables-example">
											<thead>
												<tr>
													<th>Enrollment ID</th>
													<th>Year</th>
													<th>For Training Year</th>
													<th>Transaction id</th>
													<th>Fees Amount Paid</th>
													<th>Download Receipt</th>
													<th>Enrollment Form</th>
												</tr>
												</thead>
												<?php
												$sql = "SELECT * FROM enroll_master WHERE e_id = ".$_SESSION["Login_id"];
												$receipt="SELECT * from fees_payment where e_id={$_SESSION["Login_id"]} ";
												$result=$con->query($receipt);
												while($row = $result->fetch_assoc()) {
												?>    <tr>
													<td><?php echo $con->query($sql)->fetch_assoc()["enrollment_id"];  ?></td>
													<td><?php $next_year=intval(substr($row["year"],2))+1;
													echo $row["year"]."-".$next_year; ?></td>
													<td><?php echo $row["fees_for_year"]; ?></td>
													<td><?php echo $row["payment_id"]; ?></td>
													<td>&#8377;<?php echo $row["amount"]; ?></td>
													<td><a href="Receipt.php?year=<?php echo $row["year"]; ?>">Download Receipt</a></td>
													<?php
												
														if($row["year"]== substr(date("Y/m/d"),0,4))
														{
													?>
													<td><a href="enrollmentform.php">Download Form <img style="float: right;" src="../../Resources/images/new.gif"></a></td>
													<?php
												}
												else{
													?>
														<td>N/A</td>
														<?php
												}
													?>
												

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
								</body>
							</html>
							
						