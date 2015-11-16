<?php
if(isset($_COOKIE['pay'])){
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

    <title> FoodJackal | Checkout</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-item.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/cosmo/bootstrap.min.css" rel="stylesheet">

    
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
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" >
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img alt="Brand" src="logo.jpg" style="margin-top:-13px" width="95px" height="45px">
                </a>
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
    
    <?php
    if(isset($_SESSION['error'])){
        echo '<div class="alert alert-danger alert-dismissible" id="poll" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    '.$_SESSION['error'].' 
    </div>';
    }
    ?>;
</br></br></br>
<div class="container">

        <div class="row">

            <div class="col-md-3">
                
                <div class="list-group">
                    <a href="#" class="list-group-item active">Edit account details </a>
                    <a href="#" class="list-group-item">Review your order</a>
                    <a href="#" class="list-group-item"> Cancel Order</a>
                </div>
            </div>
        


      
        
        <div class="col-md-5">  
            
        <center><h1> Checkout </h1>
        <center><a href="#">Make Changes to your order</a></center>
            
       
        </br></br></br>

            <form action="order.html" method="post" id="checkout-order-form">
                <!-- Billing Form -->
                <fieldset id="fieldset-billing">
                    <legend>Billing Details</legend>
                    

                     <div>
                        <label for="fname" style="float:left"> Student/Staff ID </label>
                        
                        <input type="text" name="snum" id="snum" data-type="string" data-message="This field cannot be empty" style="margin-left:160px"/>
                        
                    </div>
                        </br>
                    <div>
                        <label for="fname" style="float:left"> First Name</label>
                        
                        <input type="text" name="fname" id="fname" data-type="string" data-message="This field cannot be empty" style="margin-left:200px"/>
                        
                    </div>
                        </br>
                    <div>
                        <label for="lname" style="float:left"> Last Name</label>
                        <input type="text" name="lname" id="lname" data-type="string" data-message="This field cannot be empty" style="margin-left:200px"/>
                    
                    </div>
                        </br>
                    <div>
                        <label for="email" style="float:left">Email Address</label>

                        <input type="text" name="email" id="email" data-type="expression" data-message="This is Not a valid email address" style="margin-left:175px"/>
                    </div>
                        </br>
                    <div>
                        <label for="city" style="float:left">City</label>
                        <input type="text" name="city" id="city" data-type="string" data-message="This field cannot be empty" style="margin-left:250px" />
                    </div>
                        </br>
                    <div>
                        <label for="address1" style="float:left">Address Line 1 </label>
                        <input type="text" name="address" id="address" data-type="string" data-message="This field cannot be empty"style="margin-left:175px" />
                    </div>
                        </br>
                    <div>
                        <label for="address2" style="float:left">Address Line 2 </label>
                        <input type="text" name="address" id="address" data-type="string" data-message="This field may not be empty" style="margin-left:175px" />
                    </div>
                        </br>
                    <div>
                        <label for="address3" style="float:left">Address Line 3 </label>
                        <input type="text" name="address" id="address" data-type="string" data-message="This field may not be empty"style="margin-left:175px"  />
                    </div>
                        </br>
                    
                    <div>
                        <label for="country" style="float:left">County</label>
                            <select name="country" id="country" data-type="string" data-message="This field may not be empty" style="margin-left:130px">
                                <option value="">Select</option>
                                <option value="DUB">Dublin</option>
                                <option value="LIM">Limerick</option>
                                <option value="GAL">Galway</option>
                                <option value="CO">Cork</option>
                                <option value="WEX">Wexford</option>
                                <option value="LAO">Laois</option>
                                <option value="OFF">Offaly</option>
                                <option value="KK">Kilkenny</option>
                                <option value="KD">Kildare </option>
                                <option value="M">Meath </option>

                            </select>
                    </div>  
                </fieldset>
            </form> 

</div>


                <!-- Paypal Container for checkout -->

                <div class="container">
                    </br>
                    <div style="width:380px; padding: 10px; margin: 5px; border: 5px solid grey; margin-left:850px">
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
                    <hr>
                    <div class="container">
                        
                       <center>
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" style="float:left; margin-left:70px">
                        <input type="hidden" name="cmd" value="_xclick  ">
                        <input type="hidden" name="business" value="foodjackals@gmail.com">
                        <input type="hidden" name="item_name" value="FoodJackal Order">
                        <input type="hidden" name="item_number" value="1">
                        <input type="hidden" name="amount" value="100.00">
                        <input type="hidden" name="currency_code" value="EUR">
                        <input type="hidden" name="tax" value="0">
                        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                        <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                        </form>
                        </center>





                    </div>


                
                        
                        
                        
                        
                        
                        
                    </div>
                

                       
                    </br>
                </div>





        <!-- Footer -->
         <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <center><p>Copyright &copy; FoodJackal</p></center>
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
