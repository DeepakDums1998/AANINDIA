 <?php
 include '../connection.php';
if(isset($_POST["get_option"]))
{
    $city=$con->query("select * from year_master order by Y_CODE");
    $rowCountcity =$city->num_rows;
    if($rowCountcity > 0)
    {
        if($_POST["data"] == 1)
        {
            echo '<option value="0">All Year</option>';
        }
        else
        {
            echo '<option value="">select year</option>';
        }
        while($row=$city->fetch_assoc())
        {
            echo '<option value="'.substr($row["Y_CODE"], 2).'">'.substr($row["Y_CODE"], 2).'</option>';
        }
    }
    else{
        echo '<option value="">city not available</option>';
    }
}
?>
