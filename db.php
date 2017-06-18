<?php
$con=mysqli_connect("username","root","password","database");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
?>