 <?php
 include '../connection.php';
if(isset($_POST["get_city"]))
{
    $city=$con->query("select * from school_master where C_ID=".$_POST['get_city']."");
    $rowCountcity=$city->num_rows;
    if($rowCountcity > 0)
    {
        echo '<option value="">Select School</option>';
        while($row=$city->fetch_assoc())
        {
            echo '<option value="'.$row["TROOP_CODE"].'">'.$row["TROOP_CODE"].' - '. $row["SC_NAME"] .'</option>';
        }
    }
    else{
        echo '<option value="">City not available</option>';
    }
}
?>
