<?php
/*
 * @category  Code to set payment as processed
 * @package   product/admin
 * @file      payment-status-update.php
 * @data      25/11/15
 * @author    Graham Murray <x13504987@student.ncirl.ie>, Conor Thompson
 * @copyright Copyright (c) 2015
*/
include('../../classes/database/database-connect.php');
$conn = new Database;
$conn->connectToDatabase();

session_start();
if(!(isset($_SESSION['vendorId']))){

	echo '<script>location.reload()</script>';
}elseif (!(isset($_POST['paymentId']))) {
	echo '<p>Invalid payment.</p>';
	}else{
		$vendorId = $_SESSION['vendorId'];
		$paymentId = $_POST['paymentId'];

		$sql = "UPDATE `Payment`
		SET `paymentStatus`=1 
		WHERE `paymentId`=".$paymentId;//Never delete a record only update it as it breaks foreign keys relationship
	
		$conn->updateDatabase($sql);

		echo '<script>location.reload()</script>';//Use set header location because output buffer set
	}


?>