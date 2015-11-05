<?php
session_start();

//Check if a vendor session exists and if no redirect to login
if(!(isset($_SESSION['vendorId']))){
	header(header('Location: http://'.$_SERVER['HTTP_HOST'].'/FoodJackal/login'));
	}elseif (!isset($_POST['productId']) || !isset($_POST['productTitle']) || !isset($_POST['productPrice']) || !isset($_POST['productDescription'])) {
		header("Location: ../list.php");
		}else{
			$productId = $_POST['productId'];
			$productTitle = base64_decode($_POST['productTitle']);
			$productPrice = $_POST['productPrice'];
			$productDescription = base64_decode($_POST['productDescription']);
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

        <title>Food Jackal - Edit Product</title>


        

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

	<?php include('../../../includes/links.php')?>
        


	<!-- Ajax form submit -->
	<script type="text/javascript">
            
	
	$(document).ready(function ()
            {


                $(document).on('submit', '#update-form', function ()
                {

                    //var fn = $("#fname").val();
                    //var ln = $("#lname").val();

                    //var data = 'fname='+fn+'&lname='+ln;

                    var data = $(this).serialize();


                    $.ajax({
                        type: 'POST',
                        url: 'update-post.php',
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
	table, th, td {
	    border: 1px solid black;
	    border-collapse: collapse; 
	    margin-top:20px;
	}
	th, td {
	    padding: 5px;
	    text-align: center;
	}td{
		width:50%;
	}
	.error{
	color:red;	
	text-align:center;
	}
	.success{
	color:green;	
	text-align:center;
	}
	</style>
	
	
    </head>



    <body>

        <!-- Navigation -->
        <?php include('../../../includes/header.php');?>




        <!-- Page Content -->
        <div class="container" style="margin-top:80px">

        <div class="row">


         <h1 class="text-center">Update Product</h1>

        <div class="col-md-12">
	

            <form ng-app="myApp" method="post" id="update-form" ng-controller="validateCtrl" name="myForm">
            <br>
            <br>   
            <br>
            <br>
            <input type='hidden' name='productId' value="<?php echo $productId;?>"/>

			<label>Product Title:</label>
                <input type="text" 
				class="form-control"
				style="width:70%"
				name="productTitle" 
				ng-model="productTitle"
				placeholder="Chicken Wrap" 
				required>
			  <span style="color:red" ng-show="myForm.productTitle.$dirty && myForm.productTitle.$invalid">
			  	<span ng-show="myForm.productTitle.$error.required">Title is required.</span>
			  </span>
                        <br>

			<label>Price: &euro;</label>
				<input type="text" 
				class="form-control"
				style="width:20%" 
				name="productPrice" 
				ng-model="productPrice"
				placeholder="8.99"
				ng-pattern="/^[0-9]+([,.][0-9]+)?$/" 
				required>
			  <span style="color:red" ng-show="myForm.productPrice.$dirty && myForm.productPrice.$invalid">
			  	<span ng-show="myForm.productPrice.$error.required">A price is required</span>
			  	<span ng-show="myForm.productPrice.$error.required">Invalid Price format is 00.00 or 0.00 or 000.00</span>
			  </span>

            <br>

            <label>Item Description:</label>
			<textarea 
				id="description" 
				class="form-control" 
				rows ="10"
				ng-model="productDescription"  
				name="productDescription"
				placeholder="Enter a small description of the item"
				required>
			</textarea>
            <span style="color:red" ng-show="myForm.productDescription.$dirty && myForm.productDescription.$invalid">
				<span ng-show="myForm.productDescription.$error.required">A brief description is required.</span>
			</span>
            
            <br>

            	<input type="hidden" name="vendorId" value="<?php $_SESSION['vendorId'];?>">
				<input type="submit" value="Update" class="btn btn-success" ng-disabled="myForm.productTitle.$dirty && myForm.productTitle.$invalid || myForm.productPrice.$dirty && myForm.productPrice.$invalid || myForm.productDescription.$dirty && myForm.productDescription.$invalid">              
            </form>		   
				
				<!-- DIV to display data after ajax function -->
		    	<div  class="result text-center">
		    		<!-- Form submission results displayed here-->
		    	</div>
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
        <!-- /.container -->

	
	
	
	<script>
		var app = angular.module('myApp', []);
		app.controller('validateCtrl', function($scope) {
		    $scope.productTitle = '<?php echo $productTitle;?>';
		    $scope.productPrice = '<?php echo $productPrice;?>';
		    $scope.productDescription = '<?php echo $productDescription;?>';
		});

		
		
	</script>

    </body>

</html>
