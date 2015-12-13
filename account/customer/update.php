<?php
session_start();
/*
 * @category  Update/Change Customers Account Details
 * @package   customer/update
 * @file      update.php
 * @data      29/10/15
 * @author    Conor Thompson
 * @copyright Copyright (c) 2015
*/

/* Check Customer is logged in */
if(!isset($_SESSION['customerId']))
{	
	header("Location: ../../index.php");
}

require_once('../../classes/database/database-connect.php');
$con = new Database();
$con->connectToDatabase();

	//Check form is submitted
	if(isset($_POST['submit'])){
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$pass = hash('sha256',$_POST['pass']);//Hash password;

		//Update database for each change
		if(!("" == trim($_POST['fname']))){
			$change = "UPDATE Customer SET customerFname='$fname' where customerId ='".$_SESSION['customerId']."'";
			$con->selectData($change);
		}
		if(!("" == trim($_POST['lname']))){
			$change = "UPDATE Customer SET customerLname='$lname' where customerId ='".$_SESSION['customerId']."'";
	        $con->selectData($change);
		}
		if(!("" == trim($_POST['email']))){
			$change = "UPDATE Customer SET customerEmail='$email' where customerId ='".$_SESSION['customerId']."'";
	        $con->selectData($change);
		}
		if(!("" == trim($_POST['pass']))){
			$change = "UPDATE Customer SET customerPassword='$pass' where customerId ='".$_SESSION['customerId']."'";
	        $con->selectData($change);
		}
	}
	else{
	header("Location: ../../index.php");
	}
$success = "Changes succesfully made!";
include('settings.php');
?>
