<?php
session_start();
//Variables
if(isset($_POST) && !empty($_POST['vendorId']) && !empty($_POST['productId']) && !empty($_POST['productTitle']) && !empty($_POST['productPrice']))
{
	//Main Logic for a cart with no items
	$vendorId = $_POST['vendorId'];
	$productId = $_POST['productId'];
	$productTitle = $_POST['productTitle'];
	$productPrice = $_POST['productPrice'];
	$productQuantity = 1;

	/* Arrays to hold items */
	$cart = array();//Array to hold each order array
	$product = array();//Associative array of orders
	
	$product['productId'] = $productId;
	$product['vendorId'] = $vendorId;
	$product['productTitle'] = $productTitle;
	$product['productPrice'] = $productPrice;
	$product['productQuantity'] = $productQuantity;
	
	$cart = array_push($product, (count($cart)+1));
	
	$_SESSION['cart'] = $cart;

	//Out putting back to user
	$tempC = array();//Temp array
	$tempC = $_SESSION['cart'];
	
	foreach ($tempC in $item) {
		echo $item;
	}

	/*
	echo '<table class="table table-striped table-hover table-responsive">';
	echo	'<tr style="border-bottom:none;">';
	echo		'<td colspan="3" class="col-sm-3 col-md-3 col-lg-3 align-left">'.$productTitle.'</td>';
	echo	'</tr>';
	echo	'<tr>';
	echo		'<td>x'.$productQuantity.'</td>';
	echo		'<td>&euro;'.$productPrice.'</td>';
	echo		'<td>';
	echo 		'<a href="#"><span class="glyphicon glyphicon-remove-circle"></span></a>';
	echo		'</td>';
	echo	'</tr>';
	echo '</table>';
	echo '<div class="cart-total-price">';
		echo '<p><strong>Total: &nbsp;&nbsp; &euro;'.$productPrice.'</strong></p>';
	echo '</div>';*/


}else{
		echo '<p class="error">Order Error Invalid Product</p>';
		}


//Check if form values are set
//Check if values empty
//Add order to $_SESSION
//Function to add order each product to cart

?>