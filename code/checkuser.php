<?php
require "db.php";
$username=mysqli_real_escape_string($con,$_GET['username']);
$check_user="SELECT * from users where username='$username'";
$result=mysqli_query($con,$check_user);
if(mysqli_num_rows($result)>0)
{
echo "<span class='text-danger'>Username already exists</span>";
}
else
{
echo "<span class='text-success'>Username is available</span>";
}
?>