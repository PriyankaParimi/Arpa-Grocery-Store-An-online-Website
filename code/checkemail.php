<?php
require "db.php";
$email=mysqli_real_escape_string($con,$_GET['email']);
$check_email="SELECT * from users where email='$email'";
$result=mysqli_query($con,$check_email);
if(mysqli_num_rows($result)>0)
{
echo "<span class='text-danger'>Email already exists</span>";
}
?>