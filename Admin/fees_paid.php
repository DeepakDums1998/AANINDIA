<?php
require_once("../header.php");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <b><h4 class="page-header">FEES MANAGEMENT</b></h4>
        </b>
      </div>
    </div>
    
   <div class="panel-body">
                 <div class="row">
                    <?php
                  $sortkey="";
                  $sql="SELECT * FROM school_master WHERE SC_ID='{$_SESSION['inLogin_id']}'";
                  $troop_code=$con->query($sql)->fetch_assoc()["TROOP_CODE"];
                  $S_ID=$con->query($sql)->fetch_assoc()["STATE_ID"];
                  $get_state="SELECT * FROM state_master where STATE_ID='{$S_ID}'";
                  $state_code=$con->query($get_state)->fetch_assoc()["STATE_CODE"];
                  $sortkey= $sortkey."-".$troop_code."-".$state_code;
                  ?>
                        <div class="col-lg-2 col-md-2">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        
                                        <div class="col-xs-12 ">
                                            <div><b><?php $total_first="Select count(*) AS tf from fees_payment where year=(Select c_year from year_master where Y_STATUS = 1) and fees_for_year=1"; 

                                            ?>

                    FIRST YEAR </b></div>
                    <div class="huge "><?php echo $con->query($total_first)->fetch_assoc()["tf"]; ?></div>
                                            
                                        </div>
                                    </div>
                                </div>
                               
                                    <div class="panel-footer">
                                       <a href="#">
                                        <span class="pull-left">  Amount :  &#8377; <?php $total_first_M="Select sum(amount) AS tf from fees_payment where year=(Select c_year from year_master where Y_STATUS = 1) and fees_for_year=1";
                                        if($con->query($total_first_M)->fetch_assoc()["tf"]==NULL)
                                        {
                                            echo "0";
                                        }
                                        else
                                        {
                    echo $con->query($total_first_M)->fetch_assoc()["tf"];
                }
                    ?>/-
                    <br>
                   </span>
                   <a href="?year=1"><span>View Details</span></a>
                                       
                            
                                        <div class="clearfix"></div>
                                      </a>
                                    </div>
                                
                            </div>
                        </div>
                        
                      
                        <div class="col-lg-2 col-md-2">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                       
                                        <div class="col-xs-12">
                                           
                                            <div> <?php $total_first="Select count(*) AS tf from fees_payment where year=(Select c_year from year_master where Y_STATUS = 1) and fees_for_year=2" ;?>
                    <b> SECOND YEAR </b><div class="huge" ><?php echo $con->query($total_first)->fetch_assoc()["tf"]; ?></div></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left"> Amount :  &#8377; <?php $total_first_M="Select sum(amount) AS tf from fees_payment where year=(Select c_year from year_master where Y_STATUS = 1) and fees_for_year=2";
                                        if($con->query($total_first_M)->fetch_assoc()["tf"]==NULL)
                                        {
                                            echo "0";
                                        }
                                        else
                                        {
                    echo $con->query($total_first_M)->fetch_assoc()["tf"];
                }
                    ?>/-
                    <br>
                    </span>
                    <a href="?year=2"><span>View Details</span></a>
                                       

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                       
                                        <div class="col-xs-12 ">
                                           
                                            <div><?php $total_first="Select count(*) AS tf from fees_payment where year=(Select c_year from year_master where Y_STATUS = 1) and fees_for_year=3";?>
                    <b>THIRD YEAR </b> <div class="huge"> <?php echo $con->query($total_first)->fetch_assoc()["tf"]; ?></div></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left"> Amount :  &#8377; <?php $total_first_M="Select sum(amount) AS tf from fees_payment where year=(Select c_year from year_master where Y_STATUS = 1) and fees_for_year=3";
                                        if($con->query($total_first_M)->fetch_assoc()["tf"]==NULL)
                                        {
                                            echo "0";
                                        }
                                        else
                                        {
                    echo $con->query($total_first_M)->fetch_assoc()["tf"];
                }
                    ?>/-
                    <br>
                    </span>
                    <a href="?year=3"><span>View Details</span></a>
                                       

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                      
                                        <div class="col-xs-12 ">
                                           
                                            <div> <?php $total_first="Select count(*) AS tf from fees_payment where year=(Select c_year from year_master where Y_STATUS = 1) and fees_for_year=4";?>
                    <b> FORTH YEAR </b><div class="huge"> <?php echo $con->query($total_first)->fetch_assoc()["tf"]; ?> </div></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left"> Amount :  &#8377; <?php $total_first_M="Select sum(amount) AS tf from fees_payment where year=(Select c_year from year_master where Y_STATUS = 1) and fees_for_year=4";
                                        if($con->query($total_first_M)->fetch_assoc()["tf"]==NULL)
                                        {
                                            echo "0";
                                        }
                                        else
                                        {
                    echo $con->query($total_first_M)->fetch_assoc()["tf"];
                }
                    ?>/-
                    <br>
                    </span>
                    <a href="?year=4"><span>View Details</span></a>
                                       

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <div class="panel" style="background-color:black; color: white;">
                                <div class="panel-heading">
                                    <div class="row">
                                       
                                        <div class="col-xs-12">
                                           
                                            <div> <?php $total_first="Select count(*) AS tf from fees_payment where year=(Select c_year from year_master where Y_STATUS = 1) and fees_for_year=5";?>
                    <b>FIFTH YEAR </b><div class="huge"> <?php echo $con->query($total_first)->fetch_assoc()["tf"]; ?></div></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left"> Amount :  &#8377; <?php $total_first_M="Select sum(amount) AS tf from fees_payment where year=(Select c_year from year_master where Y_STATUS = 1) and fees_for_year=5";
                                        if($con->query($total_first_M)->fetch_assoc()["tf"]==NULL)
                                        {
                                            echo "0";
                                        }
                                        else
                                        {
                    echo $con->query($total_first_M)->fetch_assoc()["tf"];
                }
                    ?>/-
                    <br>
                    </span>
                    <a href="?year=5"><span>View Details</span></a>
                                       

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <div class="panel " style="background-color:red; color: white;">
                                <div class="panel-heading">
                                    <div class="row">
                                       
                                        <div class="col-xs-12 ">
                                           
                                            <div> <?php
                    $total="Select count(*) AS tf from fees_payment where year=(Select c_year from year_master where Y_STATUS = 1)";
                    //echo $total;
                    ?>
                    <b> TOTAL COUNT </b><div class="huge"><?php echo $con->query($total)->fetch_assoc()["tf"]; ?>
                    </div></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">Amount : &#8377;<?php $total_first_M="Select sum(amount) AS tf from fees_payment where year=(Select c_year from year_master where Y_STATUS = 1) ";
                                        if($con->query($total_first_M)->fetch_assoc()["tf"]==NULL)
                                        {
                                            echo "0";
                                        }
                                        else
                                        {
                    echo $con->query($total_first_M)->fetch_assoc()["tf"];
                }
                    ?>/-
                    <br>
                  </span>
                  <a href="?year=0"><span>View Details</span></a>
                                       

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        
                        
                    </div>
                
              </div>
    <!-- /.row (nested) -->
  </div>
  <?php
  if(isset($_GET['year']))
  {
    ?>
     <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <b style="color: red;">FEES DETAILS</b>
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>SR.NO</th>
                                                    <th>ENROLLMENT NO</th>
                                                    <th>FULL NAME</th>
                                                    <th>FORM NO</th>
                                                    <th>TRANSACTION ID</th>
                                                    <th>TRANING YEAR</th>
                                                    <th>AMOUNT</th>
                                                </tr>
                                            </thead>
                                           <tbody>
                                                <?php
                                    if($_GET['year']==0)
                                                    {
                                                         $sql = "SELECT * FROM fees_payment";
                                                    }
                                                    else
                                                    {

                              $sql = "SELECT * FROM fees_payment where fees_for_year={$_GET['year']}";
                          }
                              $result = $con->query($sql);
                              $count=1;
                              while ($row = $result->fetch_assoc()) {
                             
                      
                                                ?>
                                               <tr>
                                                <?php

                                                    $getenroll_id="SELECT * FROM enroll_master WHERE e_id={$row['e_id']}";
                                                    ?>
                                                <td><?php
                                                echo $count++;
                                                ?></td>
                                                <td>
                                                        <?php
                                                        echo $con->query($getenroll_id)->fetch_assoc()['enrollment_id'];
                                                        ?>
                                                </td>
                                                <td>
                                                        <?php
                                                        echo $con->query($getenroll_id)->fetch_assoc()['first_name']." ".$con->query($getenroll_id)->fetch_assoc()['middle_name']." ".$con->query($getenroll_id)->fetch_assoc()['last_name'];
                                                        ?>
                                                </td>
                                                <td>
                                                        <?php
                                                        echo $con->query($getenroll_id)->fetch_assoc()['form_no'];
                                                        ?>
                                                </td>
                                                <td>
                                                        <?php
                                                        echo $row['payment_id'];
                                                        ?>
                                                </td>
                                                <td>
                                                        <?php
                                                        echo $row['fees_for_year'];
                                                        ?>
                                                </td>
                                                <td>
                                                        <?php
                                                        echo $row['amount'];
                                                        ?>
                                                </td>
                                               </tr>
                                               <?php
                                           }
                                               ?>
                                           </tbody>
                                        </table>
                                    </div>
                                   
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
    <?php
  }
  ?>
  <!-- /.panel-body -->
</div>
<?php

?>
<script src="../Resources/js/jquery.min.js"></script>
<script src="../Resources/js/bootstrap.min.js"></script>
<script src="../Resources/js/metisMenu.min.js"></script>
<script src="../Resources/js/dataTables/jquery.dataTables.min.js"></script>
<script src="../Resources/js/dataTables/dataTables.bootstrap.min.js"></script>
<script src="../Resources/js/metisMenu.min.js"></script>
<script src="../Resources/js/startmin.js"></script>
<script>
$(document).ready(function() {
$('#dataTables-example').DataTable({
responsive: true,
language: {
processing: "<img src='../Resources/images/new.gif'>"
}
});
});
</script>
</body>
</html>