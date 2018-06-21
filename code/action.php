<?php
session_start();
include "db.php";
if(isset($_POST["category"])){
	$category_query = "SELECT * FROM categories";
	$run_query = mysqli_query($con,$category_query) or die(mysqli_error($con));
	echo "
		<div class='nav nav-pills nav-stacked'>
			<li class='active'><a href='#'><h4>Categories</h4></a></li>
	";
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$cid = $row["cat_id"];
			$cat_name = $row["cat_title"];
			echo "
					<li><a href='#' class='category' cid='$cid'>$cat_name</a></li>
			";
		}
		echo "</div>";
	}
}
if(isset($_POST["brand"])){
	$brand_query = "SELECT * FROM brands";
	$run_query = mysqli_query($con,$brand_query);
	echo "
		<div class='nav nav-pills nav-stacked'>
			<li class='active'><a href='#'><h4>Brands</h4></a></li>
	";
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$bid = $row["brand_id"];
			$brand_name = $row["brand_title"];
			echo "
					<li><a href='#' class='selectBrand' bid='$bid'>$brand_name</a></li>
			";
		}
		echo "</div>";
	}
}
if(isset($_POST["page"])){
	$sql = "SELECT * FROM products";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	$pageno = ceil($count/9);
	for($i=1;$i<=$pageno;$i++){
		echo "
			<li><a href='#' page='$i' id='page'>$i</a></li>
		";
	}
}
if(isset($_POST["getProduct"])){
	$limit = 9;
	if(isset($_POST["setPage"])){
		$pageno = $_POST["pageNumber"];
		$start = ($pageno * $limit) - $limit;
	}else{
		$start = 0;
	}
	$product_query = "SELECT * FROM products where product_flag=1 LIMIT $start,$limit";
	$run_query = mysqli_query($con,$product_query);
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$pro_id    = $row['product_id'];
			$pro_cat   = $row['product_cat'];
			$pro_brand = $row['product_brand'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_image = $row['product_img'];
			echo "
				<div class='col-md-4'>
							<div class='panel panel-info'>
								<div class='panel-heading'>$pro_title</div>
								<div class='panel-body'>
									<img src='product_images/$pro_image' style='width:160px; height:250px;'/>
								</div>
								<div class='panel-heading'>$.$pro_price.00";
									echo '<a style="float:right" href="updatecart.php?id='.$row['product_id'].'">Add to cart</a>';
					echo "	</div>
							</div>
						</div>	
			";
		}
	}
}
if(isset($_POST["get_seleted_Category"]) || isset($_POST["selectBrand"]) || isset($_POST["search"])){
	if(isset($_POST["get_seleted_Category"])){
		$id = $_POST["cat_id"];
		$sql = "SELECT * FROM products WHERE product_cat = '$id' AND product_flag=1";
	}else if(isset($_POST["selectBrand"])){
		$id = $_POST["brand_id"];
		$sql = "SELECT * FROM products WHERE product_brand = '$id' AND product_flag=1";
	}else {
		$keyword = $_POST["keyword"];
		$sql = "SELECT * FROM products WHERE product_flag=1 AND product_keywords LIKE '%$keyword%'";
	}
	
	$run_query = mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($run_query)){
			$pro_id    = $row['product_id'];
			$pro_cat   = $row['product_cat'];
			$pro_brand = $row['product_brand'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_image = $row['product_img'];
			echo "
				<div class='col-md-4'>
							<div class='panel panel-info'>
								<div class='panel-heading'>$pro_title</div>
								<div class='panel-body'>
									<img src='product_images/$pro_image' style='width:160px; height:250px;'/>
								</div>
								<div class='panel-heading'>$.$pro_price.00";
									echo '<a style="float:right" href="updatecart.php?id='.$row['product_id'].'">Add to Cart</a>';
			echo "				</div>
							</div>
						</div>	
			";
		}
	}
									
if(isset($_POST["get_cart_product"]) || isset($_POST["cart_checkout"])){
	$uid = $_SESSION["name"];
	$sql = "SELECT * FROM cart WHERE username = '$uid'";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	if($count > 0){
		$no = 1;
		$total_amount = 0;
		while($row=mysqli_fetch_array($run_query)){
			$id = $row["id"];
			$pro_id = $row["product_id"];
			$pro_name = $row["product_title"];
			$pro_image = $row["product_image"];
			$qty = $row["quantity"];
			$pro_price = $row["price"];
			$total = $row["total_amount"];
			$price_array = array($total);
			$total_sum = array_sum($price_array);
			$total_amount = $total_amount + $total_sum;
			
			if(isset($_POST["get_cart_product"])){
				echo "
				<div class='row'>
					<div class='col-md-3 col-xs-3'>$no</div>
					<div class='col-md-3 col-xs-3'><img src='product_images/$pro_image' width='60px' height='50px'></div>
					<div class='col-md-3 col-xs-3'>$pro_name</div>
					<div class='col-md-3 col-xs-3'>$.$pro_price.00</div>
				</div>
			";
			$no = $no + 1;
			}else{
				echo "
					<div class='row'>
							<div class='col-md-2 col-sm-2'>
								<div class='btn-group'>
									<a href='#' remove_id='$pro_id' class='btn btn-danger btn-xs remove'><span class='glyphicon glyphicon-trash'></span></a>
									<a href='' update_id='$pro_id' class='btn btn-primary btn-xs update'><span class='glyphicon glyphicon-ok-sign'></span></a>
								</div>
							</div>
							<div class='col-md-2 col-sm-2'><img src='product_images/$pro_image' width='50px' height='60'></div>
							<div class='col-md-2 col-sm-2'>$pro_name</div>
							<div class='col-md-2 col-sm-2'><input type='text' class='form-control qty' pid='$pro_id' id='qty-$pro_id' value='$qty' name='$qty'></div>
							<div class='col-md-2 col-sm-2'><input type='text' class='form-control price' pid='$pro_id' id='price-$pro_id' value='$pro_price' name='$price' disabled></div>
							<div class='col-md-2 col-sm-2'><input type='text' class='form-control total' pid='$pro_id' id='total-$pro_id' value='$total_amount' name='$total_amount' disabled></div>
						</div>
				";
			}
				
		}
		if(isset($_POST["cart_checkout"])){
			echo "<div class='row'>
				<div class='col-md-8'></div>
				<div class='col-md-4'>
					<h1>Total:";
			echo $total_amount;	
			echo '<a style="float:right" href="checkout.php?name='.$_SESSION['name'].'">Check out</a>';
			echo "</h1>
				</div>";
		}
		
	}
}

if(isset($_POST["cart_count"]) AND isset($_SESSION["name"])){
	$uid = $_SESSION["name"];
	$sql = "SELECT * FROM cart WHERE username = '$uid'";
	$run_query = mysqli_query($con,$sql);
	echo mysqli_num_rows($run_query);
}
if(isset($_POST["removeFromCart"])){
	$pid = $_POST["removeId"];
	$uid = $_SESSION["name"];
	$sql = "DELETE FROM cart WHERE username = '$uid' AND product_id = '$pid'";
	$run_query = mysqli_query($con,$sql);
	if($run_query){
		echo "
			<div class='alert alert-danger'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Product is Removed from Cart...!!</b>
			</div>
		";
	}
}

if(isset($_POST["updateProduct"])){
	$uid = $_SESSION["name"];
	$pid = $_POST["updateId"];
	$qty = $_POST["qty"];
	$price = $_POST["price"];
	$total = $_POST["total"];
	
	$sql = "UPDATE cart SET quantity = '$qty',price='$price',total_amount='$total' WHERE username = '$uid' AND product_id='$pid'";
	$run_query = mysqli_query($con,$sql);
	if($run_query){
		echo "
			<div class='alert alert-success'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Product is Updated Continue Shopping..!</b>
			</div>
		";
	}
}
?>






























