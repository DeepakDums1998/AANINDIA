 <?php
 include '../connection.php';
if(isset($_POST["get_option"]))
{
   // echo $_POST["get_option"];
    $data=$_POST['get_option'];
    $state=$con->query("select state_master.STATE_CODE As state
FROM school_master,state_master WHERE school_master.STATE_ID = state_master.STATE_ID and school_master.TROOP_CODE=$data AND state_master.STATE_STATUS=1");
    $rowCountcity=$state->num_rows;
    if($rowCountcity > 0)
    {
        while($row=$state->fetch_assoc())
        {
            //$cadet_no=substr($row["enrollment_id"],10)+1;
            echo $row['state']."_";
        }
    }
}
?>
