<?php
require_once("../header.php");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var year=0;
  $("#link1").click(function(){
    alert("Year 1.");
  });
  $("#link2").click(function(){
    alert("Year 2.");
  });
  $("#link3").click(function(){
    alert("Year 3.");
  });
  $("#link4").click(function(){
    alert("Year 4.");
  });
  $("#link5").click(function(){
    alert("Year 5.");
  });
});
        /*var datas = Car_name + "\t" + Company_name + "\t" + Fuel_type + "\t" + Price + "\t" + Description + "\t" + File_Name + "\n";
        $.ajax({  
            type: 'POST',  
            url: 'Ajaxsenddata.php', 
            data: { CarInfo:datas },
            success: function(response) {
                alert(response);
            }
        });*/
    
</script>
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <b><h4 class="page-header">FEES MANAGEMENT</b></h4>
        </b>
      </div>
    </div>
    
   <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                      
                                        <div class="col-xs-9 ">
                                            <div class="huge">

                                                <?php
                                                $feesPaid="Select count(*) AS PAIDC from fees_payment where year=(Select c_year from year_master where Y_STATUS = 1)";
                                               // echo $feesPaid;
                                                echo $con->query($feesPaid)->fetch_assoc()['PAIDC'];
                                            ?></div>
                                            <div><b>Students Paid Fees</b></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <a href="fees_paid.php">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div></a>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                       
                                        <div class="col-xs-12 ">
                                            <div class="huge"><?php  
                                            $feesPaid="Select count(*) AS PAIDC from fees_payment where year=(Select c_year from year_master where Y_STATUS = 1)and P_status=0";
                                                //echo $feesPaid;
                                             echo  $con->query($feesPaid)->fetch_assoc()['PAIDC'];
                                            ?>
                                                
                                            </div>
                                            <div><b> Online Transaction</b></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                       
                                        <div class="col-xs-12 ">
                                            <div class="huge">  <?php
                                             $feesPaid="Select count(*) AS PAIDC from fees_payment where year=(Select c_year from year_master where Y_STATUS = 1)and P_status=1";
                                               // echo $feesPaid;
                                                echo $con->query($feesPaid)->fetch_assoc()['PAIDC'];
                                            ?></div>
                                            <div><b>Offline Transaction</b></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                       
                                        <div class="col-xs-12 ">
                                            <div class="huge"> &#8377;  <?php
                                             $feesPaid="Select sum(amount) AS PAIDC from fees_payment where year=(Select c_year from year_master where Y_STATUS = 1)";
                                               // echo $feesPaid;
                                                echo $con->query($feesPaid)->fetch_assoc()['PAIDC'];
                                            ?>/-</div>
                                            <div><b>Amount Received</b></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                       
                    </div>
    <!-- /.row (nested) -->
  </div>
               <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                           
                                <div class="panel-heading">
                                    <b style="color: red;">Search School Wise Students</b>

                                </div>

                                <div class="panel-body">
                                    <form method="post">
                                   <div class="row">
                                      <div class="col-lg-12" >
                        <select class="form-control" name="drpyear" style="float: right;">
                          <option selected>Select School</option>
                          <?php
                          $sql = "SELECT * FROM school_master";
                          $result = $con->query($sql);
                          while ($row = $result->fetch_assoc()) {
                       
                          $get_state="SELECT * FROM state_master where STATE_ID={$row['STATE_ID']}";
                          $state_name=$con->query($get_state)->fetch_assoc()['STATE_NAME'];
                          $state_code=$con->query($get_state)->fetch_assoc()['STATE_CODE'];
                          ?>

                          <option value="<?php
                          echo $row['TROOP_CODE']."-".$state_code;
                          ?>"
                          <?php
                          if(isset($_POST['drpyear']))
                            {
                            if($_POST['drpyear']==$row['TROOP_CODE']."-".$state_code)
                            {
                            echo "selected";
                            }
                            }
                          ?> 
                          ><?php echo $row['SC_NAME']."  ( ".$row['TROOP_CODE']." - ".$state_name." )"; ?></option>
                          <?php
                          }
                          ?>
                        </select>
                           
                      </div>
                      </div>

               
                                   </div>
                             <div class="row">
                                 <div class="col-lg-2" style="float: right;">
                                    <input type="submit" class="btn btn-primary" name="btnsearch">
                                 </div>
                                    </form>
                             </div>
                                    <!-- /.row (nested) -->
                                </div>

                                <!-- /.panel-body -->
                            </div>

                            <!-- /.panel -->
                        </div>
                        <?php
if(isset($_POST['btnsearch']))
{
   if($_POST['drpyear']!="Select School")
  {
    $sortkey=$_POST['drpyear'];
   // echo $_POST['drpyear'];
    ?>
     <div class="panel-body">
                 <div class="row">
                    <?php
                 
                  ?>
                        <div class="col-lg-2 col-md-2">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        
                                        <div class="col-xs-12 ">
                                            <div><b><?php $total_first="SELECT count(*) as tf FROM `enroll_master` WHERE SUBSTR(enrollment_id,4,8) = '{$sortkey}'  and c_year=(SELECT c_year from year_master where Y_STATUS=1 and  t_year=1 )"; 

                                            ?>

                    FIRST YEAR </b></div>
                    <div class="huge "><?php echo $con->query($total_first)->fetch_assoc()["tf"]; ?></div>
                                            
                                        </div>
                                    </div>
                                </div>
                               
                                    <div class="panel-footer">
                                       <a href="#">
                                        <span class="pull-left">  Amount :  &#8377; <?php
                                       // $s_id=$con->query($total_first)->fetch_assoc()["e_id"];

                                         $total_first_M="SELECT sum(amount) as tf FROM `fees_payment` WHERE e_id IN (SELECT e_id from enroll_master WHERE SUBSTR(enrollment_id,4,8) = '{$sortkey}' )and year=(SELECT c_year from year_master where Y_STATUS=1 ) and  fees_for_year=1";
                                        
                                       if($con->query($total_first_M)->fetch_assoc()["tf"]==NULL)
                                        {
                                            echo "0";
                                        }
                                        else
                                        {
                    echo $con->query($total_first_M)->fetch_assoc()["tf"];
                }
                    ?>/-
                  
                   </span>
                     <br>
                   <a href="?year=1&sc_id=<?php echo $sortkey; ?>" id='link1'><span>View Details</span></a>
                                       
                            
                                        <div class="clearfix"></div>
                                      </a>
                                    </div>
                                
                            </div>
                        </div>
                        
                      <?php

                    //  echo $total_first_M;;
                      ?>
                        <div class="col-lg-2 col-md-2">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                       
                                        <div class="col-xs-12">
                                           
                                            <div> <?php $total_first="SELECT count(*) as tf FROM `enroll_master` WHERE SUBSTR(enrollment_id,4,8) = '{$sortkey}'  and c_year=(SELECT c_year from year_master where Y_STATUS=1 and  t_year=2 )" ;?>
                    <b> SECOND YEAR </b><div class="huge" ><?php echo $con->query($total_first)->fetch_assoc()["tf"]; ?></div></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left"> Amount :  &#8377; <?php $total_first_M="SELECT sum(amount) as tf FROM `fees_payment` WHERE e_id IN (SELECT e_id from enroll_master WHERE SUBSTR(enrollment_id,4,8) = '{$sortkey}' )and year=(SELECT c_year from year_master where Y_STATUS=1 ) and  fees_for_year=2";
                                        if($con->query($total_first_M)->fetch_assoc()["tf"]==NULL)
                                        {
                                            echo "0";
                                        }
                                        else
                                        {
                    echo $con->query($total_first_M)->fetch_assoc()["tf"];
                }
                    ?>/-
               
                    </span>
                      <br>
                    <a href="?year=2&sc_id=<?php echo $sortkey; ?>" id='link2'><span>View Details</span></a>
                                       

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
                                           
                                            <div><?php $total_first="SELECT count(*) as tf FROM `enroll_master` WHERE SUBSTR(enrollment_id,4,8) = '{$sortkey}'  and c_year=(SELECT c_year from year_master where Y_STATUS=1 and  t_year=3 )";
                                             //   echo $total_first;
                                            ?>
                    <b>THIRD YEAR </b> <div class="huge"> <?php echo $con->query($total_first)->fetch_assoc()["tf"]; ?></div></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left"> Amount :  &#8377; <?php $total_first_M="SELECT sum(amount) as tf FROM `fees_payment` WHERE e_id IN (SELECT e_id from enroll_master WHERE SUBSTR(enrollment_id,4,8) = '{$sortkey}' )and year=(SELECT c_year from year_master where Y_STATUS=1 ) and  fees_for_year=3";
                                        if($con->query($total_first_M)->fetch_assoc()["tf"]==NULL)
                                        {
                                            echo "0";
                                        }
                                        else
                                        {
                    echo $con->query($total_first_M)->fetch_assoc()["tf"];
                }
                    ?>/-
                    
                    </span>
                    <br>
                    <a href="?year=3&sc_id=<?php echo $sortkey; ?>" id='link3' ><span>View Details</span></a>
                                       

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
                                           
                                            <div> <?php $total_first="SELECT count(*) as tf FROM `enroll_master` WHERE SUBSTR(enrollment_id,4,8) = '{$sortkey}'  and c_year=(SELECT c_year from year_master where Y_STATUS=1 and  t_year=4 )";?>
                    <b> FORTH YEAR </b><div class="huge"> <?php echo $con->query($total_first)->fetch_assoc()["tf"]; ?> </div></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left"> Amount :  &#8377; <?php $total_first_M="SELECT sum(amount) as tf FROM `fees_payment` WHERE e_id IN (SELECT e_id from enroll_master WHERE SUBSTR(enrollment_id,4,8) = '{$sortkey}' )and year=(SELECT c_year from year_master where Y_STATUS=1 ) and  fees_for_year=4";
                                        if($con->query($total_first_M)->fetch_assoc()["tf"]==NULL)
                                        {
                                            echo "0";
                                        }
                                        else
                                        {
                    echo $con->query($total_first_M)->fetch_assoc()["tf"];
                }
                    ?>/-
                
                    </span>
                    <br>
                    <a href="?year=4&sc_id=<?php echo $sortkey; ?>" id='link4'><span>View Details</span></a>
                                       

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
                                           
                                            <div> <?php $total_first="SELECT count(*) as tf FROM `enroll_master` WHERE SUBSTR(enrollment_id,4,8) = '{$sortkey}'  and c_year=(SELECT c_year from year_master where Y_STATUS=1 and  t_year=1 )";?>
                    <b>FIFTH YEAR </b><div class="huge"> <?php echo $con->query($total_first)->fetch_assoc()["tf"]; ?></div></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left"> Amount :  &#8377; <?php $total_first_M="SELECT sum(amount) as tf FROM `fees_payment` WHERE e_id IN (SELECT e_id from enroll_master WHERE SUBSTR(enrollment_id,4,8) = '{$sortkey}' )and year=(SELECT c_year from year_master where Y_STATUS=1 ) and  fees_for_year=5";
                                        if($con->query($total_first_M)->fetch_assoc()["tf"]==NULL)
                                        {
                                            echo "0";
                                        }
                                        else
                                        {
                    echo $con->query($total_first_M)->fetch_assoc()["tf"];
                }
                    ?>/-
                    

                    </span>
                    <br>
                    <a href="?year=5&sc_id=<?php echo $sortkey; ?>" id='link5'><span>View Details</span></a>
                                       

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
                    $total="SELECT count(*) as tf FROM `enroll_master` WHERE SUBSTR(enrollment_id,4,8) = '{$sortkey}'  and c_year=(SELECT c_year from year_master where Y_STATUS=1  )";
                    //echo $total;
                    ?>
                    <b> TOTAL COUNT </b><div class="huge"><?php echo $con->query($total)->fetch_assoc()["tf"]; ?>
                    </div></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-left">Amount : &#8377;<?php $total_first_M="SELECT sum(amount) as tf FROM `fees_payment` WHERE e_id IN (SELECT e_id from enroll_master WHERE SUBSTR(enrollment_id,4,8) = '{$sortkey}' )and year=(SELECT c_year from year_master where Y_STATUS=1 ) ";
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
                  <a href="?year=0&sc_id=<?php echo $sortkey; ?>"><span>View Details</span></a>
                                       

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        
                        
                    </div>
                
              </div>
    <!-- /.row (nested) -->
  
  <?php
  if(isset($_GET['year']) && isset($_GET['sc_id']))
  {
    $sortkey=$_GET['sc_id'];
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
                                                         $sql = "SELECT * FROM `fees_payment` WHERE e_id IN (SELECT e_id from enroll_master WHERE SUBSTR(enrollment_id,4,8) = '{$sortkey}' )and year=(SELECT c_year from year_master where Y_STATUS=1 )";
                                                    }
                                                    else
                                                    {

                              $sql = "SELECT * FROM `fees_payment` WHERE e_id IN (SELECT e_id from enroll_master WHERE SUBSTR(enrollment_id,4,8) = '{$sortkey}' )and year=(SELECT c_year from year_master where Y_STATUS=1 ) and  fees_for_year={$_GET['year']}";
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
    <?php
 }
}

?>

  </div><!-- /.panel-body -->
</div>

                        <!-- /.col-lg-12 -->
                    </div>


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