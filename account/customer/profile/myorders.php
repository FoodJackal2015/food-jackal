<?php
/*
 * @category  Customer Orders
 * @package   customer/profile
 * @file      myorders.php
 * @data      21/11/15
 * @author    Conor Thompson
 * @copyright Copyright (c) 2015
*/


require_once('../../classes/database/database-connect.php');
include_once("../../classes/security/timeago.php"); // Include the timeago class

$con = new Database;
$con->connectToDatabase();

$timeAgoObject = new convertToAgo;

$sql="SELECT `Product`.`productTitle`, `Vendor`.`vendorName`, `Payment`.`paymentPrice`,`Order`.`orderDate`,`Order`.`orderStatus`,`Payment`.`paymentStatus`
      FROM `Order`
      INNER JOIN `Product` ON `Product`.`productId` = `Order`.`FK_productId`
      INNER JOIN `Vendor` ON `Vendor`.`vendorId` = `Order`.`FK_vendorId`
      INNER JOIN `Payment` ON `Payment`.`paymentId` = `Order`.`FK_paymentId`
      WHERE `Order`.`FK_customerId` = '".$_SESSION['customerId']."'";

$result = $con->selectData($sql);

?>
<link rel="stylesheet" type="text/css" href="../../css/my-orders.css"/>
<div class="row">
    <div class="col-md-3">
        <div class="list-group">
            <a href="?profile=My-Details" class="list-group-item">My Details</a>
            <a href="?profile=My-Orders" class="list-group-item active">My Orders</a>
            <a href="?profile=Favourites" class="list-group-item">Favourites</a>
        </div>
    </div>
    <div class="col-md-9">
        <h1 class="text-center"><?php echo $_SESSION['customerFname'];?>'s Orders</h1>
        <div class="scroll-pane">
            <table class="table table-striped table-hover table-responsive text-center">
                <thead>
                    <tr>
                        <th class="col-md-3 col-lg-3 text-center">Product Name</th>
                        <th class="col-md-3 col-lg-3 text-center">Store</th>
                        <th class="col-md-1 col-lg-1 text-center">Cost</th>
                        <th class="col-md-2 col-lg-2 text-center">Time</th>
                        <th class-="col-md-5 col-lg-5 text-center">Order Status</th>
                        <th class="col-md-4 col-lg-4 text-center">Payment Status</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if($result->num_rows > 0)
                    {
                        //Loop to output table row for each row in the dataset
                        while($row = $result->fetch_assoc())
                        {
                            /* Code for making time ago */
                            $convertedTime = ($timeAgoObject -> convert_datetime($row["orderDate"])); // Convert Date Time
                            $orderDate = ($timeAgoObject -> makeAgo($convertedTime));

                            if($row['orderStatus'] == 1)
                            {
                                $orderStatus = 'Collected';
                            }else{
                                $orderStatus = 'Uncollected';
                                }
                            if($row['orderStatus'] == 1)
                            {
                                $paymentStatus = 'Paid';
                            }else{
                                $paymentStatus = 'Unpaid';
                                }
                            echo '<tr>';
                                echo '<td>'.base64_decode($row['productTitle']).'</td>';
                                echo '<td>'.$row['vendorName'].'</td>';
                                echo '<td>&euro;'.$row['paymentPrice'].'</td>';
                                echo '<td>'.$orderDate.'</td>';
                                echo '<td>'.$orderStatus.'</td>';
                                echo '<td>'.$paymentStatus.'</td>';
                            echo '</tr>';
                        }
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
