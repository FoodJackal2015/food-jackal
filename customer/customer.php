<?php
include './classes/database/database-connect.php';
$con = new Database();
$con->connectToDatabase();

$sql="SELECT * FROM vendor";

$result = $con->selectData($sql);


?>

<div class="container">

        <div class="row">
        <br>
        <br>
        <br>
        </div>
        <div class="row">
            <div class="col-md-3">
                <p class="lead"></p>
                <div class="list-group">
                    <a href="#" id="shops" class="list-group-item active">Shops</a>
                    <a href="#" id="offers" class="list-group-item">Offers</a>
                    <a href="customer/profile.php?profile=My-Orders" class="list-group-item">My Orders</a>
                </div>
            </div>

            <div class="col-md-9">
                <?php while($row=mysqli_fetch_array($result)){
                    $name= $row['vendorName'];
                    $description = $row['vendorDescription'];
                    $id = $row['vendorId'];
                    $image = $row['vendorLogoImageName'];
                    echo '<div class="thumbnail">
                <img src='.$image.' href="customer/vendor.php?vid='.$id.'" class = "img-responsive">
                    <div class="caption-full">
                        <h4 class="pull-right"></h4>
                        <h4><span class="glyphicon glyphicon-text glyphicon-home" style="padding:5px;"></span><a href="customer/vendor.php?vid='.$id.'">'.$name.'</a>
                        </h4>
                        <h4><span class="glyphicon glyphicon-text glyphicon-map-marker"></span>'.$row["vendorAddressLine1"].'</h4>
                        <p>'.$description.'</p>
                        </div></div>';
                        }
                        ?>
                         
                </div>

                
                    </div>

                </div>
