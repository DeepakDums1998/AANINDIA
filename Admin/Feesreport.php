<?php
require_once("../header.php");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript">
    function senddata(y,s)
    {
      
        $.ajax({  
            type: 'POST',  
            url: 'ajaxgetfeesdata.php', 
            data: { year:y,sc_id:s },
            success: function(response) {
                $("#table").empty();
                $("#table").append(response);  
            }
        });
       
    }
    $(document).ready(function(){
   var val= $("#drpsc_id option:selected" ).val();
    
  $("#link1").click(function(){
  
    senddata(1,val);
    
  });
  $("#link2").click(function(){
    senddata(2,val);
  });
  $("#link3").click(function(){
    senddata(3,val);
  });
  $("#link4").click(function(){
    senddata(4,val);
  });
  $("#link5").click(function(){
    senddata(5,val);
  });
  $("#link0").click(function(){
    senddata(0,val);
  });
});
       
    
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
                        <select class="form-control" name="drpyear" id="drpsc_id" style="float: right;">
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
                   <span id='link1'><span>View Details</span></span></a>
                                       
                            
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
                    <span id='link2'><span>View Details</span></span></a>
                                       

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
                    <span id='link3' ><span>View Details</span></span></a>
                                       

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
                    <span id='link4'><span>View Details</span></span></a>
                                       

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
                    <span id='link5'><span>View Details</span></span> </a>
                                       

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
                  <span id='link0'><span>View Details</span></span></a>
                                       

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        
                        
                    </div>
                
              </div>
    <!-- /.row (nested) -->
   <div class="row" id="table">
   </div>
  
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