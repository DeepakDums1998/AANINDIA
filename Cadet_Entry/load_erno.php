 <?php
 include '../connection.php';
if(isset($_POST["get_option"]))
{
   // echo $_POST["get_option"];
    $data=$_POST['get_option'];
    $state=$con->query("select state_master.state_code As state
FROM school_master,state_master WHERE school_master.state_id = state_master.Sr_no and school_master.troop_code=$data AND state_master.status=1");
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
