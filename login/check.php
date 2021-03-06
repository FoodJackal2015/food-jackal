<?php
/*
 * @category  Checking user creditals for login
 * @date      05/10/15
 * @author    Graham Murray, Conor Thompson
 * @copyright Copyright (c) 2015
*/


include ('../classes/database/database-connect.php');
//if user is logged in already
session_start();
if(isset($_SESSION['vendorId']) || isset($_SESSION['customerId'])){
	echo "<center><p class= 'error'>Please logout before proceeding</p></center>";
	die();
}
//if the user tries to open this script without form action
if(!(isset($_POST['email'])) and !(isset($_POST['password']))) {
	header('Location: http://'.$_SERVER['HTTP_HOST'].'/FoodJackal');
	
}
//Email or password empty
if(empty($_POST['email']) ||  empty($_POST['password']) ){
	die("<center><p class= 'error'>Email or Password Can't be empty</p></center>");
}
$con = new Database();
$con->connectToDatabase();
$email = $_POST['email'];
$pass = hash('sha256',$_POST['password']);//Hash password
$accountType = $_POST['accountType'];
if($accountType === 'customer'){
	
	$sql = "SELECT * FROM Customer WHERE customerEmail='$email' AND customerPassword='$pass' ";
	$dataset = $con->selectData($sql);
	if($dataset->num_rows == 1){
		//We have a valid User
		
		//Set Session Cookie with customer details
		while($row = $dataset->fetch_assoc()) {
         	$_SESSION['customer'] = true;
         	$_SESSION["customerId"] = $row['customerId'];
         	$_SESSION["customerFname"]= $row['customerFname'];
         	$_SESSION["customerLname"]= $row['customerLname'];
         	$_SESSION["customerEmail"]= $row['customerEmail'];
         	$_SESSION["customerAddress"]= $row['customerAddress'];
 		}
		//Redirect to index page
		echo '<center><p class= "success">Login Successful</p></center>';
		if(isset($_POST['return'])){
			echo '<script type="type=text/javascript">location.replace("'.$_POST['return'].'");</script>';
		}else{
			echo '<script type="type=text/javascript">location.replace("../account/customer/settings.php");</script>';
			}

	}else{
		//Invalid User
		echo '<center><p class= "error">Invalid Username or Password</p></center>';
		}
}else if($accountType === 'vendor'){
	$sql = "SELECT * FROM Vendor WHERE vendorEmail='$email' AND vendorPassword='$pass' ";
	$dataset = $con->selectData($sql);
	if($dataset->num_rows == 1){
		//We have a valid User
		
		//Set Session Cookie with customer details
		while($row = $dataset->fetch_assoc()) {
         	$_SESSION["vendor"] = true;
         	$_SESSION["vendorId"] = $row['vendorId'];
         	$_SESSION["vendorName"] = $row['vendorName'];
         	$_SESSION["vendorEmail"] = $row['vendorEmail'];
         	$_SESSION["vendorFolderName"] = $row['vendorFolderName'];
         	$_SESSION["vendorLogoImageName"] = $row['vendorLogoImageName'];
 		}
		//Redirect to index page
		echo '<center><p class= "success">Login Successful</p></center>';
		echo '<script type="type=text/javascript">location.replace("../account/vendor/options.php");</script> ';
	}else{
		//Invalid User
		echo '<center><p class= "error">Invalid Username or Password</p></center>';
		}
}else{//Account Type set incorrectly
	'<center><p class= "error">Server Error, Please try</p></center>';
	}
