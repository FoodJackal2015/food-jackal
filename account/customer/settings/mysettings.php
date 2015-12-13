<?php
/*
 * @category  Functionality for customers to add and update credit card details
 * @package   customer/settings
 * @file      mysettings.php
 * @data      12/11/15
 * @author    Conor Thompson
 * @copyright Copyright (c) 2015
*/

require_once('../../classes/database/database-connect.php');
$con = new Database();
$con->connectToDatabase();
$sql = "SELECT * FROM Customer_Credit_Card WHERE FK_customerId = '".$_SESSION['customerId']."'";//Get customer credit card details

if($result = $con->selectData($sql))
{
  $row_count = $result->num_rows;
  
  //Get data from dataset
  foreach ($result AS $value)
    {
     $ccnum = $value['creditCardIdNum'];
    }
}else
  {
    $error ="Something went horribly wrong.";
  }
if($row_count ==0)
{
    $yas= '<div class="alert alert-info alert-dismissible" id="poll" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    You have not yet entered your credit card details! Please enter them here:
    </div>';
}

?>
  <!-- AJAX to submit form to ccchange.php -->
  <script type="text/javascript">
    	$(document).ready(function ()
        {
            $(document).on('submit', '#credit-card-form', function ()
            {
                var data = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: './settings/ccchange.php',
                    data: data,
                    success: function (data)
                    {         
                        $(".result").fadeIn(500).show(function ()
                        {
                            $(".result").html(data);
                        });
                        
                    }//Close Success
                });
                return false;
            });
        });
    </script>
    
    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <br>
        <br/>
        <br>
      </div>
      <div class="row">

        <div class="col-md-3">
          <p class="lead">My Settings</p>
          <div class="list-group">
            <a href="settings.php?setting=My-Settings" class="list-group-item active">My Settings</a>
            <a href="settings.php?setting=General" class="list-group-item">General</a>
          </div>
        </div>

        <div class="col-md-9">
          <br>
          <br>
          <?php
              //Display message if no credit card details are set
              if(isset($yas))
              {
                echo $yas;
              }else{
                  echo '<p>Current Credit Card on record is XXXX-XXXX-XXXX-<b>'.substr($ccnum,-4).'</b></p>';
                  }
          ?>
          <div class="result">
          	<!-- AJAX result displayed here -->
          </div> 
          <div class="thumbnail">
            <form id="credit-card-form" role="form" >
              <div ng-app="">
                <label>Card Number:</label>
                <input type="text" class="form-control" ng-model = "ccnum" id="ccnumber" name="ccnumber" placeholder="xxxxxxxxxxxxxxxx">
                <span ng-if="ccnum.length != 0 && ccnum.length!=16 && ccnum!=null" style="color:red;">Incorrect amount of numbers</span>

                <div class="form-group">
                  <label>Expiry Date:</label>
                  <input type="text" class="form-control" ng-model="expiry" id="expiry"  name="expiry" placeholder="xx/xx">
                  <span ng-if="expiry.length !=5 && expiry.length!=0 && expiry!=null" style="color:red;">Incorrect format</span>
                </div>
                <div class="form-group">
                  <label>CVV:</label>
                  <input type="text" class="form-control" ng-model="cvv" name="cvv" id="cvv" placeholder ="xxx">
                  <span ng-if="cvv.length !=3 && cvv.length!=0 && cvv!=null" style="color:red;">Incorrect amount of numbers</span>
                </div>
              </div>
            </div>
            <div class="text-right">
              <input type="submit" id ="submit" name="submit" Value="Update" class="btn btn-success"></a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
    <!-- /.container -->
