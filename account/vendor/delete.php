<?php
/*
 * @category  Vendor product admin for product CRUD Functionality
 * @package   product/admin/delete
 * @file      delete.php
 * @data      04/11/15
 * @author    Graham Murray <graham@graham-murray.com>
 * @copyright Copyright (c) 2015
*/
include('../../classes/database/database-connect.php');
$conn = new Database;
$conn->connectToDatabase();

session_start();
if(!(isset($_SESSION['vendorId']))){

	echo '<script>loginRedirect()</script>';
}elseif (!(isset($_POST['productId']))) {
	echo '<p>Invalid product.</p>';
	}else{
		$vendorId = $_SESSION['vendorId'];
		$productId = $_POST['productId'];

		$sql = "UPDATE Product
		SET ProductStatus=0 
		WHERE productId='$productId' AND vendorId='$vendorId'";//Never delete a record only update it as it messes with foreign keys
	
		$conn->updateDatabase($sql);

		echo '<script>location.reload()</script>';
	}


?>