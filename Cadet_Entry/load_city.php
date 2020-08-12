 <?php
 include '../connection.php';
if(isset($_POST["get_option"]))
{
    echo "<script>alert('cd');</script>";
    $city=$con->query("select * from city_master where state_id=".$_POST['get_option']." order by city_name ASC");
    $rowCountcity=$city->num_rows;
    if($rowCountcity > 0)
    {
        echo '<option value="">Select City</option>';
        while($row=$city->fetch_assoc())
        {
            echo '<option value="'.$row["Sr_no"].'">'.$row["city_name"].'</option>';
        }
    }
    else{
        echo '<option value="">City not available</option>';
    }
}
?>
