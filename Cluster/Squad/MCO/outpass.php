
<?php include'header.php';
$sql = "select * from camp_cadet_entry where Chest_Card_No = ".$_GET["chestcard"]. " and Camp_Id = ".$_GET["Bond"];
$res = $con->query($sql);
while ($row = $res->fetch_assoc()) {
    if(!($row["camp_status"] == $_GET["status"])){
        header("location:outpass.php?Bond=".$row["Camp_Id"]."&chestcard=".$row["Chest_Card_No"]."&status=".$row["camp_status"]);
    }
}
$flag = 0;
$date = NULL;
$reason = "";
?>

<script src="../../../Resources/js/jquery.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="page-header">OUTPASS</h2>
                            <form method="post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Enter Chest Card Number Here</label>
                                            <input type="text" id="bond" class="form-control" value="<?php echo $_GET['chestcard']; ?>" readonly>
                                      </div>
                                    </div>
                                     <div class="col-lg-2">
                                        <?php
                                        if($_GET["status"] == 0)
                                        {
                                            $sql = 'select * from camp_cadet_entry where Chest_Card_No = '.$_GET['chestcard'].' and camp_status = 0 and Camp_Id = '.$_GET['Bond'];
                                            
                                            $id = $con->query($sql)->fetch_assoc()['outpass_id'];

                                            $sql = 'select * from tbl_outpass_master where OP_Id = '.$id;
                                            $res = $con->query($sql);
                                            while($row = $res->fetch_assoc())
                                            {
                                                $reason = $row["Reason"];
                                                if(empty($row['OP_Time'])){
                                                    echo '';
                                                }
                                                else
                                                {
                                                    $flag = 1;
                                                    $date =  $row['OP_Time'];
                                                }
                                            }
                                        }
                                        ?>
                                        <div class="form-group">
                                            <label>Enter Assign Time Here</label>
                                            <input type="text" id="bond" name="min" placeholder="Enter x In Min." class="form-control" value="<?php echo $date; ?>" <?php if($_GET["status"] == 0){echo "required";}?>  <?php if($flag == 1){echo "readonly";}?> >
                                          </div>
                                     </div>
                                     <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Enter Assign Time Here</label>
                                            <textarea class="form-control" name="txtreason"><?php echo $reason; ?></textarea>
                                          </div>
                                     </div>
                                    <?php
                                        if($_GET["status"] == 1)
                                        {
                                            ?>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <input type="submit" value="OUTPASS" style="margin-top: 40px;" name="btnout" class="btn btn-warning">
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <!--<div class="col-lg-1">
                                                <div class="form-group">
                                                    <input type="submit" value="UPDATE" name="btnupdate" style="margin-top: 25px;" class="btn btn-primary">
                                                </div>
                                            </div>-->
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <input type="submit" value="INPASS" name="btnin" style="margin-top: 25px;" class="btn btn-success">
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    ?>
                              </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                if(isset($_POST["btnout"]))
                {
                    $intime = NULL;
                    $sql = "insert into tbl_outpass_master(DC_Id,Camp_Id,OP_Type) values(".$_GET["chestcard"].",".$_GET["Bond"].",1)";
                    if($_POST["min"] == "")
                    {
                        $sql = "insert into tbl_outpass_master(DC_Id,Camp_Id,OP_Type) values(".$_GET["chestcard"].",".$_GET["Bond"].",1)";
                    }
                    else
                    {
                        $intime = $con->query("select CURRENT_TIMESTAMP as time")->fetch_assoc()["time"];
                        $intime = date('Y-m-d H:i:s',strtotime('+'.$_POST["min"].' minutes',strtotime($intime)));
                        $sql = "insert into tbl_outpass_master(DC_Id,Camp_Id,OP_Type,OP_Time,Reason) values(".$_GET["chestcard"].",".$_GET["Bond"].",1,'".$intime."','".$_POST["txtreason"]."')";
                    }
                    if($con->query($sql) == TRUE)
                    {
                        $sql = "select * from tbl_outpass_master where DC_Id =".$_GET["chestcard"]." order by Out_Time limit 1";
                        $id = $con->query($sql)->fetch_assoc()["OP_Id"];

                        $sql = "update camp_cadet_entry set camp_status = 0,outpass_id = ".$id."     where Chest_Card_No = ".$_GET["chestcard"]." and Camp_Id = ".$_GET["Bond"];
                        if($con->query($sql) == TRUE)
                        {
                            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
                              <script>Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Outpass Successfully...',
                                showConfirmButton: false,
                                timer: 2000
                              });setInterval(function(){ window.location.href = 'index.php'; }, 2000);</script>";
                        }
                    }
                }

                if(isset($_POST["btnin"]))
                {
                    $select = 'select * from camp_cadet_entry where Chest_Card_No = '.$_GET['chestcard'].' and camp_status = 0 and Camp_Id = '.$_GET['Bond'];
                    $id = $con->query($select)->fetch_assoc()['outpass_id'];
                    $sql = "update camp_cadet_entry set camp_status = 1,outpass_id = 0 where Chest_Card_No = ".$_GET["chestcard"]." and Camp_Id = ".$_GET["Bond"];
                    if($con->query($sql) == TRUE)
                    {
                        $sql = "update tbl_outpass_master set In_Time = '".date("Y-m-d H:i:s")."' where DC_Id = ".$_GET["chestcard"]." and Camp_Id = ".$_GET["Bond"];
                        if($con->query($sql) == TRUE)
                        {
                            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
                              <script>Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Cadet Successfully In...',
                                showConfirmButton: false,
                                timer: 2000
                              });setInterval(function(){ window.location.href = 'index.php'; }, 2000);</script>";
                        }
                    }
                }
                ?>
<?php include'footer.php'; ?>