<?php
$conn=mysqli_connect("localhost","root","","project");
if(!$conn){
    echo "<script>alert('Cannot connect to the database');</script>";
    exit;
}
?>