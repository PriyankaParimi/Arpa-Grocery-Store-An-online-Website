<?php
   $conn=mysqli_connect("localhost","root","root","grocery1");
	 if(!conn)
      {
         echo "Failed to connect".mysqli_connect_err();
      }
     else
      {
   $id=$_GET['id'];
   $query="Update products set product_flag=0 where product_id='$id'";
   $result=mysqli_query($conn,$query);
   $query1="Update order_items set flag=0 where product_id='$id'";
   $result1=mysqli_query($conn,$query1);
   header("location:adminfinal.php");
      }

?>