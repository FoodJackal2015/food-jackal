<?php
/*
 * @category  Edit Vendor Account Front End
 * @package   edit account
 * @file      edit.php
 * @date      05/11/15
 * @author    Graham Murray <x13504987@student.ncirl.ie>
 * @copyright Copyright (c) 2015
 * @reference AngularJS http://w3schools.com/angular
*/

session_start();
if(!(isset($_SESSION['vendorId'])))
{
	header("Location: ../../../login/index.php");
}

include_once('../../../classes/database/database-connect.php');
$conn = new Database;

	/* Retrive categories from the database */
    function fetchCategories($conn)//Conn is the database object we instantiated
    {
        $conn->connectToDatabase();
        $sqlCategory = 'SELECT * FROM Category';
        $categoryDataset = $conn->selectData($sqlCategory);
        $conn->closeConnection();
        
        //Add fetched categories to array
        $tempArr = array();//Temp array to stage data before adding arrays within arrays
        $categories = array();
        if ($categoryDataset->num_rows > 0) 
        {
            while($row = $categoryDataset->fetch_assoc()) 
            {
                $tempArr['categoryId']= $row['categoryId'];
                $tempArr['categoryName'] = $row['categoryName'];
                
                $categories[] = $tempArr;//Add tempArray to categories array
            }

         }else{
                $categories = null;
                }

        return $categories;
    }
    function loadVendor($conn)
    {
    	$sql = "SELECT * FROM Vendor WHERE vendorId=".$_SESSION['vendorId'];
		$conn->connectToDatabase();
		$dataset = $conn->selectData($sql);
		$conn->closeConnection();

		$vendor = array();//Array to hold vendor details
		if($dataset->num_rows == 1)
		{
			while($row = $dataset->fetch_assoc())
			{
	        	$vendor['vendorName'] = $row['vendorName'];
	        	$vendor['vendorAddressLine1'] = $row['vendorAddressLine1'];
	        	$vendor['vendorAddressLine2'] = $row['vendorAddressLine2'];
	        	$vendor['vendorCity'] = $row['vendorCity'];
	        	$vendor['vendorTelephone'] = $row['vendorTelephone'];
	        	$vendor['vendorDescription'] = $row['vendorDescription'];
	     	}

	     	
		}
		return $vendor;//Return array of vendor details
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
        <link type="text/css" rel="stylesheet" href="../../../css/custom.css"/>

        <title>Food Jackal - Update Details</title>

		<?php include('../../../includes/links.php');?>
        
	
		<!-- Ajax form submit -->
		<script type="text/javascript">
			$(document).ready(function ()
		    {
				$(document).on('submit', '#pass-update-form', function ()
		        {
		            var data = $(this).serialize();
		            $.ajax({
		                type: 'POST',
		                url: 'reset-password.php',
		                data: data,
		                success: function (data)
		                {         
		                    $(".passResult").fadeIn(500).show(function ()
		                    {
		                        $(".passResult").html(data);
		                    });
		                    
		                }//Close Success
		            });
		            return false;
		        });

				$(document).on('submit', '#update-account-form', function ()
		        {
		            var data = $(this).serialize();
		            $.ajax({
		                type: 'POST',
		                url: 'update-details.php',
		                data: data,
		                success: function (data)
		                {         
		                    $(".editResult").fadeIn(500).show(function ()
		                    {
		                        $(".editResult").html(data);
		                    });
		                    
		                }//Close Success
		            });
		            return false;
		        });
		    });
	    </script>	
	
    </head>

    <body>

        <!-- Navigation -->
        <?php include('../../../includes/header.php');?>

        <!-- Page Content -->
        <div class="container top-margin-content">
            <div class="row">
                <div class="col-md-6" style="border-right:1px solid lightgrey;">
                	<h2 class="center-text">Edit Account Details</h2>
                    <form ng-app="myApp" style="margin-top:-20px;" method="post" id="update-account-form" ng-controller="validateCtrl" name="myForm">
                        <br>
                        <br>                           
						<label>Company Name:</label>
			                        <input type="text" 
							class="form-control"
							placeholder="Spar"
							name="companyName" 
							ng-model="companyName" 
							required>
					     	<span style="color:red" ng-show="myForm.companyName.$dirty && myForm.companyName.$invalid">
						  		<span ng-show="myForm.companyName.$error.required">Company Name is required.</span>
						  	</span>
			                
			                <br>

			                <label>Address Line 1:</label>
			                <input type="text" 
							class="form-control" 
							name="addressLine1" 
							ng-model="addressLine1" 
							required>
						  <span style="color:red" ng-show="myForm.addressLine1.$dirty && myForm.addressLine1.$invalid">
						  	<span ng-show="myForm.addressLine1.$error.required">Address Line 1 is required.</span>
						  </span>

                         <br>

			            <label>Address Line 2:</label>
						<input type="text" 
							class="form-control" 
							name="addressLine2" 
							ng-model="addressLine2" 
							required>
						<span style="color:red" ng-show="myForm.addressLine2.$dirty && myForm.addressLine2.$invalid">
							<span ng-show="myForm.addressLine2.$error.required">Address Line 2 is required.</span>
						</span>
			            
			            <br>

			       		<label>City:</label>
						<input type="text" 
							class="form-control" 
							placeholder="Dublin" 
							name="city" 
							ng-model="city"  
							required>
						<span style="color:red" ng-show="myForm.city.$dirty && myForm.city.$invalid">
							<span ng-show="myForm.city.$error.required">City is required.</span>
						</span>

			            <br>

			            <label>Phone Number:</label>
						<input type="text" 
							class="form-control" 
							placeholder="(01)8372356" 
							name="phone" 
							ng-pattern="/^\s*(\(?\s*\d{1,4}\s*\)?\s*[\d\s]{5,10})\s*$/"
							ng-model="phone"  
							required>
						<span style="color:red" ng-show="myForm.phone.$dirty && myForm.phone.$invalid">
							<span ng-show="myForm.phone.$error">Invalid Phone Number Format.</span>
						</span>

			            <br>


						<label>Company Description:</label>
						<textarea 
							id="description" 
							class="form-control" 
							rows ="10"
							ng-model="description"  
							name="description"
							placeholder="Enter a small description of what foods your company provides. Roughly 20-40 words."
							required>
						</textarea>
			            <span style="color:red" ng-show="myForm.description.$dirty && myForm.description.$invalid">
							<span ng-show="myForm.description.$error.required">A brief description is required.</span>
						</span>


			            <br>

			            <label>Category:</label>
            			<select name="category" id="category">
				   			<?php 

			            		$catArr = fetchCategories($conn);
			            		foreach ($catArr as $key => $val)
		                        {
		                            echo '<option value="'.$val['categoryId'].'">'.$val['categoryName'].'</option>';
		                        }
				            ?>
			            </select>		                       
						<br>

						<input type="submit" value="Update" class="btn btn-success" ng-disabled="myForm.companyName.$dirty && myForm.companyName.$invalid || myForm.addressLine1.$dirty && myForm.addressLine1.$invalid || myForm.addressLine2.$dirty && myForm.addressLine2.$invalid || myForm.city.$dirty && myForm.city.$invalid || myForm.phone.$dirty && myForm.phone.$invalid || myForm.description.$dirty && myForm.description.$invalid" >              
                    </form>		   
				
					<!-- DIV to display data after ajax function -->
			    	<div  class="editResult">
			    		<!-- Form submission results displayed here-->
			    	</div>
                </div>

                <div class="col-md-6">
                	<h2 class="center-text">Change Password</h2>
                    <form ng-app="appPassword" style="margin-top:-20px;" method="post" id="pass-update-form" ng-controller="validateCtrlPassword" name="PasswordChangeForm">
                        <br>
                        <br>
                        <label>Old Password:</label>
			            <input type="password" 
							class="form-control" 
							name="oldPw" 
							ng-model="oldPw"
							id="passphrase1"
							required>
						<span style="color:red" ng-show="PasswordChangeForm.oldPw.$dirty && PasswordChangeForm.oldPw.$invalid">
							<span ng-show="PasswordChangeForm.oldPw.$error">Old Password is required.</span>
						</span>
                        <br>
			            <label>Password:</label>
			            <input type="password" 
							class="form-control" 
							name="pw1" 
							ng-model="pw1"
							id="passphrase1"
							ng-minlength="6" 
							required>
						<span style="color:red" ng-show="PasswordChangeForm.pw1.$dirty && PasswordChangeForm.pw1.$invalid">
							<span ng-show="PasswordChangeForm.pw1.$error">Password is required.</span>
							<span ng-show="PasswordChangeForm.pw1.$error.minlength">Password must be at least 6 characters long.</span>
						</span>

			            <br>

			            <label>Confirm Password:</label>
			            <input type="password" 
							class="form-control" 
							name="pw2" 
							ng-model="pw2"
							id="passphrase2"
							required>
						<span style="color:red" ng-show="PasswordChangeForm.pw2.$dirty && PasswordChangeForm.pw2.$invalid">
							<span ng-show="PasswordChangeForm.pw2.$error.required">Password Confimation is required.</span>
						</span>
							                       
						<br>

						<input type="submit" value="Change Password" class="btn btn-success" ng-disabled="PasswordChangeForm.pw1.$dirty && PasswordChangeForm.pw1.$invalid || PasswordChangeForm.pw2.$dirty && PasswordChangeForm.pw2.$invalid || PasswordChangeForm.oldPw.$dirty && PasswordChangeForm.oldPw.$invalid">              
                    </form>		   
				
					<!-- DIV to display data after ajax function -->
			    	<div  class="passResult">
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

	<?php
		$vendor = loadVendor($conn);

		if(is_null($vendor))
		{
			header("Location: ../options.php");
		}else{//Not null so populate variables to out in angularjs controller
				
	
			}
	?>

	<script>
		/* For the scope of the app controller set values = to the retrieved values from loadVendor*/
		var app = angular.module('myApp', []);
		app.controller('validateCtrl', function($scope) {
		    $scope.companyName = '<?php echo $vendor["vendorName"] ; ?>';
		    $scope.addressLine1 = '<?php echo $vendor["vendorAddressLine1"] ; ?>';
		    $scope.addressLine2 = '<?php echo $vendor["vendorAddressLine2"] ; ?>';
		    $scope.city = '<?php echo $vendor["vendorCity"] ; ?>'
		    $scope.phone = '<?php echo $vendor["vendorTelephone"] ; ?>'
		    $scope.description = '<?php echo base64_decode($vendor["vendorDescription"]) ; ?>';
		});

		var appPass = angular.module('appPassword', []);
		appPass.controller('validateCtrlPassword', function($scope) {
		    $scope.oldPw = '';
		    $scope.pw1 = '';
		    $scope.pw2 = '';

		});

		/* Need to bootstrap appPassword as there is two ng-app directives */
		angular.element(document).ready(function() {
    	angular.bootstrap(document.getElementById("pass-update-form"),['appPassword']);
  	});
	</script>


    </body>

</html>
