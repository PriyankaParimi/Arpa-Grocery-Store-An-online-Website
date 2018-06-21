<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ARPA GROCERY STORE</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="loginvalidate1.js"></script>
<style>
h2{
	color:black;
}
</style>
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
	  <li class="divider"></li>
       <li><a href="logout.php" style="text-decoration:none; color:blue;">Logout</a></li>
    </ul>
</li>

</ul>
</div>
</div>
<p><br/></p>
<p><br/></p>
<p><br/></p>
<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-2 sidenav">
    </div>
    <div class="col-sm-8 text-left">
	<h2> Add Product</h2>
     <form action="additems.php" method="post" class="form-horizontal" enctype="multipart/form-data">
      <div class="form-group">
      <label class="control-label col-sm-3" for="title">Product Title:</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
      </div>
	  </div>
	  <div class="form-group">
      <label class="control-label col-sm-3" for="price">Product Price:</label>
      <div class="col-sm-9">
      <input type="text" class="form-control" id="price" name="price" placeholder="Enter price">
      </div>
	  </div>
	  <div class="form-group">
      <label class="control-label col-sm-3" for="price">Product Category:</label>
      <div class="col-sm-9">
      <select class="form-control" name="category" id="product_category_id">
	  <option>category</option>
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
	  <option>brands</option>
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
      <label class="control-label col-sm-3" for="product_search_keywords">Product search keywords:</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="product_search_keywords" id="product_search_keywords" placeholder="Enter keywords">
      </div>
	  </div>
	  <div class="form-group">
      <label class="control-label col-sm-3" for="quantity">Product quantity:</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="quantity" id="quantity" placeholder="Enter quantity">
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

								