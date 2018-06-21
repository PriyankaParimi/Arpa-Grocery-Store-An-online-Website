<?php
session_start();
include 'db.php';
/*if(!isset($_SESSION["name"])){
	header("location:index.php");
}*/?>

<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 80%;
    border-collapse: collapse;
}

th{
	text-align: center;
}

tr{
	text-align: center;
}
</style>
</head>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>ARPA Grocery Store</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<script src="js/jquery2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="main.js"></script>
	</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">	
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
					<span class="sr-only">navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="#" class="navbar-brand">ARPA Grocery Store</a>
			</div>
		<div class="collapse navbar-collapse" id="collapse">
			<ul class="nav navbar-nav">
				<li><a href="profile.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
				<li><a href="profile.php"><span class="glyphicon glyphicon-modal-window"></span>Product</a></li>
				<li style="width:300px;left:10px;top:10px;"><input type="text" class="form-control" id="search"></li>
				<li style="top:10px;left:20px;"><button class="btn btn-primary" id="search_btn">Search</button></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#" id="cart_container" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart"></span>Cart<span class="badge">0</span></a>
					<div class="dropdown-menu" style="width:400px;">
						<div class="panel panel-success">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-3 col-xs-3">Sl.No</div>
									<div class="col-md-3 col-xs-3">Product Image</div>
									<div class="col-md-3 col-xs-3">Product Name</div>
									<div class="col-md-3 col-xs-3">Price in $.</div>
								</div>
							</div>
							<div class="panel-body">
								<div id="cart_product">
								<!--<div class="row">
									<div class="col-md-3">Sl.No</div>
									<div class="col-md-3">Product Image</div>
									<div class="col-md-3">Product Name</div>
									<div class="col-md-3">Price in $.</div>
								</div>-->
								</div>
							</div>
							<div class="panel-footer"></div>
						</div>
					</div>
				</li>
				<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><?php echo "Hi,".$_SESSION['name']; ?></a>
					<ul class="dropdown-menu">
						<li><a href="cart.php" style="text-decoration:none; color:blue;"><span class="glyphicon glyphicon-shopping-cart">Cart</a></li>
					    <li><?php echo '<a href="orderhistory.php?name='.$_SESSION['name'].'" style="text-decoration:none; color:blue;">Order History</a>'; ?></li>
						<li class="divider"></li></li>
						<li><a href="logout.php" style="text-decoration:none; color:blue;">Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	</div>
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-primary">
					<div class="panel-heading">Order History</div>
					<div class="panel-body">
<?php
 $username=$_GET['name'];
 $sql1 = "SELECT order_items.order_id,orders.order_date,order_items.flag,order_items.product_id,products.product_title,order_items.product_quantity,order_items.product_price,order_items.product_price FROM orders,order_items,products where products.product_id=order_items.product_id and orders.order_id=order_items.order_id and username ='$username'";
 $run_query1 = mysqli_query($con,$sql1);
 echo "<table>
  <tr>
  <th>Order_id</th>
  <th>order_date</th>
  <th>Product Name</th>
  <th>Quantity</th>
  <th>Product Price</th>
  <th>Total_Price</th>
  </tr>";
   if(mysqli_num_rows($run_query1) > 0)
  {	 
   while($row=mysqli_fetch_array($run_query1)){
		    
			if($row['flag']==1)
                        {
                        echo "<tr>";
			echo "<td>".$row['order_id']."</td>";
            echo "<td>".$row['order_date']."</td>"; 			
			echo "<td>".$row['product_title']."</td>";
			echo "<td>".$row['product_quantity']."</td>";
			echo "<td>".$row['product_price']."</td>";
			echo "<td>".$total = ($row['product_price']*$row['product_quantity'])."</td>";
			echo "</tr>";
                        }
                        else
                        {
                        echo "<tr>";
			echo "<td>".$row['order_id']."</td>";
            echo "<td>".$row['order_date']."</td>"; 			
			echo "<td style='color:red'>".$row['product_title']."----(Item Not available)----</td>";
			echo "<td>".$row['product_quantity']."</td>";
			echo "<td>".$row['product_price']."</td>";
			echo "<td>".$total = ($row['product_price']*$row['product_quantity'])."</td>";
			echo "</tr>";
                        }
 }
 }
 echo "</table>";

?>
</body>
</html>
