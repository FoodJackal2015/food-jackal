
 <?php

include '../classes/database/database-connect.php';
$con = new Database;
$con->connectToDatabase();

$sql ="SELECT * FROM Customer WHERE customerId = '".$_COOKIE['user']."'";

$result = $con->selectData($sql);

$row = mysqli_fetch_array($result);


$name = $row['customerFname']." ".$row['customerLname'];
$addr = $row['customerAddress'];
$email = $row['customerEmail'];
$time = $row['customerAccountCreation'];

include_once("../classes/security/timeago.php"); // Include the class library
        
        $timeAgoObject = new convertToAgo;
        $convertedTime = ($timeAgoObject -> convert_datetime($time)); // Convert Date Time
        $when = ($timeAgoObject -> makeAgo($convertedTime));

 ?>

 <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="?profile=My-Details" class="list-group-item active">My Details</a>
                    <a href="?profile=My-Orders" class="list-group-item">My Orders</a>
                    <a href="?profile=Favourites" class="list-group-item">Favourites</a>
                </div>
            </div>
            <div class="col-md-6">
                    <div class="vendorDetails">
                        <h4><span class="glyphicon glyphicon-text glyphicon-user"></span> <?php echo $name;?></h4>
                        <h4><span class="glyphicon glyphicon-text glyphicon-map-marker"></span> <?php echo $addr;?></h4>
                        <h4><span class="glyphicon glyphicon-text glyphicon-envelope"></span> <?php echo $email;?></h4>
                        <h4><span class="glyphicon glyphicon-text glyphicon-time"></span> <?php echo $when;?></h4>
                    </div>
                

            </div>
            <div class="col-md-3">
                <div class="thumbnail">
                    <h3 class="text-center">Your Order</h3>
                    <hr>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <center><input type="submit" value="Proceed" class="btn btn-success"/></center>
                </div>
            </div>

        </div>
