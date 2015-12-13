<?php
session_start();

/* Force user to login */
if(!isset($_SESSION['customerId'])){
    header("Location: ../login/index.php?return=http://".$_SERVER['HTTP_HOST']."/FoodJackal/checkout/index.php ");
}else if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
        header("Location: ../index.php ");
    }

//Display cart an let customer increase item quantity an remove items
function displayCart($cart){//Cart is the SESSION for cart
    if(count($cart) > 0)//Cart isn't empty
    {   
        $totalPrice = 0;
        foreach ($cart as $item)
        {
            $totalPrice += $item['productQuantity']*$item['productPrice'];//quantity*price for each item in the cart to get total price

            /* Table to out data */
            echo '<table class="table table-striped table-hover table-responsive">';
            echo    '<tr style="border-bottom:none;">';
            echo        '<td colspan="4" class="col-sm-3 col-md-3 col-lg-3 align-left">'.$item['productTitle'].'</td>';
            echo    '</tr>';
            echo    '<tr>';
            echo        '<td>x'.$item['productQuantity'].'</td>';
            echo        '<td>&euro;'.$item['productPrice'].'</td>';
            
            echo        '<td>';
            echo            '<form id="cart-action" method="post">';
            echo                '<input type="hidden" name="vendorId" value="'.$item['vendorId'].'">';
            echo                '<input type="hidden" name="productId" value="'.$item['productId'].'">';
            echo                '<input type="hidden" name="action" value="add">';
            echo                '<input type="hidden" name="checkout" value="reload">';
            echo                '<input type="hidden" name="productTitle" value="'.base64_decode($item['productTitle']).'">';
            echo                '<input type="hidden" name="productPrice" value="'.$item['productPrice'].'">';
            echo                '<button type="submit"><a><span class="glyphicon glyphicon-plus-sign"></span></a></button>';
            echo            '</form>';
            echo        '</td>';
            
            echo        '<td>';
            echo            '<form id="cart-action" method="POST">';
            echo                '<input type="hidden" name="action" value="remove">';
            echo                '<input type="hidden" name="checkout" value="reload">';
            echo                "<input type='hidden' name='productId' value=".$item['productId'].">";
            echo                '<button type="submit"><a><span class="glyphicon glyphicon-remove-circle"></span></a></button>';
            echo            '</form>';
            echo        '</td>';
            echo    '</tr>';
            echo '</table>';
        }
            echo '<div class="cart-total-price">';
                echo '<p><strong>Total: &nbsp;&nbsp; &euro;'.$totalPrice.'</strong></p>';
            echo '</div>';
        }else{//Print not items selected
            echo '<p>No Items Selected</p>';
            }
}
function getTotalPrice($cart)
{
	$totalPrice = 0;
	foreach ($cart as $item) {
		$totalPrice += $item['productQuantity']*$item['productPrice'];//quantity*price for each item in the cart to get total price
	}
	return $totalPrice;
}

function calculateTax($cart)
{
	$total = getTotalPrice($cart);
	$vatPercent = 0.23;
	
	$vat = $total * $vatPercent;//Calculate VAT amount
	$subtotal = $total - $vat; //Get Sub Total Total - VAT
	
	//Store Values in array
	$taxes = array();
	$taxes['VAT'] = number_format((float)$vat, 2, '.', '');
	$taxes['Subtotal'] = number_format((float)$subtotal, 2, '.', '');;
	$taxes['Total'] = $total;
	
	return($taxes);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FoodJackal | Checkout</title>


    <!-- Custom CSS -->
    <link type="text/css" rel="stylesheet" href="../css/custom.css"/>
    
    <?php require_once("../includes/links.php");?>

    <script type="text/javascript">
        //Ajax for increasing order quantity and removing items
        $(document).ready(function ()
        {
            $(document).on('submit', '#cart-action', function ()
            {
                var data = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: '../cart/cart.php',
                    data: data,
                    success: function (data)
                    {
                        $(".order-result").html(data);
                    }//Close Success
                });
                return false;
            });
            
        });
        
        //Ajax for saving order message
        $(document).ready(function ()
        {
            $(document).on('submit', '#save-order-message', function ()
            {
                var data = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: 'save-order.php',
                    data: data,
                    success: function (data)
                    {
                        $(".order-save-result").html(data);
                    }//Close Success
                });
                return false;
            });
            
        });
        
        //Ajax for saving order message
        $(document).ready(function ()
        {
            $(document).on('submit', '#payment-process', function ()
            {
                var data = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: 'process-payment.php',
                    data: data,
                    success: function (data)
                    {
                        $(".payment-process-result").html(data);
                    }//Close Success
                });
                return false;
            });
            
        });
    </script>

    	<script type="text/javascript">
		 function reload5sDelay(id)
		 {
		 	 window.setTimeout(function() {
		        // This will execute 5 seconds later
		        var label = document.getElementById(id);
		        if (label != null) {
		            label.style.display = 'none';
		        }
		    }, 2000);
		 }   
		  
		 function reloadResult(id)
		 {
	        var label = document.getElementById(id);
            label.style.display = 'block';
		 }  

    </script>

    <style type="text/css">
        .col-centered{float: none; margin: 0 auto;}
        .order-message{width:100%;}
        .table > tbody > tr > td {vertical-align: middle;}
    </style>

</head>

<body>

  <!-- Navigation bar -->
   <?php include('../includes/header.php');?>
  
<body>
  <!-- Navigation -->
  <?php include('../includes/header.php');?>

  <!-- Page Content -->
  <div class="container top-margin-content">
    <div class="row">
        <div class="col-md-9 col-lg-9">
            <div class="thumbnail  text-center">
                <h2>Order Options</h2>
                <hr/>
                <p><i>Write a short note for each item in your order to tell the vendor what you want</i></p>
                <p class="small"><i>Example: One chicken fillet roll I want lettuce and tomato and on the second one I want ....</i></p>
                <form id="save-order-message">
	                <div class="row">
	                    <div class="col-md-10 col-lg-10 col-centered text-center">
	                        <table class="table table-striped table-responsive">
	                            <thead>
	                                <tr>
	                                    <th class="col-md-3 text-center">Item</th>
	                                    <th class="col-md-1 text-center">Quantity</th>
	                                    <th class="col-md-1 text-center">Total</th>
	                                    <th class="col-md-8 text-center">Order Message</th>
	                                </tr>
	                            </thead>
	                            <tbody class="order-overview">
	                                <?php
	                                foreach($_SESSION['cart'] as $item)
	                                {
	                                    echo '<tr>';
	                                    echo    '<td>';
	                                    echo        '<a style="text-decoration:none;" href="../cart/view-products.php?vid='.$item['vendorId'].'">';
	                                    echo            $item['productTitle'];
	                                    echo        '</a>';
	                                    echo    '</td>';
	                                    echo    '<td>x';
	                                    echo        $item['productQuantity'];
	                                    echo    '</td>';
	                                    echo    '<td>&euro;';
	                                    echo        $item['productQuantity']*$item['productPrice'];
	                                    echo    '</td>';
	                                    echo    '<td>';
	                                    echo        '<textarea class="order-message" name="order-summary[]">';
	                                    echo			$item['orderMessage'];
	                                    echo 		'</textarea>';
	                                    echo 		'<input type="hidden" name="messageId[]" value="'.$item['productId'].'"/>';
	                                    echo    '</td>';
	                                    echo '</tr>';
	                                }
	                                ?>

	                            </tbody>
	                        </table>
	                    </div>
	                </div>
	                
	             
	             	<div class="form-group">
	                    <center>
	                        <input type="submit" value="Save" class="btn btn-success"/>
	                    </center>
	                </div>
                </form>
                <div style="height:20px;">
                	<div class="order-save-result text-center" id="save-result">
                	
                	</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-lg-3">
            <div class="thumbnail  text-center">
                <h3>Your Order</h3>
                <hr>
                <div class="order-result">
                    <!-- AJAX Return Data Displayed Here Below is default values-->
                    <?php
                    displayCart($_SESSION['cart']);
                    ?>
                </div>

                <hr>
                <div class="cart-empty-checkout">
                    <center>
                        <form id="cart-action">
                            <input type="hidden" name="action" value="empty">
                            <input type="submit" value="Emtpy" class="btn btn-success"/>
                        </form>
                    </center>
                </div>
            </div>
        </div>
        
        <div class="col-md-9 col-lg-9">
            <div class="thumbnail  text-center">
                <h3>Payment</h3>
                <hr>
                <form id="payment-process">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <h4>Choose a payment option</h4>
                                <div class="form-group">
                                  <div class="col-lg-12">
                                    <div class="radio">
                                      <label>
                                        <input name="payment-option" id="collection" value="collection" checked="" type="radio">
                                        Payment on Collection
                                      </label>
                                    </div>
                                    <div class="radio">
                                      <label>
                                        <input name="payment-option" id="credit-card" value="credit-card" type="radio">
                                        Credit Card
                                      </label>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                            	<table class="table table-responsive">
	                            	<tbody>
	                            	<?php $taxes = calculateTax($_SESSION['cart']);?>
		                          		<tr>
		                          			<td>VAT</td>
		                          			<td>&euro;<?php echo $taxes['VAT'];?></td>
		                          		</tr>
		                            	<tr>
		                          			<td>Subtotal</td>
		                          			<td>&euro;<?php echo $taxes['Subtotal'];?></td>
		                          		</tr>
		                          		<tr>
	                          				<td><b>Total</b></td>
	                          				<td><b>&euro;<?php echo $taxes['Total'];?></b></td>
	                          			</tr>
	                            	</tbody>
                            	</table>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="form-group">
                        <center>
                            <input type="submit" value="Pay" class="btn btn-success"/>
                        </center>
                    </div>
                </form>
                <div style="height:18px;">
                	<div class="payment-process-result">
                	
                	</div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" style="float:right;">
            <div class="thumbnail  text-center">
                <h3>Paypal</h3>
                <p class="small">Alternatively you can pay with paypal!</p>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_xclick">
                    <input type="hidden" name="business" value="foodjackals@gmail.com">
                    <input type="hidden" name="item_name" value="FoodJackal Order">
                    <input type="hidden" name="item_number" value="1">
                    <input type="hidden" name="amount" value="<?php echo getTotalPrice($_SESSION['cart']);?>">
                    <input type="hidden" name="currency_code" value="EUR">
                    <input type="hidden" name="tax" value="0">
                    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.container -->

<div class="container">
  <hr>
  <!-- Footer -->
  <footer>
    <div class="row">
      <div class="col-lg-12">
        <p>Copyright &copy; FoodJackal 2015</p>
      </div>
    </div>
  </footer>

</div> 
                    
       
</body>

</html>
