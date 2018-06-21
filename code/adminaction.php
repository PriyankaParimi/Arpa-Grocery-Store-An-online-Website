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

if(isset($_POST["getProduct"])){
	$limit = 16;
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
			    echo '<a style="float:right" href="delete.php?id='.$row['product_id'].'">Delete</a>';
				echo '<a style="float:right; margin-right:5px;" href="edit.php?id='.$row['product_id'].'">Edit</a>';                				
				echo	"			</div>
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
									echo '<a style="float:right" href="delete.php?id='.$row['product_id'].'">Delete</a>';
				echo '<a style="float:right; margin-right:5px;" href="edit.php?id='.$row['product_id'].'">Edit</a>';     
		    echo "						</div>
							</div>
						</div>	
			";
		}
	}
									
	if(isset($_POST["addToProduct"])){
		$p_id = $_POST["proId"];
		$user_id = $_SESSION["uid"];
		$sql = "SELECT * FROM cart WHERE product_id = '$p_id' AND user_id = '$user_id'";
		$run_query = mysqli_query($con,$sql);
		$count = mysqli_num_rows($run_query);
		if($count > 0){
			echo "
				<div class='alert alert-warning'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Product is already added into the cart Continue Shopping..!</b>
				</div>
			";
		} else {
			$sql = "SELECT * FROM products WHERE product_id = '$p_id'";
			$run_query = mysqli_query($con,$sql);
			$row = mysqli_fetch_array($run_query);
				$id = $row["product_id"];
				$pro_name = $row["product_title"];
				$pro_image = $row["product_image"];
				$pro_price = $row["product_price"];
			$sql = "INSERT INTO `grocery_store`.`cart` 
			(`id`, `product_id`, `ip-address`, `user_id`, 
			`product_title`, `product_image`, `quantity`, `price`, 
			`total_amount`) VALUES ('102', '$p_id', '0', '$user_id', 
			'$pro_name', '$pro_image', '1', '$pro_price', '$pro_price');";
			if(mysqli_query($con,$sql)){
				echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Product is Added..!</b>
					</div>
				";
			}
		}
		
		
		
	}
if(isset($_POST["get_cart_product"])){
	$uid = $_SESSION["uid"];
	$sql = "SELECT * FROM cart WHERE user_id = '$uid'";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	if($count > 0){
		$no = 1;
		while($row=mysqli_fetch_array($run_query)){
			$id = $row["id"];
			$pro_id = $row["p_id"];
			$pro_name = $row["product_title"];
			$pro_image = $row["product_image"];
			$pro_price = $row["price"];
			echo "
			<div class='row'>
									<div class='col-md-3'>$no</div>
									<div class='col-md-3'><img src='product_images/$pro_image' width='60px' height='50px'></div>
									<div class='col-md-3'>$pro_name</div>
									<div class='col-md-3'>$.$pro_price.00</div>
								</div>
			";
			$no = $no + 1;
		}
	}
}
?>






























