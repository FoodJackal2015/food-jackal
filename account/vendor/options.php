<?php
session_start();

if(!isset($_SESSION['vendorId'])){
	header("Location: ../../index.php");
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
    <link type="text/css" rel="stylesheet" href="../../css/custom.css">

    <title>FoodJackal | Login</title>

    <?php include('../../includes/links.php');?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
          <![endif]-->
  </head>

  <body>

        <!-- Navigation -->
        <?php include('../../includes/header.php');?>

        <!-- Page Content -->
        <div class="container top-margin-content">
          <div class="row">
            <h1 class="text-center"><?php echo $_SESSION['vendorName']?>'s Control Panel</h1>
            <div class="col-md-6" style="background-color:blue; height:100px;">
              
            </div>

            <div class="col-md-6" style="background-color:blue; height:100px;">
              
            </div>

            <div class="col-md-6" style="background-color:blue; height:100px;">
              
            </div>

            <div class="col-md-6" style="background-color:blue; height:100px;">
              
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
        <!-- /.container -->


  </body>

</html>