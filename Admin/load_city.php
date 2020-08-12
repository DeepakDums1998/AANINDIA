 <?php
 include '../connection.php';
if(isset($_POST["get_option"]))
{
    $city=$con->query("select * from city_master where STATE_ID=".$_POST['get_option']." order by CITY_NAME ASC");
    $rowCountcity=$city->num_rows;
    if($rowCountcity > 0)
    {
        echo '<option value="">Select City</option>';
        while($row=$city->fetch_assoc())
        {
            echo '<option value="'.$row["C_ID"].'">'.$row["CITY_NAME"].'</option>';
        }
    }
    else{
        echo '<option value="">City not available</option>';
    }
}
?>
