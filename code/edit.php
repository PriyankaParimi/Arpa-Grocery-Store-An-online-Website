<?php
session_start();
?>
<DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ARPA GROCERY STORE</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="loginvalidate1.js"></script>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
<div class="container-fluid">
<div class="navbar-header">
<a href="#" class="navbar-brand">ARPA GROCERY STORE</a>
</div>
<ul class="nav navbar-nav">
<li><a href="adminfinal.php"><span class="glyphicon glyphicon-home"></span>HOME</a></li>
<li><a href="adminfinal.php"><span class="glyphicon glyphicon-modal-window"></span>Product</a></li>

</ul>
<ul class="nav navbar-nav navbar-right">

<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><?php echo $_SESSION['name']; ?></a>
    <ul class="dropdown-menu">
       <li><a href=""></a>Logout</li> 
    </ul>
</li>

</ul>
</div>
</div>
<p><br/></p>
<p><br/></p>
<p><br/></p>
<?php
$id=$_GET['id'];
$conn=mysqli_connect("localhost","root","root","grocery1");
	 if(!conn)
      {
         echo "Failed to connect".mysqli_connect_err();
      }
     else
      {
        $title="";
        $price="";
        $query="SELECT products.product_title,products.product_price,brands.brand_title,products.product_quantity,categories.cat_title,categories.cat_id,brands.brand_id FROM products INNER JOIN (brands,categories) ON brands.brand_id=products.product_brand AND categories.cat_id=products.product_cat WHERE products.product_id='$id'";
        $result=mysqli_query($conn,$query);
        if(mysqli_num_rows($result)!=0)
        {
             while($row=mysqli_fetch_array($result))
	     {
                $title=$row['product_title'];
                $price=$row['product_price'];
                $category=$row['cat_title'];
                $brand=$row['brand_title'];
                $categoryid=$row['cat_id'];
                $brandid=$row['brand_id'];
			    $quantity=$row['product_quantity'];
             }
        }
        else
        {
          $productlist="No items are available";
        }
      }
?>
<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-2 sidenav">
    </div>
    <div class="col-sm-8 text-left">
	<h2> Update Product Details</h2>
     <form action="update.php" method="post" class="form-horizontal" enctype="multipart/form-data">
      <div class="form-group">
      <label class="control-label col-sm-3" for="id">Product Id:</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="id" value="<?php echo $id; ?>" readonly="readonly">
      </div>
	  </div>
	  <div class="form-group">
      <label class="control-label col-sm-3" for="title">Product Title:</label>
      <div class="col-sm-9">
      <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>">
      </div>
	  </div>
	  
	  <div class="form-group">
      <label class="control-label col-sm-3" for="price">Product Price:</label>
      <div class="col-sm-9">
      <input type="text" class="form-control" id="price" name="price" value="<?php echo $price; ?>">
      </div>
	  </div>
	  <div class="form-group">
      <label class="control-label col-sm-3" for="price">Product Category:</label>
      <div class="col-sm-9">
      <select class="form-control" name="category" id="product_category_id">
	  <option><? echo $categoryid ?></option>
    <?php
	$conn=mysqli_connect("localhost","root","root","grocery1");
	$query1="select * from categories";
	$result=mysqli_query($conn,$query1);
	while($row = mysqli_fetch_array($result))
	{
	echo "<option>".$row["cat_id"]."-".$row["cat_title"]."</option>";
	}
	?>
     </select>
      </div>
	  </div>
	  <div class="form-group">
      <label class="control-label col-sm-3" for="price">Product Brand:</label>
      <div class="col-sm-9">
      <select class="form-control" name="brand" id="brand">
	  <option><? echo $brandid ?></option>
      <?php
	$conn=mysqli_connect("localhost","root","root","grocery1");
	$query1="select * from brands";
	$result=mysqli_query($conn,$query1);
	while($row = mysqli_fetch_array($result))
	{
	echo "<option>".$row["brand_id"]."-".$row["brand_title"]."</option>";
	}
	?>
    </select>
    </div>
	</div>
	  <div class="form-group">
      <label class="control-label col-sm-3" for="quantity">Product quantity:</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="quantity" id="quantity" value="<?php echo $quantity; ?>">
      </div>
	  </div>
	  <div class="form-group">
      <label class="control-label col-sm-3" for="image">Product image:</label>
      <div class="col-sm-9">
        <input type="file" name="fileToUpload" id="fileToUpload">
      </div>
	  </div>
	  <div class="form-group">
      <div class="col-sm-offset-3 col-sm-9">
        <input type="Submit" value="Submit">
      </div>
    </div>

</form>
</div>
    <div class="col-sm-2 sidenav">
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
</footer>

</body>
</html>