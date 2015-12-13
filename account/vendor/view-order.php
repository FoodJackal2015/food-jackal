<?php
/*
 * @category  Management of orders
 * @package   product/admin
 * @file      view-order.php
 * @data      01/12/15
 * @author    Graham Murray <x13504987@student.ncirl.ie>
 * @copyright Copyright (c) 2015
*/
session_start();

function loadOrders($conn,$sort)
{
	/* Switch to filter data based on $_GET[sort] */
	switch ($sort) 
	{
	    case "dateAsc":
	        $sql = "SELECT o.*, c.customerEmail, p.productTitle FROM `Order` AS o 
					LEFT JOIN `Product` p ON p.productId = o.FK_productId
					LEFT JOIN `Customer` c ON c.customerId = o.FK_customerId
	       			WHERE FK_vendorId=".$_SESSION['vendorId']." ORDER BY o.orderDate ASC";
	        break;
	    case "dateDesc":
	        $sql = "SELECT o.*, c.customerEmail, p.productTitle FROM `Order` AS o 
					LEFT JOIN `Product` p ON p.productId = o.FK_productId
					LEFT JOIN `Customer` c ON c.customerId = o.FK_customerId
	        		WHERE FK_vendorId=".$_SESSION['vendorId']." ORDER BY o.orderDate DESC";
	        break;
	    case "processed":
	        $sql = "SELECT o.*, c.customerEmail, p.productTitle FROM `Order` AS o 
					LEFT JOIN `Product` p ON p.productId = o.FK_productId
					LEFT JOIN `Customer` c ON c.customerId = o.FK_customerId
        		WHERE FK_vendorId=".$_SESSION['vendorId']." AND o.orderStatus= 1";
	        break;
	    case "!processed":
	        $sql = "SELECT o.*, c.customerEmail, p.productTitle FROM `Order` AS o 
					LEFT JOIN `Product` p ON p.productId = o.FK_productId
					LEFT JOIN `Customer` c ON c.customerId = o.FK_customerId
	        		WHERE FK_vendorId=".$_SESSION['vendorId']." AND o.orderStatus= 0";
	        break;  
	    case "":
	        $sql = "SELECT o.*, c.customerEmail, p.productTitle FROM `Order` AS o 
					LEFT JOIN `Product` p ON p.productId = o.FK_productId
					LEFT JOIN `Customer` c ON c.customerId = o.FK_customerId
	        		WHERE FK_vendorId=".$_SESSION['vendorId'];
	        break;
	    default:
	    	$sql = "SELECT o.*, c.customerEmail, p.productTitle FROM `Order` AS o 
					LEFT JOIN `Product` p ON p.productId = o.FK_productId
					LEFT JOIN `Customer` c ON c.customerId = o.FK_customerId
	    			WHERE FK_vendorId=".$_SESSION['vendorId'];
	        
	}
	$conn->connectToDatabase();
	$dataset = $conn->selectData($sql);
	return $dataset;
}

function getOrderByPaymentId($conn, $paymentId)
{

	$sql = "SELECT o.*, c.customerEmail, p.productTitle FROM `Order` AS o 
			LEFT JOIN `Product` p ON p.productId = o.FK_productId
			LEFT JOIN `Customer` c ON c.customerId = o.FK_customerId
			WHERE FK_vendorId=".$_SESSION['vendorId']." AND o.FK_paymentId=".$paymentId;
			
	$conn->connectToDatabase();
	$dataset = $conn->selectData($sql);
	return $dataset;
}
/* Function to display the update form for an item if it hasn't been processed*/
function displayUpdateForm($orderStatus,$orderId)
{
	if($orderStatus == 0){//Display for as order hasn't been processed
		echo "<form id='update-order-form'>";
			echo "<input type='hidden' name='orderId' value=".$orderId.">";
			echo "<button type='submit' class='btn-edit btn-sm'>";
				echo "<span class='glyphicon glyphicon-check'></span>";
			echo "</button>"; 
		echo "</form>";
		}else
			{
			echo "<span class='glyphicon glyphicon-ok'></span>";
			}
}


//Check if a vendor session exists and if no redirect to login
if(!(isset($_SESSION['vendorId']))){
	header(header('Location: http://'.$_SERVER['HTTP_HOST'].'/FoodJackal/login'));
	}

include_once("../../classes/security/timeago.php"); // Include the class library
include('../../classes/database/database-connect.php');// Database Functionality
$timeAgoObject = new convertToAgo;
$conn = new Database();

/* Get sort/filter value */
if(isset($_GET['sort']))
{
	$sort=$_GET['sort'];
}else
	{
		$sort = "";
	}
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Graham Murray" >

    	<!-- Customer CSS-->
        <link type="text/css" rel="stylesheet" href="../../css/custom.css"/>
        <title>Food Jackal - Order Management</title>

        <style type="text/css">
        	.filter-select{padding:6px;} 
        	.btn-edit{background-color:#2780E3;}
        	
        	/* Scroll Bar for Table Page Specific */
			.scroll-pane,
			.scroll-pane-arrows{width: 100%; height: 350px; overflow: auto;}
			.horizontal-only{height: auto; max-height: 400px;}
        </style>


	<?php include('../../includes/links.php');?>

	<!-- Ajax form to delete record -->
	<script type="text/javascript">
		$(document).ready(function ()
        {

            $(document).on('submit', '#update-order-form', function ()
            {
                var data = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: 'order-status-update.php',
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
	


	<style type="text/css">
		table td, th {
   			text-align: center;   
			}
	</style>

    </head>



    <body>

        <!-- Navigation -->
        <?php include('../../includes/header.php');?>

        <!-- Page Content -->
        <div class="container top-margin-content">
       		<h2 class="lead center-text"><?php echo $_SESSION['vendorName'];?>'s Orders</h2>
            <div class="row">
                <div class="col-md-6 col-lg-6">
                	<form method="GET" enctype="multipart/form-data" action="">
            			<select class="filter-select" name="sort">
            					<option value="">None</option>
		                        <option value="dateDesc">Order by Time/Date Descending</option>
		                        <option value="dateAsc">Order by Time/Date Ascending</option>
		                        <option value="processed">Orders Processed</option>
		                        <option value="!processed">Orders not Processed</option>
			            </select>
			            <input type="submit" value="Filter" class="btn btn-default filter-btn"/>
                	</form>
                </div>

                <div class="col-md-6 col-lg-6">
	                <p>Orders that appear in red haven't been collected, once an order has been collected, select  
	                &nbsp;&nbsp;<span class='glyphicon glyphicon-check'></span>&nbsp;&nbsp;to mark an order as processed</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-lg-12 scroll-pane">
                	<table class="table table-striped table-hover table-responsive">
                		<thead>
	                		<tr>
	            				<th class="ol-md-1 col-lg-1 align-center">Order ID</th>
	            				<th class="ol-md-1 col-lg-1 align-center">Product</th>
	            				<th class="col-md-2 col-lg-2 align-center">Customer Email</th>
	            				<th class="align-center">Order Message</th>
	            				<th class="col-md-2 col-lg-2 align-center">Time</th>
	            				<th class="col-md-2 col-lg-2 align-center">Status Update</th>
	                		</tr>
                		</thead>
                		<tbody>
		                	<?php
		                		if(isset($_GET['payment'])){
		                			$dataset = getOrderByPaymentId($conn, $_GET['payment']);
		                			
			                		if ($dataset->num_rows > 0) {

			    	 					// output data of each row
			    	 					while($row = $dataset->fetch_assoc()) {

			    	 					/* Set class for tr based on order status */
			    	 					if($row['orderStatus'] == 0)
			    	 					{
			    	 						$class="danger";
			    	 					}else{
			    	 						$class="success";
			    	 						}
			    	 					/* Code for making time ago */
	        							$convertedTime = ($timeAgoObject -> convert_datetime($row["orderDate"])); // Convert Date Time
	        							$when = ($timeAgoObject -> makeAgo($convertedTime));

			         						echo "<tr class='".$class."'>";
				         						echo "<td>".$row['orderId']."</td>";
				         						echo "<td>".base64_decode($row['productTitle'])."</td>";
				         						echo "<td>".$row["customerEmail"]."</td>";
				         						echo "<td>".base64_decode($row["orderMessage"])."</td>";
				         						echo "<td>".$when."</td>";
				         							echo "<td>";
				         								displayUpdateForm($row['orderStatus'],$row['orderId']);
				         							echo "</td>";
			         						echo "</tr>";
			     						}
									} else {
										echo "<p>There's no products in you listing</p>";
										}
		                			
		                		}else{
		                			
		                				$dataset = loadOrders($conn, $sort);
				                		if ($dataset->num_rows > 0) {

				    	 					// output data of each row
				    	 					while($row = $dataset->fetch_assoc()) {

				    	 					/* Set class for tr based on order status */
				    	 					if($row['orderStatus'] == 0)
				    	 					{
				    	 						$class="danger";
				    	 					}else{
				    	 						$class="success";
				    	 						}
				    	 					/* Code for making time ago */
		        							$convertedTime = ($timeAgoObject -> convert_datetime($row["orderDate"])); // Convert Date Time
		        							$when = ($timeAgoObject -> makeAgo($convertedTime));

				         						echo "<tr class='".$class."'>";
					         						echo "<td>".$row['orderId']."</td>";
					         						echo "<td>".base64_decode($row['productTitle'])."</td>";
					         						echo "<td>".$row["customerEmail"]."</td>";
					         						echo "<td>".base64_decode($row["orderMessage"])."</td>";
					         						echo "<td>".$when."</td>";
					         							echo "<td>";
					         								displayUpdateForm($row['orderStatus'],$row['orderId']);
					         							echo "</td>";
				         						echo "</tr>";
				     						}
										}else{
											echo "<p>There's no products in you listing</p>";
											}
		                			
		                			}
		                	?>
	                	</tbody>
                	</table>
                </div>
                <div class=" result col-md-6 col-md-offset-3 text-center">
                		<!-- Return From Ajax Displayed here -->
                </div>
            </div>
        </div>
        <div class="container">
            <hr class="line">
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
