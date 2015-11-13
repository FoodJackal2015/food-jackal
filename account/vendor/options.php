<?php
session_start();

if(!isset($_SESSION['vendorId'])){
	header("Location: ../../login/index.php");
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

    <title>FoodJackal | Control Panel</title>

    <?php include('../../includes/links.php');?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
          <![endif]-->
    <style type="text/css">
    	.classWithPad { margin:10px; padding:10px; }
    	.glyphicon-big{font-size:10em;}
    	.glyphicon{color:#333333;}
    	.glyphicon:hover{color:#2780e3;}
    	a{color:#333333;}
    	a:hover{text-decoration: none;}
    	span{margin-top:10px;}
    </style>
  </head>

  <body>

        <!-- Navigation -->
        <?php include('../../includes/header.php');?>

        <!-- Page Content -->
        <div class="container top-margin-content">
          <div class="row">
          	<div class="col-md-12 text-center" style="margin-bottom:20px;">
            	<h1><?php echo $_SESSION['vendorName']?>'s Control Panel</h1>
            </div>

            <div class="col-md-3 text-center">
        		<a href="">
            		<div class="thumbnail">
              			<span class="glyphicon glyphicon-edit glyphicon-big"></span>
              			<h3>Edit Account</h3>
              		</div>
          		</a>
            </div>

            <div class="col-md-3 text-center">
        		<a href="list.php">
              		<div class="thumbnail">
              			<span class="glyphicon glyphicon-eye-open glyphicon-big"></span>
              			<h3>View Products</h3>
              		</div>
          		</a>
            </div>

            <div class="col-md-3 text-center">
        		<a href="./add/index.php">
              		<div class="thumbnail">
              			<span class="glyphicon glyphicon-plus-sign glyphicon-big"></span>
              			<h3>Add Products</h3>
              		</div>
          		</a>
            </div>

            <div class="col-md-3 text-center">
        		<a href="#">
              		<div class="thumbnail">
              			<span class=" 	glyphicon glyphicon-qrcode glyphicon-big"></span>
              			<h3>Manage Orders</h3>
              		</div>
          		</a>
            </div>

            <div class="col-md-3 text-center">
        		<a href="#">
              		<div class="thumbnail">
              			<span class="glyphicon glyphicon-euro glyphicon-big"></span>
              			<h3>Payments</h3>
              		</div>
          		</a>
            </div>

            <div class="col-md-3 text-center">
        		<a href="./logo/add/">
              		<div class="thumbnail">
              			<span class="glyphicon glyphicon-picture glyphicon-big"></span>
              			<h3>Add Logo</h3>
              		</div>
          		</a>
            </div>

            <div class="col-md-3 text-center">
        		<a href="#">
              		<div class="thumbnail">
              			<span class="glyphicon glyphicon-envelope glyphicon-big"></span>
              			<h3>View Email</h3>
              		</div>
          		</a>
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