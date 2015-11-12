<?php

if(!isset($_COOKIE['user'])){
	header("Location: ../index.php");
}

include '../classes/database/database-connect.php';
$con = new Database();
$con->connectToDatabase();

	if(isset($_POST['submit'])){
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$pass = $_POST['pass'];

		if(!("" == trim($_POST['fname']))){
			$change = "UPDATE customer SET customerFname='$fname' where customerId ='".$_COOKIE['user']."'";
			$con->selectData($change);
		}
		if(!("" == trim($_POST['lname']))){
			$change = "UPDATE customer SET customerLname='$lname' where customerId ='".$_COOKIE['user']."'";
	        $con->selectData($change);
		}
		if(!("" == trim($_POST['email']))){
			$change = "UPDATE customer SET customerEmail='$email' where customerId ='".$_COOKIE['user']."'";
	        $con->selectData($change);
		}
		if(!("" == trim($_POST['pass']))){
			$change = "UPDATE customer SET customerPassword='$pass' where customerId ='".$_COOKIE['user']."'";
	        $con->selectData($change);
		}
	}
	else{
	header("Location: ../");
	}

$success = "Changes succesfully made!";
include 'settings.php';


?>
