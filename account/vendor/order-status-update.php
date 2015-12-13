<?php
/*
 * @category  Code to set order as processed
 * @package   product/admin
 * @file      order-status-update.php
 * @data      20/11/15
 * @author    Graham Murray <x13504987@student.ncirl.ie>
 * @copyright Copyright (c) 2015
*/
include('../../classes/database/database-connect.php');
$conn = new Database;
$conn->connectToDatabase();

session_start();
if(!(isset($_SESSION['vendorId']))){

	echo '<script>location.reload()</script>';
}elseif (!(isset($_POST['orderId']))) {
	echo '<p>Invalid product.</p>';
	}else{
		$vendorId = $_SESSION['vendorId'];
		$orderId = $_POST['orderId'];

		$sql = "UPDATE `Order`
		SET `orderStatus`=1 
		WHERE `orderId`='$orderId' AND `FK_vendorId`='$vendorId'";//Never delete a record only update it as it messes with foreign keys
	
		$conn->updateDatabase($sql);

		echo '<script>location.reload()</script>';
	}


?>