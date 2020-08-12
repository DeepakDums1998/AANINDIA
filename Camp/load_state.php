 <?php
 include '../connection.php';
if(isset($_POST["get_option"]))
{
    $state=$con->query("select * from state_master");
    $rowCountstate =$state->num_rows;
    if($rowCountstate > 0)
    {
        echo '<option value="">Select state</option>';
        while($row=$state->fetch_assoc())
        {
            echo '<option value="'.$row["STATE_ID"].'">'.$row["STATE_CODE"].'</option>';
        }
    }
    else{
        echo '<option value="">state not available</option>';
    }
}
?>
