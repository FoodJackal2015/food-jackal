<?php

include '../classes/database/database-connect.php';
$con = new Database();
$con->connectToDatabase();
   $sql = "SELECT * from customer_credit_card where FK_customerId = '".$_COOKIE['user']."'";
    if($result = $con->selectData($sql)){
  $row_count = mysqli_num_rows($result);  
}
else{
  $error ="Something went horribly wrong.";

}
    if($row_count ==0){
     $yas= '<div class="alert alert-info alert-dismissible" id="poll" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  You have not yet entered your credit card details! Please enter them here:
</div>';
    }

    ?>
        <script type="text/javascript">
            
  
  $(document).ready(function ()
            {
                $(document).on('submit', '#reg-form', function ()
                {
                    //var fn = $("#fname").val();
                    //var ln = $("#lname").val();
                    //var data = 'fname='+fn+'&lname='+ln;
                    var data = $(this).serialize();
                    $.ajax({
                        type: 'POST',
                        url: 'ccchange.php',
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
    <script src= "http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>

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
                    <a href="settings.php?setting=Advanced" class="list-group-item">Advanced</a>
                </div>
            </div>

            <div class="col-md-9">
            <br>
            <br>
            <?php
              if(isset($yas)){
                echo $yas;
              }
            ?>
             <div class="result">
    </div> 
            <div class="thumbnail">
            <form id="reg-form" role="form" >
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
    <!-- /.container -->
