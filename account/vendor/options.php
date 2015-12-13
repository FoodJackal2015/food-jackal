<?php
/*
 * @category  vendor control panel
 * @file      options.php
 * @data      11/11/15
 * @author    Graham Murray <graham@graham-murray.com>
 * @copyright Copyright (c) 2015
*/
session_start();

include_once("../../classes/database/database-connect.php");
$conn = new Database;


//Make sure its a vendor accessing page
if(!isset($_SESSION['vendorId'])){
	header("Location: ../../login/index.php");
  }
  
function getTotalRevenue($conn)
{
    $sql = "SELECT SUM(p.paymentPrice) AS 'Total'
            FROM `Payment` AS p 
            LEFT JOIN `Order` AS o ON o.FK_paymentId = p.paymentId
            WHERE o.FK_vendorId =".$_SESSION['vendorId'];

    $conn->connectToDatabase();
    $dataset = $conn->selectData($sql);
    
    foreach($dataset as $r)
    {
        $total = $r['Total'];
        
    }
    
    //Set default value if no orders made for the vendor
    if(!empty($total))
    {
      return $total;
    }else{
      return 0;
        }
}

function getProcessedOrders($conn)
{
    $sql = "SELECT COUNT(orderId) AS 'Total'
            FROM `Order`
            WHERE FK_vendorId =".$_SESSION['vendorId'];

    $conn->connectToDatabase();
    $dataset = $conn->selectData($sql);
    
    foreach($dataset as $r)
    {
        $total = $r['Total'];
        
    }
    return $total;
}

function getUnProcessedOrders($conn)
{
    $sql = "SELECT COUNT(orderId) AS 'Total'
            FROM `Order`
            WHERE orderStatus = 0 AND FK_vendorId =".$_SESSION['vendorId'];

    $conn->connectToDatabase();
    $dataset = $conn->selectData($sql);
    
    foreach($dataset as $r)
    {
        $total = $r['Total'];
        
    }
    return $total;
}

function getMostPopularProduct($conn)
{
    $sql = "SELECT productTitle
            FROM Product
          WHERE productId = (SELECT FK_productId FROM `Order` WHERE FK_vendorId=".$_SESSION['vendorId']." GROUP BY FK_productId LIMIT 1)
            ";

    $conn->connectToDatabase();
    $dataset = $conn->selectData($sql);
    
    if($dataset->num_rows > 0){//Ensure the vendor has orders
        foreach($dataset as $r)
        {

            return base64_decode($r['productTitle']);
            
        }
    }else{
        return "No Order Made";
        }
}


//Get data for pie chart
function getSalesProductData($conn)
{
  
    $rows = array();

    $sql = "SELECT p.productTitle AS 'Product', COUNT( o.FK_productId ) AS 'Sales'
            FROM `Order` AS o
            LEFT JOIN `Product` p ON p.productId = o.FK_productId
            WHERE o.FK_vendorId = ".$_SESSION['vendorId']."
            GROUP BY o.FK_productId";

    $conn->connectToDatabase();
    $dataset = $conn->selectData($sql);

    $rows[] = array('Product','Sales');
      /* Extract the information from $result */
      foreach($dataset as $r) {
      $rows[] = array((string) base64_decode($r['Product']),(int) $r['Sales']); 
    }

    return json_encode($rows);
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
    <link type="text/css" rel="stylesheet" href="../../css/image-upload-style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <title>FoodJackal | Control Panel</title>

    <!-- Image Upload Script -->
    <script src="../../javascript/image-upload-script.js"></script>
    <script src="../../javascript/drop-upload.js"></script>

    

    <?php include('../../includes/links.php');?>

    <link rel="stylesheet" type="text/css" href="../../css/vendor-dashboard.css">


    <!-- API to generate performance chart -->
    <!-- Reference https://developers.google.com/chart/interactive/docs/gallery -->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable(<?php echo getSalesProductData($conn);?>);

        var options = {
          subtitle: 'Product Sales Analysis',
          chartArea: {left:10,top:20,width:"100%",height:"100%"}
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>

  <body>

        <!-- Navigation -->
        <?php include('../../includes/header.php');?>

        <!-- Page Content -->
        <div class="container top-margin-content">
          
          <div class="row ">
          	<div class="col-md-12 text-center" style="margin-bottom:20px;">
            	<h1><?php echo $_SESSION['vendorName']?>'s Control Panel</h1>
            </div>

            <div class="col-md-1 text-center">


            </div>
            <div class="col-md-2 text-center">
        		<a href="./edit-account/edit.php">
            		<div class="thumbnail">
              			<span class="glyphicon glyphicon-edit glyphicon-big"></span>
              			<p>Edit Account</p>
              		</div>
          		</a>
            </div>

            <div class="col-md-2 text-center">
        		<a href="list.php">
              		<div class="thumbnail">
              			<span class="glyphicon glyphicon-eye-open glyphicon-big"></span>
              			<p>View Products</p>
              		</div>
          		</a>
            </div>

            <div class="col-md-2 text-center">
        		<a href="./add/index.php">
              		<div class="thumbnail">
              			<span class="glyphicon glyphicon-plus-sign glyphicon-big"></span>
              			<p>Add Products</p>
              		</div>
          		</a>
            </div>

            <div class="col-md-2 text-center">
        		<a href="view-order.php">
              		<div class="thumbnail">
              			<span class=" 	glyphicon glyphicon-qrcode glyphicon-big"></span>
              			<p>Manage Orders</p>
              		</div>
          		</a>
            </div>

            <div class="col-md-2 text-center">
        		<a href="view-payment.php">
              		<div class="thumbnail">
              			<span class="glyphicon glyphicon-euro glyphicon-big"></span>
              			<p>Payments</p>
              		</div>
          		</a>
            </div>
			</div><!-- /.row 1-->

			<div class="row thumbnail">
				<div class="col-md-6 text-center">
	        		<h2>Product Popularity</h2>
	        		<br>
	        		<div id="piechart">
	        			<!-- Chart Displayed Here -->
                <p>A chart will be displayed once customers order you products</p>
	        		</div>
            	</div>

            	<div class="col-md-5 col-md-offset-1 col-lg-5 col-lg-offset-1 text-center">
	        		<h2>Statistics</h2>
	        		<table class="table table-striped table-hover">
	        			<tbody>
	        				<tr>
	        					<td>Most Popular Product</td>
	        					<td><?php echo getMostPopularProduct($conn);?></td>
	        				</tr>

	        				<tr>
	        					<td>Unprocessed Orders</td>
	        					<td><?php echo getUnProcessedOrders($conn); ?></td>
	        				</tr>

	        				<tr>
	        					<td>Total Orders</td>
	        					<td><?php echo getProcessedOrders($conn); ?></td>
	        				</tr>

	        				<tr>
	        					<td>Revenue</td>
	        					<td>&euro;<?php echo number_format((float)getTotalRevenue($conn), 2, '.', '');?></td>
	        				</tr>
	        			</tbody>
	        		</table>
            	</div>
			</div><!-- /row2 -->

      <div class="row text-center">
          <h3>Logo Upload</h3>
          <br>
          <div class="col-md-4 col-md-offset-1 thumbnail thumbnail-current-logo" style="border-radius:10px;">
            <h4>Current Logo</h4>
            <br>
            <?php
              //Code to get vendor logo if there's no logo it'll display a default image
               if($_SESSION['vendorLogoImageName'] == null)
                    {
                        $image = '../../images/misc/noimage.png';//Default Image
                    }else{
                        $image = '../../images/Vendor/'.$_SESSION['vendorFolderName'].'/'.$_SESSION['vendorLogoImageName'];
                        }
            ?>
            <img class="img-responsive center-block" src="<?php echo $image; ?>" alt="Current Logo"/>
            <br>
            <br>
            <br>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-16">
            <div class="upload-section">
                <div class="main">
                  <hr style="border:none;">
                  <center>
                    <form id="uploadimage" action="" method="post" enctype="application/x-www-form-urlencoded">
                      <div id="image_preview"><img id="previewing" src="../../images/misc/noimagefound.jpg" /></div>
                        <hr id="line">
                      <div id="selectImage">
                        <label>Select Your Image</label><br/>
                        <input type="file" name="file" id="file" required />
                        <input type="submit" class="btn btn-success submit" value="Upload" />
                      </div>
                    </form>
                  </center>
                </div>
                 <img id="loading" class="img-responsive" src="../../images/misc/loading.gif" alt="Loading..."/>
                <div id="message"></div>
            </div>
          </div>
      </div><!-- /row3 -->

      </div><!-- /.container -->

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
