<?php
/*
 * @category  Payment Success
 * @package   checkout
 * @file      payment-success.php
 * @data      29/11/15
 * @author    Niall Curran, Seamus Fanning
 * @copyright Copyright (c) 2015
*/

session_start();

/* Force user to login */
if(!isset($_SESSION['customerId']) && !isset($_GET['ref'])){
    header("Location: ../login/index.php");
}elseif(!isset($_GET['ref']) && !isset($_GET['email']) && !isset($_GET['time']) ){
        header("Location: ../index.php");
        }

//Pickup time for order Reference http://stackoverflow.com/questions/5608967/how-to-add-5-minutes-to-current-datetime-on-php-5-3
$currentDate = strtotime($_GET['time']);
$futureDate = $currentDate+(60*15);//Add 15 mins
$pickupTime = date("d-m-Y H:i", $futureDate);
?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>FoodJackal | Payment Success</title>


  <!-- Custom CSS -->
  <link type="text/css" rel="stylesheet" href="../css/custom.css"/>

  <?php require_once("../includes/links.php");?>

</head>

<body>

  <!-- Navigation bar -->
  <?php include('../includes/header.php');?>

    <!-- Page Content -->
    <div class="container top-margin-content">
      <div class="row">
        <div class="col-md-12 thumbnail text-center">
          <h3>Congratulations your payment was successful!</h3>
          <p><span class="glyphicon glyphicon-time"></span>&nbsp;Your order will be ready for collection at <b><?php echo (string)$pickupTime;?></b></p>
          <hr>
          <p>To view your orders goto <a href="../account/customer/profile.php?profile=My-Orders" style="text-decoration:none;">My Orders</a></p>
          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <br>
                <br>
                <br>
                <p>Here at Food Jackal we're committed to contributing towards 
                  making the environment a cleaner and better place. So we decided
                  to provided you with a digital QR code reciept which you can show
                  when collecting you goods.                        
                </p>
              </div>

              <div class="col-md-6">     
                <h3>E-Docket</h3>
                <center>
                  <img class="img-responsive" alt="QR Code" src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo 'Email='.$_GET['email'].'Time='.$_GET['time'].'Ref='.$_GET['ref'];?>&choe=UTF-8">
                </center>
              </div>
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
            <p>Copyright &copy; FoodJackal 2015</p>
          </div>
        </div>
      </footer>
    </div>  
  </body>
  </html>
