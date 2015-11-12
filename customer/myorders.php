
<?php

 include '../classes/database/database-connect.php';
$con = new Database;
$con->connectToDatabase();

//$sql ="SELECT Order.FK_customerId, Order.orderDate,Order.FK_productId, Product.productTitle,Product.productPrice, FROM Order INNER JOIN Product ON Order.FK_customerId = '".$_COOKIE['user']."' AND Order.FK_productId = Product.productId";
$sql="SELECT * from orders where FK_customerId='".$_COOKIE['user']."'";
$result = $con->selectData($sql);



?>
 <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="?profile=My-Details" class="list-group-item">My Details</a>
                    <a href="?profile=My-Orders" class="list-group-item active">My Orders</a>
                    <a href="?profile=Favourites" class="list-group-item">Favourites</a>
                </div>
            </div>
            <div class="col-md-9">
                    <div class="vendorDetails">
                        <table class="table table-striped">
    <thead>
      <tr>
        <th>Product Name</th>
        <th>Store</th>
        <th>Cost</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>

    <?php
    while($row = mysqli_fetch_array($result)){

        $sql1="SELECT * from product where productId='".$row['FK_productId']."'";
        $result1 = $con->selectData($sql1);
        $row1 = mysqli_fetch_array($result1);
        $sql2="SELECT * from vendor where vendorId='".$row['FK_vendorId']."'";
        $result2 = $con->selectData($sql2);
        $row2= mysqli_fetch_array($result2);

        $product = $row1['productTitle'];
        $store= $row2['vendorName'];
        $cost= $row1['productPrice'];
        $date= $row['orderDate'];
        $id = $row1['vendorId'];

        include_once("../classes/security/timeago.php"); // Include the class library
        $timeAgoObject = new convertToAgo;
        $convertedTime = ($timeAgoObject -> convert_datetime($date)); // Convert Date Time
        $when = ($timeAgoObject -> makeAgo($convertedTime));

        echo '<tr>
        <td>'.$product.'</td>
        <td><a href="vendor.php?vid='.$id.'">'.$store.'</a></td>
        <td>'.$cost.'</td>
        <td>'.$when.'</td>
      </tr>';
    }
    ?>
    </tbody>
  </table>
                    </div>
                

            </div>

        </div>
