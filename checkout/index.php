<?php
  if(isset($_SESSION['cart'])){
        header("Location: ../index.php");
  }
  ?>

<?php
    
    session_start($_SESSION['cart']);

?>



<!DOCTYPE html>
  <html lang="en">


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FoodJackal | Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-item.css" rel="stylesheet">
    <link href="https://bootswatch.com/cosmo/bootstrap.min.css" rel="stylesheet">

    



<script type="text/javascript">
            
  //details of order JavaScript function 
  $(document).ready(function  ()
            {
                $('button').click('#btn', '#reg-form', function ()
                {
                
                    var data = $(this).serialize();
                    $.ajax({
                        type: 'POST',
                        url: 'asdf.php',
                        data: data,
                        success: function (data)
                        {         
                            $(".result").fadeIn(500).show(function ()
                            {//This is what you want to return, say if the php file echo something back, this is where you want it to go
                                $(".result").html(data);
                            });
                            
                        }//Close Success
                    });
                    return false;
                });
            });
</script>

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

  <!-- Navigation bar -->

    <?php include('../includes/header.php');?>
        <br/><br/>
  <!-- Page Content -->
    <div class="container">
    <?php
            if(isset($_SESSION['error'])){
                echo '<br><br><div class="alert alert-danger alert-dismissible" id="poll" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        '.$_SESSION["error"].' 
                        </div>';
            }
    ?>

    <br>
    <br>
</div> 


<!-- Left Side -->
<?php 
function destroy(){ 
    session_destroy();
    }

?>
    <div class="container-fluid">

        <div class="row">

            <div class="col-md-3">
                
                <div class="list-group">
                    <a href="../account/account.php" class="list-group-item" style="color:dodgerblue">Edit account details </a>
                    <a href="../cart/view-products.php" class="list-group-item"style="color:dodgerblue">Review your order</a>
                    <button onclick="destroy();" method="post" class="list-group-item" style="color:dodgerblue"> 
                        Cancel Order
                    </button> 
                </div>  
                    
            </div>

       


<!--Middle--> 
        <div class="col-md-7">  
            
                      <div class="container-fluid" style="width:700px; padding: 20px; margin: 5px; border: 5px solid dodgerblue;float:right  ">
                            
                            <center>

                                <h3>Your Order</h3>
                            
                            <hr>
                                
                                <div class="order-result">
                            

                            <!-- Display Cart in checkout container-->
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
                                    echo '<p>Your Cart is empty. Please add items to your cart and try again.</p>';
                                    }
                            ?>
                            <hr>
                        
                        <hr>


                    <!--php for order note -->
                        <?php
                            if(!(isset($_SESSION['note']))){
                                echo '<form id="reg-form">

                                    <textarea name="text" id="text"> </textarea>
                                        <br/>
                                    <button type="button" id="btn" name="submit" value="click here">Submit order note</button>

                                </form>';
                            }
                                else{
                                    echo '<div class="result">
                                          </div>';
                                }


                        ?>
                    <!--end of php --> 
                    </center>
                    <hr>
                    
                      
                    

                        

                        <!--Checkout buttons -->
                        
                        <input type="image" src="../images/checkout.png" border="0" name="submit" alt="Checkout" style="margin-left:50px; margin-top:200px; width:200px; height:70px">

                        
                        <!--paypal button functionality -->
                        
                            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                <input type="hidden" name="cmd" value="_xclick">
                                <input type="hidden" name="business" value="foodjackals@gmail.com">
                                <input type="hidden" name="item_name" value="FoodJackal Order">
                                <input type="hidden" name="item_number" value="1">
                                <input type="hidden" name="amount" value="<?php echo $totalPrice; ?>">
                                <input type="hidden" name="currency_code" value="EUR">
                                <input type="hidden" name="tax" value="0">
                                <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" style="margin-left:450px">
                                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                            </form>

                      </div>      

                                            
                        
                    </div>
                

                    
                </div>
      </div>   
            

        </div>




<!--right side-->



                <!-- Paypal Container for checkout -->






    <!-- close container -->
</br>
    <div class="container-fluid" style="background-color: dodgerblue; margin-top:90px; height:35px; ">

        

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <center><p style="color:white; font-family:arial">Copyright &copy; FoodJackal 2015</p></center>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
