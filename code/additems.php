<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname="grocery1"; 

$conn = mysqli_connect($servername,$username,$password,$dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    echo "Database Connection Error";
}
$product_title=mysqli_real_escape_string($conn,$_POST['title']);
$product_brand_id=mysqli_real_escape_string($conn,$_POST['brand']);
$brandid=explode("-",$product_brand_id);
$brandid=$brandid[0];
$product_category_id=mysqli_real_escape_string($conn,$_POST['category']);
$catid=explode("-",$product_category_id);
$catid=$catid[0];
$product_search_keywords=mysqli_real_escape_string($conn,$_POST['product_search_keywords']);
$product_price=mysqli_real_escape_string($conn,$_POST['price']);
$product_quantity=mysqli_real_escape_string($conn,$_POST['quantity']);
$product_image=mysqli_real_escape_string($conn,basename($_FILES["fileToUpload"]["name"]));
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";		
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
$query= "INSERT INTO products(product_cat,product_title,product_price,product_img,product_keywords,product_brand,product_quantity) values ('$catid','$product_title','$product_price','$product_image','$product_search_keywords','$brandid','$product_quantity')";
$results=mysqli_query($conn,$query); 
header("location:adminfinal.php"); 

?>