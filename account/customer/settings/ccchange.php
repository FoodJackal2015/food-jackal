<?php
/*
 * @category  Addd/Update Credit Card Details
 * @package   customer/settings
 * @file      cchanges.php
 * @data      17/11/15
 * @author    Conor Thompson
 * @copyright Copyright (c) 2015
*/

session_start();
if($_POST){

	    $ccnum = $_POST['ccnumber'];
		$expiry = $_POST['expiry'];
		$cvv = $_POST['cvv'];

	$pattern1 = "/^[0-9\_]{16,16}/";//Credit Card Number Regex
	$pattern2 = "/^[0-9\/\_]{4,5}/";//Expiry Date Regex
	$pattern3 = "/^[0-9\_]{3,3}/";//CVV Regex
	$err=0;// This is a regular expression that checks if the name is valid characters

 	if(preg_match($pattern1,$ccnum))//Check Credit Card Number against regex 
	{
   		$ccnum = $_POST['ccnumber'];
	}else{
	echo '<div class="alert alert-danger alert-dismissible" id="poll" role="alert">
  			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  			Credit card number must be 16 digits only.
		  </div>';
	$err = $err +1;
	}

if (preg_match($pattern2,$expiry))//Check expiry date against regex
{
   $expiry = $_POST['expiry'];
}else{
		echo '<div class="alert alert-danger alert-dismissible" id="poll" role="alert">
	  		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  		  Expiry date must be a valid  mm/yy date.
			  </div>';
		$err = $err +1;
	}

if (preg_match($pattern3,$cvv))//Check CVV against regex
{
   $cvv = $_POST['cvv'];
}else{
		echo '<div class="alert alert-danger alert-dismissible" id="poll" role="alert">
	  			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  		  CVV must be a valid 3 digit code.
			  </div>';
		$err = $err +1;
	}

	if($err!=0)//Kill script as there's errors
	{
	die;
	}
}

include_once('../../../classes/database/database-connect.php');
$con = new Database();
$con->connectToDatabase();

if($_POST){
		$ccnum = $_POST['ccnumber'];
		$expiry = $_POST['expiry'];
		$cvv = $_POST['cvv'];

		$sql = "SELECT * FROM Customer_Credit_Card WHERE FK_customerId = '".$_SESSION['customerId']."'";
		if($result = $con->selectData($sql))
		{
			$row_count = mysqli_num_rows($result);//Get num of rows	
		}
		else{//Display error if select statement fails
			echo '<div class="alert alert-danger alert-dismissible" id="poll" role="alert">
		  		 	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  		  Our query didn\'t work? Somethings not right here...
				  </div>';
			die;
			}

		if($row_count ==0)//First credit card details entry
		{
			$swl = "INSERT INTO Customer_Credit_Card(creditCardIdNum,creditCardExpiry,creditCardCVV,FK_customerId) VALUES('$ccnum',$expiry,$cvv,".$_SESSION['customerId'].")";
			if($con->selectData($swl)){
			echo '<div class="alert alert-info alert-dismissible" id="poll" role="alert">
	  				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  		 	  We\'ve inserted you\'re first credit card entry!
				 </div>';
			die;	
			}else{
				echo '<div class="alert alert-warning alert-dismissible" id="poll" role="alert">
		  				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  			 Something went wrong, your formatting is not quite write!
					 </div>';
				die;
				}
		}


		if(!("" == trim($ccnum))){
			$change = "UPDATE Customer_Credit_Card SET creditCardIdNum='$ccnum' WHERE FK_customerId ='".$_SESSION['customerId']."'";
			$con->selectData($change);
		}
		if(!("" == trim($expiry))){
			$change = "UPDATE Customer_Credit_Card SET creditCardExpiry='$expiry' WHERE FK_customerId ='".$_SESSION['customerId']."'";
	        $con->selectData($change);
		}
		if(!("" == trim($cvv))){
			$change = "UPDATE Customer_Credit_Card SET creditCardCVV='$cvv' where FK_customerId ='".$_SESSION['customerId']."'";
	        $con->selectData($change);
		}
	
	echo '<div class="alert alert-success alert-dismissible" id="poll" role="alert">
  			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      	Success! Changes successfully made.
	  	  </div>';
}
else{
	echo '<div class="alert alert-danger alert-dismissible" id="poll" role="alert">
	  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      You didn\'t type in anything.
		  </div>';	
	}
?>