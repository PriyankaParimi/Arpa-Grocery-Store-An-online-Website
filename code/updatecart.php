<?
session_start();
$servername = "localhost";
$username = "root";
$password = "root";
$db = "grocery1";

// Create connection
$con = mysqli_connect($servername, $username, $password,$db);
$id=$_GET['id'];
$user_id=$_SESSION['name'];
$sql = "Select * from products where product_id = '$id'";
$run_query = mysqli_query($con,$sql);
while($row=mysqli_fetch_array($run_query)){
		$id = $row["product_id"];
				$pro_name = $row["product_title"];
				$pro_image = $row["product_img"];
				$pro_price = $row["product_price"];
			
}
$sql1 = "INSERT INTO cart(`product_id`, `ip-address`, `username`, `product_title`,`product_image`, `quantity`, `price`, `total_amount`) VALUES ('$id', '0', '$user_id', '$pro_name', '$pro_image', '1', '$pro_price', '$pro_price')";
$result=mysqli_query($con,$sql1);
header("location:profile.php");

?>