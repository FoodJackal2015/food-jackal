 <?php
 /*
 * @category  Customer Details Overview
 * @package   customer/profile
 * @file      mydetails.php
 * @data      20/11/15
 * @author    Conor Thompson
 * @copyright Copyright (c) 2015
*/

include '../../classes/database/database-connect.php';
$con = new Database;
$con->connectToDatabase();

$sql ="SELECT * FROM Customer WHERE customerId = '".$_SESSION['customerId']."'";

$result = $con->selectData($sql);

$row = mysqli_fetch_array($result);


$name = $row['customerFname']." ".$row['customerLname'];
$addr = $row['customerAddress'];
$email = $row['customerEmail'];
$time = $row['customerAccountCreation'];

include_once("../../classes/security/timeago.php"); // Include the class ti convert datetime to timeago
    
$timeAgoObject = new convertToAgo;
$convertedTime = ($timeAgoObject -> convert_datetime($time)); // Convert Date Time
$when = ($timeAgoObject -> makeAgo($convertedTime));

function displayCart(){//Cart is the SESSION for cart
    if( (isset($_SESSION['cart'])) )
    {
        $cart = $_SESSION['cart'];
    }else{
        $cart = array();
        }
    if(count($cart) > 0)//Cart isn't empty
    {   
        /* Foreach to print each item in the cart */
        $totalPrice = 0;
        foreach ($cart as $item)
        {
            $totalPrice += $item['productQuantity']*$item['productPrice'];//quantity*price for each item in the cart to get total price

            /* Table to out data */
            echo '<table class="table table-striped table-hover table-responsive">';
            echo    '<tr style="border-bottom:none;">';
            echo        '<td colspan="3" class="col-sm-3 col-md-3 col-lg-3 align-left">'.$item['productTitle'].'</td>';
            echo    '</tr>';
            echo    '<tr>';
            echo        '<td>x'.$item['productQuantity'].'</td>';
            echo        '<td>&euro;'.$item['productPrice'].'</td>';
            echo    '</tr>';
            echo '</table>';
        }
            echo '<div class="cart-total-price">';
                echo '<p><strong>Total: &nbsp;&nbsp; &euro;'.$totalPrice.'</strong></p>';
            echo '</div>';
        }else{//Print not items selected
            echo '<p>Your cart is empty</p>';
            }
}
 ?>

 <div class="row">
    <div class="col-md-3">
        <div class="list-group">
            <a href="?profile=My-Details" class="list-group-item active">My Details</a>
            <a href="?profile=My-Orders" class="list-group-item">My Orders</a>
            <a href="?profile=Favourites" class="list-group-item">Favourites</a>
        </div>
    </div>
    <div class="col-md-6">
        <div class="vendorDetails">
            <!--- Display Customers Details -->
            <h4><span class="glyphicon glyphicon-text glyphicon-user"></span> <?php echo $name;?></h4>
            <h4><span class="glyphicon glyphicon-text glyphicon-map-marker"></span> <?php echo $addr;?></h4>
            <h4><span class="glyphicon glyphicon-text glyphicon-envelope"></span> <?php echo $email;?></h4>
            <h4><span class="glyphicon glyphicon-text glyphicon-time"></span> <?php echo $when;?></h4>
        </div>
    </div>
    <div class="col-md-3">
        <div class="thumbnail  text-center">
                    <h3>Your Cart</h3>
                    <hr>
                        <div class="order-result">
                            <!-- Display Cart -->
                            <?php displayCart()?>
                        </div>
                        
                    <hr>
                    <div class="cart-empty-checkout">
                        <center>
                            <a class="btn btn-success" href="../../checkout/index.php">Checkout</a>
                        </center>
                    </div>
                </div>
    </div>
</div>
