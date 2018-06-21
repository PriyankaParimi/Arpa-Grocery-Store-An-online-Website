<?php
function test_input($data)
{
  $data=trim($data);
  $data=stripslashes($data);
  $data=htmlspecialchars($data);
  return $data;
}
$conn=mysqli_connect("localhost","root","root","grocery1");
	 if(!conn)
      {
         echo "Failed to connect".mysqli_connect_err();
      }
     else
      {
         $id=$_POST['id'];
		 echo $id;
         $title=test_input($_POST['title']);
         $price=test_input($_POST['price']);
         $category=test_input($_POST['category']);
         $brand=test_input($_POST['brand']);
		 $quantity=test_input($_POST['quantity']);
		 $catid=explode("-",$category);
		 $catid=$catid[0];
		 $brandid=explode("-",$brand);
		 $brandid=$brandid[0];
         $product_image=mysqli_real_escape_string($conn,basename($_FILES["fileToUpload"]["name"]));
       $target_dir = "product_images/";
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
         if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
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
          } 
          else {
                echo "Sorry, there was an error uploading your file.";
           }
          }
		  if($product_image=="")
		  {
			$query="UPDATE products SET product_title='$title',product_price='$price',product_brand='$brandid',product_cat='$catid',product_quantity='$quantity' where product_id='$id'";
         $result=mysqli_query($conn,$query);
         header("location:adminfinal.php");
		  }
		  else
		  {
        $query="UPDATE products SET product_title='$title',product_price='$price',product_img='$product_image',product_brand='$brandid',product_cat='$catid',product_quantity='$quantity' where product_id='$id'";
         $result=mysqli_query($conn,$query);
         header("location:adminfinal.php");
		  }
        } 

?>