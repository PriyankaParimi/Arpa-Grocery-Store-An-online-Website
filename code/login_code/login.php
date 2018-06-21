<?php
session_start();
function test_input($data)
{
  $data=trim($data);
  $data=stripslashes($data);
  $data=htmlspecialchars($data);
  return $data;
}
$username=$password="";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
  if(empty($_POST["password"]) || empty($_POST["username"]))
   {
	 $emailErr="password is missing";   
     header("location:index.php");
     exit();
    }
   else
   {
     $username=test_input($_POST['username']);
     $password=test_input($_POST['password']);
	 $salt="yughkjhbgvbhj";
     $password=md5($password.$salt);
	 $conn=mysqli_connect("localhost","root","root","Project");
	 if(!conn)
      {
         echo "Failed to connect".mysqli_connect_err();
      }
     else
      {
         $query="SELECT * FROM users WHERE username='$username' AND password='$password'";
         $result=mysqli_query($conn,$query);
         if(mysqli_num_rows($result)!=0)
	 {
           $userData=mysqli_fetch_assoc($result);
           $_SESSION['name']=$userData["FirstName"];
           session_write_close();
            echo "Login successful";
	 }
	 else
	 {
		 echo "Login unsuccessful";
	 }
   }
}
}
?>