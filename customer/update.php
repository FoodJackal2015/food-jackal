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

		if(!empty($fname)){
			$change = "UPDATE customer SET customerFname='$fname' where customerEmail ='".$_COOKIE['user']."'";
			$con->selectData($change);
		}
		if(!empty($lname)){
			$change = "UPDATE customer SET customerLname='$lname' where customerEmail ='".$_COOKIE['user']."'";
	        $con->selectData($change);
		}
		if(!empty($email)){
			$change = "UPDATE customer SET customerEmail='$email' where customerEmail ='".$_COOKIE['user']."'";
	        $con->selectData($change);
		}
		if(!empty($pass)){
			$change = "UPDATE customer SET customerPassword='$pass' where customerEmail ='".$_COOKIE['user']."'";
	        $con->selectData($change);
		}
	}
	else{
	header("Location: ../");
	}

$success = "Changes succesfully made!";
include 'settings.php';


?>
