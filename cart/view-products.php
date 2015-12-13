<?php
/*
 * @category  View Vendor Products
 * @package   cart
 * @file      view-products.php
 * @data      01/11/15
 * @author    Graham Murray <x13504987@student.ncirl.ie>
 * @copyright Copyright (c) 2015
*/


session_start();
include('../classes/database/database-connect.php');
$conn = new Database;

if(!isset($_GET['vid']) || empty($_GET['vid'])){
        header("Location: ../index.php");
    }
/* Connect to database and retrieve all vendors*/
$vendorId = $_GET['vid'];
$conn->connectToDatabase();
$sql = "SELECT Vendor.*, Product.*
        FROM Vendor
        INNER JOIN Product
        ON Vendor.vendorId=Product.vendorId
        WHERE Vendor.vendorId='$vendorId' AND Product.ProductStatus='1' ";

$dataset = $conn->selectData($sql);
$conn->closeConnection();

if($dataset->num_rows > 0)
{

    while($row = $dataset->fetch_assoc())
    {
        //Vendor Details stored in varialbes
        $description = base64_decode($row['vendorDescription']);
        $vendorName = $row['vendorName'];
        $vendorAddress = $row['vendorAddressLine1'].', '.$row['vendorAddressLine2'].', '.$row['vendorCity'];
        $vendorTelephone = $row['vendorTelephone'];
        $vendorEmail = $row['vendorEmail'];
 



        //Code to get vendor logo if there's no logo it'll display a default image
        if($row['vendorLogoImageName'] == null)
        {
            $image = '../images/misc/noimage.png';//Default Image
        }else{
            $image = '../images/Vendor/'.$row['vendorFolderName'].'/logo.png ';
            }


    }
    
}else{
    echo '<script>window.location = "../index.php";</script>';
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Graham Murray">
    <link type="text/css" rel="stylesheet" href="../css/custom.css"/>
    <title>Food Jackal - Products</title>


    <!-- Hotlinks for scripts-->
    <?php include('../includes/links.php'); ?>
   
    <link type="text/css" rel="stylesheet" href="../css/list-products.css">
    <!-- Ajax form to add and update cart -->
	<script type="text/javascript">
	$(document).ready(function ()
            {
        		$(document).on('submit', '#cart-action', function ()
                {
                    var data = $(this).serialize();
                    $.ajax({
                        type: 'POST',
                        url: 'cart.php',
                        data: data,
                        success: function (data)
                        {
                            $(".order-result").html(data);
                        }//Close Success
                    });
                    return false;
                });
            	
            });
	
    </script>

</head>

<body>

    <!-- Navigation -->
    <?php include('../includes/header.php');?>
    
    <!-- Page Content -->
    <div class="container top-margin-content">
        <div class="row">
            <div class="col-md-9" >
                <div style="padding-bottom:40px;">
                    <img class="img-responsive vendorLogo"src="<?php echo $image;?>">
                    <div class="vendorDetails">
                        <h4><span class="glyphicon glyphicon-text glyphicon-cutlery"></span><?php echo $vendorName;?></h4>
                        <a class="a-address" href="<?php echo 'http://maps.google.com/?q='.$vendorAddress; ?>"><!-- Link to vendor on google maps -->
                            <h4><span class="glyphicon glyphicon-text glyphicon-map-marker"></span><?php echo $vendorAddress;?></h4>
                        </a>
                        <h4><span class="glyphicon glyphicon-text glyphicon-phone"></span><?php echo $vendorTelephone;?></h4>
                        <h4><span class="glyphicon glyphicon-text glyphicon-envelope"></span><?php echo $vendorEmail;?></h4>
                        <div class="description"><h4><?php echo $description;?></h4></div>
                    </div>
                </div>

                <!-- Vendor Menu-->
                <div class="menu scroll-pane">
                    <table class="table table-striped table-hover table-responsive">
                        <thead>
                            <tr>
                                <th class="col-md-3 align-center">Title</th>
                                <th class="col-md-5 col-lg-6 align-center">Description</th>
                                <th class="col-md-1 col-lg-1 align-center">Price</th>
                                <th class="text-center">Add to Cart</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($dataset->num_rows > 0) {
                                    // output data of each row
                                    foreach ($dataset as $row)//Use foreach instead of fetch_assoc() with while loop
                                    {
                                    	// output data of each row
                                    echo '<tr>';
                                    	echo '<td>';
                                    		echo base64_decode($row['productTitle']);
                                    	echo '</td>';

                                    	echo '<td>';
                                    		echo base64_decode($row['productDesciption']);
                                    	echo '</td>';

                                    	echo '<td>';
                                    		echo '&euro;'.$row['productPrice'];
                                    	echo '</td>';

                                    	echo '<td>';
                                    		echo '<form id="cart-action" method="post">';
                                    			//Send Array in hidden input
                                    			echo '<input type="hidden" name="vendorId" value="'.$row['vendorId'].'">';
                                                echo '<input type="hidden" name="productId" value="'.$row['productId'].'">';
                                                echo '<input type="hidden" name="action" value="add">';
                                                echo '<input type="hidden" name="productTitle" value="'.base64_decode($row['productTitle']).'">';
                                                echo '<input type="hidden" name="productPrice" value="'.$row['productPrice'].'">';
                                    			echo "<center><button type='submit' class='btn-edit btn-sm'><span class='glyphicon glyphicon-plus'></span></button></center>";
                                    		echo '</form>';
                                    	echo '</td>';
                                    
                                    echo '</tr>';
                                    }
   
                                } else {
                                    echo "<p>There's no products for this vendor</p>";
                                    }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <br/>
            <div class="col-md-3">
                <div class="thumbnail  text-center">
                    <h3>Your Order</h3>
                    <hr>
	                    <div class="order-result">
	                    	<!-- AJAX Return Data Displayed Here Below is default values-->
                            <?php
                            
                                if(isset($_SESSION['cart']) && !empty($_SESSION['cart']) )
                                {
                                    displayCart($_SESSION['cart']);
                                }else{
                                    echo '<p>No Items in selected</p>';
                                    }
                            ?>
	                    </div>
                    <hr>
                    <div class="cart-empty-checkout">
                        <center>
                            <form id="awaiting" action="../checkout/index.php">
                                <input type="submit" value="Checkout" class="btn btn-success"/>
                            </form>
                            <form id="cart-action">
                                <input type="hidden" name="action" value="empty">
                                <input type="submit" value="Emtpy" class="btn btn-success"/>
                            </form>
                        </center>
                    </div>
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
                    <p>Copyright &copy; Food Jackal 2015</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

</body>
</html>
