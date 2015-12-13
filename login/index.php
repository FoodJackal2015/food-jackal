<?php
/*
 * @category  Login
 * @date      01/10/15
 * @author    Conor Thompson
 * @copyright Copyright (c) 2015
*/

session_start();
//Kick user off page if already logged in
if(isset($_SESSION['vendor']) || isset($_SESSION['customer'])){
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
    <meta name="author" content="Conor Thompson">
    <link type="text/css" rel="stylesheet" href="../css/custom.css">

    <title>FoodJackal | Login</title>

    <?php include_once('../includes/links.php');?>

    <script>
      //AJAX for checking email and password
      $(document).ready(function ()
      {
          $(document).on('submit', '#login-form', function ()
          {
              var data = $(this).serialize();
              $.ajax({
                  type: 'POST',
                  url: 'check.php',
                  data: data,
                  success: function (data)
                  {         
                      $(".result").fadeIn(10000).show(function ()
                      {
                          $(".result").html(data);
                      });
                      
                  }//Close Success
              });
              return false;
          });
      });
      
      function indexRedirect()
      {
        window.setTimeout(function(){
        // Move to a new location or you can do something else
        window.location.href = "http://cloud.graham-murray.com/FoodJackal";
        }, 2500);
      }
    </script>
</head>
<body>

  <!-- Navigation -->
  <?php include('../includes/header.php');?>

  <!-- Page Content -->
  <div class="container top-margin-content">
    <div class="row">
      <div class="col-md-6 col-md-offset-3" >
        <center><h1 class=" ">Login</h1></center>
        <form id="login-form">
          <div class="form-group">
            <label for="usr">E-mail:</label>
            <input type="email" class="form-control" id="email"  name="email">
          </div>
          <?php
          //Set return URL
          if(isset($_GET['return'])){
            echo '<input type="hidden" class="form-control" id="return"  name="return" value="'.$_GET['return'].'">';
          }
          ?>
          <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" name="password" id="pass" placeholder ="Enter in your password.">
          </div>
          <div class="form-group">
            <label>Account Type:</label>
            <select name="accountType">
              <option value="customer">Customer</option>
              <option value="vendor">Vendor</option>
            </select>
          </div>
          <input type = "submit" class="btn btn-success" value="Login"/>
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

</body>

</html>