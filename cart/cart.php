<?php
/*
 * @category  Cart Functionality
 * @package   cart
 * @file      cart.php
 * @data      15/11/15
 * @author    Graham Murray <x13504987@student@ncirl.ie>
 * @copyright Copyright (c) 2015
*/
session_start();

/* Initalize a new cart*/
if(!(isset($_SESSION['cart'])))//Inital initalize an empty cart
{
	$_SESSION['cart'] = null;
}

function checkCartForItem($addItem, $cartItems) {//$addItem = current productId , cartItem = SESSION['cart']
     if (is_array($cartItems) && !(is_null($cartItems)))
     {
          foreach($cartItems as $key => $item) 
          {
              if($item['productId'] == $addItem)
                  return true;
          }
     }
     return false;
}

function displayCart($cart){//Cart is the SESSION for cart
	if(count($cart) > 0)//Cart isn't empty
	{	
		$totalPrice = 0;
		foreach ($cart as $item)
		{
			$totalPrice += $item['productQuantity']*$item['productPrice'];//quantity*price for each item in the cart to get total price

			/* Table to out data */
			echo '<table class="table table-striped table-hover table-responsive">';
			echo	'<tr style="border-bottom:none;">';
			echo		'<td colspan="4" class="col-sm-3 col-md-3 col-lg-3 align-left">'.$item['productTitle'].'</td>';
			echo	'</tr>';
			echo	'<tr>';
			echo		'<td>x'.$item['productQuantity'].'</td>';
			echo		'<td>&euro;'.$item['productPrice'].'</td>';
			
			echo 		'<td>';
			echo			'<form id="cart-action" method="post">';
			echo        		'<input type="hidden" name="vendorId" value="'.$item['vendorId'].'">';
			echo				'<input type="hidden" name="productId" value="'.$item['productId'].'">';
			echo            	'<input type="hidden" name="action" value="add">';
			echo            	'<input type="hidden" name="productTitle" value="'.base64_decode($item['productTitle']).'">';
			echo            	'<input type="hidden" name="productPrice" value="'.$item['productPrice'].'">';
			echo        		'<button type="submit"><a><span class="glyphicon glyphicon-plus-sign"></span></a></button>';
			echo  			'</form>';
			echo 		'</td>';
			
			echo		'<td>';
			echo 			'<form id="cart-action" method="POST">';
			echo 				'<input type="hidden" name="action" value="remove">';
			echo 				"<input type='hidden' name='productId' value=".$item['productId'].">";
			echo 				'<button type="submit"><a><span class="glyphicon glyphicon-remove-circle"></span></a></button>';
			echo 			'</form>';
			echo		'</td>';
			echo	'</tr>';
			echo '</table>';
		}
			echo '<div class="cart-total-price">';
				echo '<p><strong>Total: &nbsp;&nbsp; &euro;'.$totalPrice.'</strong></p>';
			echo '</div>';
			echo '<script type="text/javascript">location.reload()</script>';//Temporary Page Reload for checkout order options to change
		}else{//Print not items selected
			echo '<p>No Items Selected</p>';
			}
}


if(isset($_POST) && isset($_POST['action']) && !empty($_POST['action']) )
{
	if($_POST['action'] == 'add')//Add item to cart
	{
		/* Product Details from form stored in variables*/
		$vendorId = $_POST['vendorId'];
		$productId = $_POST['productId'];
		$productTitle = $_POST['productTitle'];
		$productPrice = $_POST['productPrice'];
		$productQuantity = 1;
		/* Associative array of a product while will be store in the SESSION['cart'] */
		$product = array();
		$exists = checkCartForItem($productId, $_SESSION['cart']);

		//Stop customers ordering from muliple vendors
		if(!empty($_SESSION['cart']))
		{
			if($_SESSION['cart'][0]['vendorId'] != $vendorId)//Check if product on index 0 is the same as the current order coming in
			{
				echo '<p class="error">You cannot order from multiple shops</p>';
				die;//Kill Script
			}
		}

		if($exists)//Product already in cart update quantity x1
		{
			$posCount = 0;//Count to keep track of where we are in the array posCount = index
			foreach($_SESSION['cart'] as $key => $value) 
			{
				if($value['productId'] == $productId)
				{

				  $_SESSION['cart'][$posCount]['productQuantity']++;

				}
				$posCount++;
			}
     	

		}else{//Product not in cart so add it
			$product['productId'] = $productId;
			$product['vendorId'] = $vendorId;
			$product['productTitle'] = $productTitle;
			$product['productPrice'] = $productPrice;
			$product['productQuantity'] = $productQuantity;
			$product['orderMessage'] = "";

			$_SESSION['cart'][] = $product;//Associative array within the $_SESSION

			}
			
	}//Close Add/Update Product block
	
	if($_POST['action'] == 'remove')//Remove cart from Item.
	{	
		$productId = $_POST['productId'];
		
		$exists = checkCartForItem($productId, $_SESSION['cart']);
		if($exists)//Product already in cart update quantity x1
		{
			$posCount = 0;//Count to keep track of where we are in the array posCount = index
			foreach($_SESSION['cart'] as $key => $value) 
			{
				if($value['productId'] == $productId && $_SESSION['cart'][$posCount]['productQuantity'] >= 1)
				{

					if(intval($_SESSION['cart'][$posCount]['productQuantity']) == 1)//Value is == 1 so completely remove it from cart
					{
						unset($_SESSION['cart'][$posCount]);
						sort($_SESSION['cart']);//Reorder the array indexes so the inorder from 0 upwards
						
						/* If the cart is completely empty tell client */
						if(is_null($_SESSION['cart']))
						{
							echo '<p>No items selected.</p>';
							echo '<script type="text/javascript">location.reload()</script>';//Temporary Page Reload for checkout order options to change
						}

					}else{//Value is >= 2 so decrement quantity
						$_SESSION['cart'][$posCount]['productQuantity']--;
						}

				}
				$posCount++;
			}
		}

	}

	if($_POST['action'] == 'empty')//Remove cart from Item.
	{
		unset($_SESSION['cart']);
		echo '<p>No Items Selected</p>';
		echo '<script type="text/javascript">location.reload()</script>';//Temporary Page Reload for checkout order options to change

	}

	/* Print Cart back to client */
	if($_POST['action'] != 'empty' && !is_null($_SESSION['cart']))
	{
		displayCart($_SESSION['cart']);
	}
	

}else{
		echo '<p class="error">Order Error Invalid Product</p>';
	}

//session_unset('cart');

?>
