<?php

$servername = "localhost";
$username = "root";
$password = "root";
$db = "grocery1";

// Create connection
$con = mysqli_connect($servername, $username, $password,$db);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


?>