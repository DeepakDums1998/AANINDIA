
<?php include'header.php';
    ?>
<script src="../../Resources/js/jquery.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#bond").change(function(){
            var data = document.getElementById("bond").value;
            $.ajax({
                 type: 'post',
                 url: 'VerifyEnrollmentId.php',
                 data: {
                     get_enroll: data
                 },
                 success: function (response) {
                    if(response >= 0)
                    {
                        window.location.href = "Add_Chest_Card.php?Bond="+response;
                    }
                    else
                    {
                        Swal.fire({
                          position: 'center',
                          icon: 'warning',
                          title: ''+response
                        });
                    }
                 }
             });
        });
    });
</script>
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="page-header">CADET ENTRY</h2>
                            <div>
                              <div class="form-group">
                                    <label>Enter Enrollment Number Here</label>
                                    <input type="text" id="bond" class="form-control" autofocus>
                                    <p class="help-block">Example : 16-9999-GUJ-001 </p>
                                </div>
                                <div>
                            </div>
                            </div>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
<div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    OFFICER REPORT
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <?php
                                                $query = "select * FROM camp_cadet_entry order by entry_time DESC limit 5";
                                                $rs = $con->query($query);  
                                                ?>
                                            <thead>
                                                <tr>
                                                    <th>Sr.No</th>
                                                    <th>Cadet Enrollment Number</th>
                                                    <th>Chest Card Number</th>
                                                    <th>Name</th>
                                                    <th>Reg Number</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $count = 0;
                                                while($row = $rs->fetch_assoc())
                                                {
                                                    $count = $count + 1;
                                                    if($count == 1)
                                                    {
                                                    	echo "<tr style='background-color:lightblue;'>";
	                                                    echo "<td><b>".$count."</b></td>";
	                                                    echo "<td><b>".$row['C_No']."</b></td>";
	                                                    echo "<td><b>".$row['Chest_Card_No']."</b></td>";
	                                                    echo "<td><b></b></td>";
	                                                    echo "<td><b></b></td>";
	                                                    echo "</tr>";
                                                    }
                                                    else
                                                    {
	                                                    echo "<tr>";
	                                                    echo "<td>".$count."</td>";
	                                                    echo "<td>".$row['C_No']."</td>";
	                                                    echo "<td>".$row['Chest_Card_No']."</td>";
	                                                    echo "<td></td>";
	                                                    echo "<td></td>";
	                                                    echo "</tr>";
	                                                }
                                                }
                                                ?>
                                            </tbody>   
                                    </div>
                                    <form method="post" action="export.php"></form>
<?php include'footer.php'; ?>