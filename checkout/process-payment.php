<?php
/*
 * @category  Process payment and push order to database
 * @package   checkout
 * @file      process-payment.php
 * @data      25/11/15
 * @author    Niall Curran, Seamus Fanning
 * @copyright Copyright (c) 2015
*/

session_start();
if(!isset($_SESSION['customerId']))//Make sure customer is logged in
{
	echo '<p class="error">Invalid User</p>';
	die;
}

require_once('../classes/database/database-connect.php');
$conn = new Database;

include_once("../classes/security/generator.php");//Random Generator
$gen = new RandomGenerator;

//Function to push data on to the database
function pushDatatoDb($cart, $customerId, $paymentFlag, $conn)
{
	$gen = new RandomGenerator;//New Instance of RandomGenerator
	
	$totalPrice = 0;
	foreach($cart AS $item)
	{
		$totalPrice += $item['productQuantity']*$item['productPrice'];
	}
	
	$orderRef = $gen->generateRandomString(20);//Random string for order reference
	
	//Generate Random Order Reference
	
	if($paymentFlag === 1 || $paymentFlag == 0){
		//Insert Payment Data into Payment Table
		$sql = "INSERT INTO Payment(	paymentPrice, paymentStatus,paymentDate) VALUES('".$totalPrice."','".$paymentFlag."',NOW())";
		$conn->connectToDatabase();
		if($conn->insertData($sql)){
			$payment_id = $conn->getLastId();
			$conn->closeConnection();
			
			//Foreach item in the cart insert it into Order table
			foreach ($cart as $value)
			{
				$sql = "INSERT INTO `Order`( `orderReference` ,`orderDate`, `orderStatus`, `orderQuantity`, `orderMessage`, `FK_customerId`, `FK_productId`, `FK_vendorId`, `FK_paymentId`) 
				VALUES('".$orderRef ."' , NOW() , 0 ,".(int) $value['productQuantity'].", '".base64_encode($value['orderMessage'])."' , '".$customerId."' , '".$value['productId']."' , '".$value['vendorId']."', '".$payment_id."')";
				$conn->connectToDatabase();
				if($conn->insertData($sql)){
					$success = true;
				}
				$conn->closeConnection();
			}
			
			//Empty Cart
			if($success === true){
				unset($_SESSION['cart']);
			}
			echo '<p class="success">Payment Successful</p>';
			echo '<script type="text/javascript">location.replace("payment-success.php?ref='.$orderRef.'&time='.date('d/m/Y H:i:s').'&email='.$_SESSION['customerEmail'].' "); </script>';

		}else{
			echo '<p class="error">Payment Failed. Ref: PC1</p>';
			}
	
	}else{
		echo '<p class="error">Invalid Payment Option</p>';
		}
}//Close pushDatatoDb()


if($_POST && isset($_POST['payment-option']) && !empty($_POST['payment-option']))
{
	$option = $_POST['payment-option'];
    if($option == 'collection')
    {
    	pushDatatoDb($_SESSION['cart'], $_SESSION['customerId'], 0, $conn);
    }elseif($option == 'credit-card'){
    	pushDatatoDb($_SESSION['cart'], $_SESSION['customerId'], 1, $conn);
    	}else{
    		echo '<p class="error">Invalid Payment Option</p>';
    		}
}else{
	echo '<p class="error">Invalid Data Submitted</p>';
	}
?>