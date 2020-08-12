<?php
require_once("../connection.php");

    
  if(isset($_POST['year']) && isset($_POST['sc_id']))
  {
    $sortkey=$_POST['sc_id'];
 //   echo $sortkey." ".$_POST['year'];
    ?>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <b style="color: red;">FEES DETAILS</b>
                                </div>
                                
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
                                    if($_POST['year']==0)
                                                    {
                                                         $sql = "SELECT * FROM `fees_payment` WHERE e_id IN (SELECT e_id from enroll_master WHERE SUBSTR(enrollment_id,4,8) = '{$sortkey}' )and year=(SELECT c_year from year_master where Y_STATUS=1 )";
                                                    }
                                                    else
                                                    {
     
                              $sql = "SELECT * FROM `fees_payment` WHERE e_id IN (SELECT e_id from enroll_master WHERE SUBSTR(enrollment_id,4,8) = '{$sortkey}' )and year=(SELECT c_year from year_master where Y_STATUS=1 ) and  fees_for_year={$_POST['year']}";
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
                                
                            </div>
                           
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
                     
                   
    <?php
  }
  ?>
  