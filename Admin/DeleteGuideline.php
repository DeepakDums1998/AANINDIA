<?php
  include "../connection.php";
  if(isset($_GET['gid']))
  {
    
  	$sql = "UPDATE tbl_guidelines SET Status=1 where g_id=".$_GET['gid']."";
  //  echo $sql;
  // echo $con->query($sql);
  if($con->query($sql) == TRUE)
  {
   header("Location:Guidelines.php");
  }
  
  }
?>