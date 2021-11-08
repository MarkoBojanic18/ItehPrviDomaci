<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "login_register";

//die je isto kao exit();
$conn = mysqli_connect($hostname,$username,$password,$database) or die("Database connection failed");

?>