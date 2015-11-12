<?php
if(!isset($_COOKIE['user'])){
	header("Location: ../");
}
if($_POST){

	    $ccnum = $_POST['ccnumber'];
		$expiry = $_POST['expiry'];
		$cvv = $_POST['cvv'];

	$pattern1 = "/^[0-9\_]{16,16}/";
	$pattern2 = "/^[0-9\/\_]{4,5}/";
	$pattern3 = "/^[0-9\_]{3,3}/";
	$err=0;// This is a regular expression that checks if the name is valid characters
  if (preg_match($pattern1,$ccnum)){
   $ccnum = $_POST['ccnumber'];
}else{
	echo '<div class="alert alert-danger alert-dismissible" id="poll" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  Credit card number must be 16 digits only.
</div>';
$err = $err +1;
	
}
if (preg_match($pattern2,$expiry)){
   $expiry = $_POST['expiry'];
}else{
	echo '<div class="alert alert-danger alert-dismissible" id="poll" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  Expiry date must be a valid  mm/yy date.
</div>';
$err = $err +1;
	
}
if (preg_match($pattern3,$cvv)){
   $cvv = $_POST['cvv'];
}else{
	echo '<div class="alert alert-danger alert-dismissible" id="poll" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  CVV must be a valid 3 digit code.
</div>';
$err = $err +1;
}

if($err!=0){
	die;
}
}

include '../classes/database/database-connect.php';
$con = new Database();
$con->connectToDatabase();

		if($_POST){
		$ccnum = $_POST['ccnumber'];
		$expiry = $_POST['expiry'];
		$cvv = $_POST['cvv'];

		$sql = "SELECT * from customer_credit_card where FK_customerId = '".$_COOKIE['user']."'";
		if($result = $con->selectData($sql)){
	$row_count = mysqli_num_rows($result);	
}
else{
	echo '<div class="alert alert-danger alert-dismissible" id="poll" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  Our query didn\'t work? Somethings not right here...
</div>';
	die;

}
		if($row_count ==0){
		$swl = "INSERT INTO customer_credit_card(creditCardIdNum,creditCardExpiry,creditCardCVV,FK_customerId) Values('$ccnum',$expiry,$cvv,".$_COOKIE['user'].")";
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
			$change = "UPDATE customer_credit_card SET creditCardIdNum='$ccnum' where FK_customerId ='".$_COOKIE['user']."'";
			$con->selectData($change);
		}
		if(!("" == trim($expiry))){
			$change = "UPDATE customer_credit_card SET creditCardExpiry='$expiry' where FK_customerId ='".$_COOKIE['user']."'";
	        $con->selectData($change);
		}
		if(!("" == trim($cvv))){
			$change = "UPDATE customer_credit_card SET creditCardCVV='$cvv' where FK_customerId ='".$_COOKIE['user']."'";
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
