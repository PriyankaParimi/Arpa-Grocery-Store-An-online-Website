<?php
require "db.php";
$FirstName=mysqli_real_escape_string($con,$_GET['firstname']);
$LastName=mysqli_real_escape_string($con,$_GET['lastname']);
$username=mysqli_real_escape_string($con,$_GET['username']);
$password=mysqli_real_escape_string($con,$_GET['password']);
$email=mysqli_real_escape_string($con,$_GET['email']);
$salt="yughkjhbgvbhj";
$password1 =md5($password.$salt);
$query= "INSERT INTO users(username,first_name,last_name,email,password) VALUES('$username','$FirstName','$LastName','$email','$password1')";
$results=mysqli_query($con,$query);
echo "Registered successfully";
?>