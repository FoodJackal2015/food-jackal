<?php
/*
 * @category  Vendor product admin for product CRUD Functionality
 * @package   product/admin/update
 * @file      update-post.php
 * @data      04/11/15
 * @author    Graham Murray <graham@graham-murray.com>
 * @copyright Copyright (c) 2015
*/
include('../../../classes/database/database-connect.php');
include('../../../classes/maths/math.php');

$conn = new Database;
$math = new Maths;

$conn->connectToDatabase();

session_start();
if(!(isset($_SESSION['vendorId']))){
	echo '<script>window.location = "http://'.$_SERVER['HTTP_HOST'].'/FoodJackal/account/vendor/list.php" </script>';

}elseif (!(isset($_POST['productId']))) {
	echo '<p class="error">Invalid Product</p>';
	}else{
		$vendorId = $_SESSION['vendorId'];
		$productId = $_POST['productId'];
		$productTitle = $_POST['productTitle'];
		$productPrice = $math->truncate_number($_POST['productPrice']);
		$productDescription = $_POST['productDescription'];

		$errors = array();//Array to hold error messages

		//Check if title is null
		if(empty($productTitle)){
			array_push($errors, "Title can't be empty");
		}		
		
		//Check if description is empty
		if(empty($productDescription)){
			array_push($errors, "Description can't be empty");
		}		

		//Check if price is empty
		if(empty($productPrice)){
			array_push($errors, "Price can't be empty");
		}	

			if(count($errors) < 1)//No errors so update record
			{

			$productTitle = base64_encode($productTitle);
			$productDescription = base64_encode($productDescription);

			$sql = "UPDATE Product
			SET productTitle='$productTitle', productPrice='$productPrice', productDesciption='$productDescription'
				WHERE productId='$productId' AND vendorId='$vendorId'";
		

				if(!$conn->updateDatabase($sql))
				{
					echo '<p class="error">Error Updating Product. Try again</p>';
				}else{
					echo '<script>window.location = "http://'.$_SERVER['HTTP_HOST'].'/FoodJackal/account/vendor/list.php" </script>';
					}

			}else{//Print Errors

					for($i=0; $i < count($errors); $i++){
						echo '<p> class="error">'.$errors[$i].'</p><br>';
						}//Close for loop
				}			
	}


?>