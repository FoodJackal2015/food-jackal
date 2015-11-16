<?php
if(isset($_COOKIE['cart'])){
	header("Location: ../index.php");
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
    <link type="text/css" rel="stylesheet" href="../css/custom.css">

    <title> FoodJackal | Payment Operator </title>

    

    
            <script>
                function check(){
	               if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
                } else {  // code for IE6, IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                    xmlhttp.onreadystatechange=function() {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                document.getElementById("poll").innerHTML=xmlhttp.responseText;
                }
            }
 
                xmlhttp.open("POST","check.php");
                xmlhttp.send();
            }
            </script>






</head>




<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><font face="magneto">FoodJackal</font></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="">Services</a>
                    </li>
                    <li>
                        <a href="Contact">Contact</a>
                    </li>
                </ul>
				<ul class="nav navbar-nav navbar-right">
				<li>
				 <form class="navbar-form" action="search.php?go" method="post" role="search">
		<div class="input-group">
			<input type="text" class="form-control" placeholder="Search" name="srchterm" id="srchterm">
			<div class="input-group-btn">
				<button class="btn btn-default" name ="submit" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			</div>
		</div>
		</form>
		</li>
					<li>
					<a href="Signup">Signup</a>
				</li>
				<li>
					<a href="Login">Login</a>
				</li>
      </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>



    <!-- Page Content -->
    <div class="container">
    <?php
    if(isset($_SESSION['error'])){
        echo '<div class="alert alert-danger alert-dismissible" id="poll" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    '.$_SESSION['error'].' 
    </div>';
    }
    ?>;

<div class="container top-margin-content">

        <div class="row">

            <div class="col-md-3">
                <p class="lead">Shop Name</p>
                <div class="list-group">
                    <a href="#" class="list-group-item active">Category 1</a>
                    <a href="#" class="list-group-item">Category 2</a>
                    <a href="#" class="list-group-item">Category 3</a>
                </div>
            </div>

            <div class="col-md-3">	
                <center><h1>Checkout</h1></center>
        
        <center><a href="#">Make Changes to your order</a></center>
    </div>
    
    <div class="container">
        <h4><center> Review your Order </center></h4>
        <table> 

        </br> 



            <div id="pricing">
               

                <p id="sub-total">
                    <strong>Total</strong>: <span id="stotal"></span>
                </p>
            </div>

            <form action="order.html" method="post" id="checkout-order-form">
                <!-- Billing Form -->
                <fieldset id="fieldset-billing">
                    <legend>Billing</legend>
                    

                    <div>
                        <label for="lname"> First Name</label>
                        <input type="text" name="fname" id="fname" data-type="string" data-message="This field cannot be empty" />
                    </div>

                    <div>
                        <label for="fname"> Last Name</label>
                        <input type="text" name="lname" id="lname" data-type="string" data-message="This field cannot be empty" />
                    </div>

                    <div>
                        <label for="email">Email Address</label>
                        <input type="text" name="email" id="email" data-type="expression" data-message="This is Not a valid email address" />
                    </div>

                    <div>
                        <label for="city">City</label>
                        <input type="text" name="city" id="city" data-type="string" data-message="This field cannot be empty" />
                    </div>

                    <div>
                        <label for="address1">Address Line 1 </label>
                        <input type="text" name="address" id="address" data-type="string" data-message="This field cannot be empty" />
                    </div>

                    <div>
                        <label for="address2">Address Line 2 </label>
                        <input type="text" name="address" id="address" data-type="string" data-message="This field may not be empty" />
                    </div>

                    <div>
                        <label for="address3">Address Line 3 </label>
                        <input type="text" name="address" id="address" data-type="string" data-message="This field may not be empty" />
                    </div>

                    <div>
                        <label for="zip">ZIP Code</label>
                        <input type="text" name="zip" id="zip" data-type="string" data-message="This field may not be empty" />
                    </div>

                    <div>
                        <label for="country">Country</label>
                            <select name="country" id="country" data-type="string" data-message="This field cannot be empty">
                                <option value="">Select</option>
                                <option value="IE">Ireland</option>
                                <option value="UK">UK</option>
                                <option value="US">USA</option>
                                <option value="MEX">Mexico</option>
                                <option value="ESP">Spain</option>
                                <option value="FRA">France</option>
                                <option value="IT">Italy</option>
                                <option value="AUS">Australia</option>
                                <option value="FIJ">Fiji </option>
                            </select>
                    </div>  
                </fieldset>
            </form>

                <!-- End of Table --> 


                <!--Same as shipping address box --> 
                <div id="shipping-same">Same as shipping address <input type="checkbox" id="same-as-shipping" value=""/> </div>
                        <p><input type="submit" id="submit-order" value="Submit" class="btn" /></p>
                </div> 
    
    <div class="col-md-3">
                <div class="thumbnail  text-center">
                    <h3>Your Order</h3>
                    <hr>
                        <div class="order-result">
                            <!-- AJAX Return Data Displayed Here Below is default values-->
                            <?php
                            
                                if(isset($_SESSION['cart']))
                                {
                                    $totalPrice = 0;
                                    foreach ($_SESSION['cart'] as $item)
                                    {
                                        $totalPrice += $item['productQuantity']*$item['productPrice'];

                                        echo '<table class="table table-striped table-hover table-responsive">';
                                        echo    '<tr style="border-bottom:none;">';
                                        echo        '<td colspan="3" class="col-sm-3 col-md-3 col-lg-3 align-left">'.$item['productTitle'].'</td>';
                                        echo    '</tr>';
                                        echo    '<tr>';
                                        echo        '<td>x'.$item['productQuantity'].'</td>';
                                        echo        '<td>&euro;'.$item['productPrice'].'</td>';
                                        echo        '<td>';
                                        echo            '<form id="cart-action">';
                                        echo                '<input type="hidden" name="action" value="remove">';
                                        echo                '<input type="hidden" name="productId" value="$item["productPrice"]">';
                                        echo                '<button type="submit"><a><span class="glyphicon glyphicon-remove-circle"></span></a></button>';
                                        echo            '</form>';
                                        echo        '</td>';
                                        echo    '</tr>';
                                        echo '</table>';
                                    }
                                        echo '<div class="cart-total-price">';
                                            echo '<p><strong>Total: &nbsp;&nbsp; &euro;'.$totalPrice.'</strong></p>';
                                        echo '</div>';
                                }else{
                                    echo '<p>No Items in selected</p>';
                                    }
                            ?>
                            <hr>
                        </div>
                        <hr>
                         <div class="note-to-restaurant">
                            <div class="tr">
                                <label for="NoteToRestaurant">Leave a note for the restaurant</label>
                                <textarea maxlength="200" name="NoteToRestaurant" placeholder="Any additional information about your order (e.g. No Onions, Ketchup on 1 roll please.)"></textarea>
                            </div>
    </div>
                    <hr>
                    <div class="cart-empty-checkout">
                        <center>
                            <form id="comment">
                                <input type="submit" value="Add Note" class="btn btn-success"/>
                            </form>
                            <form id="cart-action">
                                <input type="hidden" name="action" value="empty">
                                <input type="submit" value="Empty" class="btn btn-success"/>
                            </form>
                        </center>
                    </div>
                </div>
            </div>
        </div>
<!-- Paypal Container for checkout -->

                
    </div>

                <!-- Paypal Container for checkout -->
              
                <div class="container">
                    </br>
                        <center><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" style="float:left">
                        <input type="hidden" name="cmd" value="_xclick">
                        <input type="hidden" name="business" value="foodjackals@gmail.com">
                        <input type="hidden" name="item_name" value="FoodJackal Order">
                        <input type="hidden" name="item_number" value="1">
                        <input type="hidden" name="amount" value="100.00">
                        <input type="hidden" name="currency_code" value="EUR">
                        <input type="hidden" name="tax" value="0">
                        <input type="image" src="https://authoralexapostoldotcom.files.wordpress.com/2014/03/paypal-buy-now-button-transparent.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                        <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                        </form></center>
                    </br>
                </div>






        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <center><p>Copyright &copy; FoodJackal 2015</p></center>
                </div>
            </div>
        </footer>

    </div>
    

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>