<?php
/*
 * @category  Vendor product admin for product CRUD Functionality
 * @package   product/admin
 * @file      list.php
 * @data      26/10/15
 * @author    Graham Murray <graham@graham-murray.com>
 * @copyright Copyright (c) 2015
*/
session_start();

//Check if a vendor session exists and if no redirect to login
if(!(isset($_SESSION['vendorId']))){
	header(header('Location: http://'.$_SERVER['HTTP_HOST'].'/FoodJackal/login'));
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

     

        <title>Food Jackal - Vendor Product Listings</title>


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

	<?php include('../../includes/links.php')?>
        
	<!-- Form Redirect -->
	<script type="text/javascript">
		function loginRedirect()
		{
			window.location("http://cloud.graham-murray.com/FoodJackal/login");
		}
	</script>

	<!-- Ajax form to delete record -->
	<script type="text/javascript">
	$(document).ready(function ()
            {

            	
            	
            	
	                $(document).on('submit', '#delete-form', function ()
	                {

	                   var r = confirm("Are you sure you want to remove this product?");
            			if(r == true)
            			{
	                    //var fn = $("#fname").val();
	                    //var ln = $("#lname").val();

	                    //var data = 'fname='+fn+'&lname='+ln;

	                    var data = $(this).serialize();


	                    $.ajax({
	                        type: 'POST',
	                        url: 'delete.php',
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
	                	}
	                });
            	
            });
		
        </script>
	

	<?php
	/* Code to get all products for the logged in vendor */
	include('../../classes/database/database-connect.php');
	$vendorId = $_SESSION['vendorId']; //This will be $_COOKIE['vendorId']; once login session working
	$connection = new Database();
	$connection->connectToDatabase();
	$sql = "SELECT * FROM Product WHERE vendorId='$vendorId' AND ProductStatus=1";//Only product with status 1 as vendor removed any status with 0
	$dataset = $connection->selectData($sql);
	?>

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
            <div class="row">
            	
            	<h2 class="lead center-text"><?php echo $_SESSION['vendorName'];?>'s Product Listing</h2>
                
                <div class="col-md-12 col-lg-12">
                	<table class="table table-striped table-hover ">
                		<thead>
	                		<tr>
	            				<th class=" align-center">Product Title</th>
	            				<th class="col-md-2 col-lg-2 align-center">Price</th>
	            				<th class="col-md-3 col-lg-2 align-center">Date Added</th>
	            				<th>Edit</th>
	            				<th>Delete</th>
	                		</tr>
                		</thead>
                		<tbody>
		                	<?php
		                		if ($dataset->num_rows > 0) {
		    	 					// output data of each row
		    	 					while($row = $dataset->fetch_assoc()) {

		         						echo "<tr class='active'> <td>".base64_decode($row["productTitle"])."</td><td>&euro; ".$row["productPrice"]."</td><td>".$row["productAddedDate"]. "</td><td><form id='edit-form' action='update/index.php' method='post'><input type='hidden' name='productId' value=".$row['productId']." /> <input type='hidden' name='productTitle' value=".$row['productTitle']." /><input type='hidden' name='productPrice' value=".$row['productPrice']." /><input type='hidden' name='productDescription' value=".$row['productDesciption']." /> <button type='submit' formaction='update/index.php' class='btn-edit btn-sm'><span class='glyphicon glyphicon-pencil'></span></button> </form></td>  <td><form id='delete-form'><input type='hidden' name='productId' value=".$row['productId']." /> <button type='submit' class='btn-delete btn-sm'><span class='glyphicon glyphicon-remove'></span></button> </form></td></tr>";
		     						}
								} else {
									echo "<p>There's no products in you listing</p>";
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
        <!-- /.container -->


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
        <!-- /.container -->


    </body>

</html>
