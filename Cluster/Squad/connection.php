<?php 

$con = new mysqli("localhost", "root", "sro2002", "2_3_year");
        if (isset($con->connect_error)) {
            die("connection faild...." . $con->connect_error);
        }
?>

