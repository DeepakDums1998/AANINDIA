<?php include'header.php';
if(!isset($_GET["Bond"]))
{
    header("location:index.php");
}

$flag = 0;
$squadsql = "select * from squad_master where S_No = ".$_SESSION["Id"];
$squadres = $con->query($squadsql);
$squadno = 0;
while ($row = $squadres->fetch_assoc()) {
  $squadno = $row["C_ID"];
}

$sql = "select * from camp_cadet_entry where Camp_Id = ".$squadno." and C_No = ".$_GET["Bond"];
$res = $con->query($sql);
while ($row = $res->fetch_assoc()) {
  $flag = 1;
}

if($flag == 1)
{
  echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
      <script>Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'This Cadet Already Assign Chest Card...',
        showConfirmButton: false,
        timer: 2000
      });setInterval(function(){ window.location.href = 'index.php'; }, 2000);</script>";
}
?>
<script src="../../Resources/js/jquery.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#chest_card").change(function(){
            var data = document.getElementById("chest_card").value;
            if((data > 1000 && data < 1181) || (data > 2000 && data < 2181) || (data > 3000 && data < 3181) || (data > 4000 && data < 4181) || (data > 5000 && data < 5181) || (data > 6000 && data < 6181) || (data > 7000 && data < 7181) || (data > 8000 && data < 8181) || (data > 9000 && data < 9181))
            {
                $.ajax({
                     type: 'post',
                     url: 'verifyChest_Card.php',
                     data: {
                         Bond: <?php echo $_GET['Bond']; ?>,
                         Chest_Card:data,
                         squad:<?php echo $_SESSION["Id"]; ?>
                     },
                     success: function (response) {
                        if(response == 0)
                        {
                            window.location.href = "index.php";
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
            }
            else
            {
                Swal.fire({
                  position: 'center',
                  icon: 'warning',
                  title: 'Chect Card Number Is Not Valid'
                });
            }
        });
    });
</script>
            <?php
                $enrollment_id = 0;
                $name = "";
                $sql = "select * from enroll_master where e_id = ".$_GET["Bond"];
                $res = $con->query($sql);
                while ($row = $res->fetch_assoc()) {
                    $enrollment_id = $row["enrollment_id"];
                    $name = $row["last_name"]." ".$row["first_name"]." ".$row["middle_name"];
                }
            ?>
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="page-header">CADET CHEST CARD</h2>
                            <div>
                              <div class="form-group">
                                    <label>Enter Form Number Here</label>
                                    <input type="text" class="form-control" value="<?php echo $enrollment_id; ?>" readOnly><br/>
                                    <label>Enter Form Chest Card Here</label>
                                    <input type="text" id="chest_card" class="form-control" autofocus>
                                    <p class="help-block">Example : 100 , 200 </p>
                                </div>
                                <div>
                            </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <?php
                               echo "<h1>Cadet Name : <span style='color:red;'>".$name."</span>";
                            ?>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
<?php include'footer.php'; ?>