<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
=======
  <?php
  if(isset($_SESSION['vendor']) || isset($_SESSION['customer'])){
  	header("Location: ../index.php");
  }
  ?>
  <!DOCTYPE html>
  <html lang="en">
>>>>>>> Graham

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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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

     <?php
    session_start();
    if(isset($_SESSION['customer']))
    {
        include '../includes/customer_header.php';
    }
    else if(isset($_SESSION['vendor']))
    {
        include '../includes/vendor_header.php';
    }
    else
    {
        include '../includes/header.php';
    }
    ?>

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

   <div class="container top-margin-content">
    <div class="row">
    <div class="col-md-6 col-md-offset-3" >
        <center><h1 class=" ">Login</h1></center>
        <form method="post" action ="check.php" id="reg-form">
          <div class="form-group">
            <label for="usr">E-mail:</label>
            <input type="email" class="form-control" id="email"  name="email">
          </div>
          <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" name="pass" id="pass" placeholder ="Enter in your password.">
          </div>
          <div class="form-group">
            <label>Account Type:</label>
            <select name="accountType">
              <option value="Customer">Customer</option>
              <option value="Vendor">Vendor</option>
            </select>
          </div>
            <input type = "submit" name ="submit" class="btn btn-success" value="Login"/>
        </form>
      </div>

      <div class="col-md-6 col-md-offset-3 result">
            <!-- DIV to display any feed back-->
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

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
