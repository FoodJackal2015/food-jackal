<?php
/*
 * @category  Customer Registration
 * @date      01/10/15
 * @author    Graham Murray <x13504987@student.ncirl.ie>
 * @copyright Copyright (c) 2015
 * @reference Angular JS Tutorial W3 Schools http://www.w3schools.com/angular/
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Graham Murray">
    <link rel="stylesheet" type="text/css" href="../../css/custom.css"/>

    <title>Food Jackal - Customer Registration</title>

	<?php include('../../includes/links.php');?>
        

	<!-- Ajax form submit -->
	<script type="text/javascript">	
		$(document).ready(function ()
    	{

	        $(document).on('submit', '#reg-form', function ()
	        {

	            var data = $(this).serialize();

	            $.ajax({
	                type: 'POST',
	                url: 'customer-post.php',
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

    <!-- Reset Form after submission -->
    <script type="text/javascript">
		function resetForm() {
		    document.getElementById("reg-form").reset();
		}
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
	</style>
	
</head>
<body>

    <!-- Navigation -->
    <?php include('../../includes/header.php');?>


    <!-- Page Content -->
    <div class="container top-margin-content">

    	<div class="row">
    		<h1 class="text-center">Registration</h1>
        </div>
        <div class="row">
            <p class="text-center">If you&apos;re a Vendor register here &nbsp;<span class="glyphicon glyphicon-hand-right"></span>&nbsp; <a href="../vendor/index.php">Vendor Registration</a></p>
    		<div class="col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
    			<form ng-app="myApp" method="post" id="reg-form" ng-controller="validateCtrl" name="myForm">
    				<br>
    				<label>First Name:</label>
    				<input type="text" 
    				class="form-control" 
    				name="fname" 
    				ng-model="fname" 
    				required>
    				<span style="color:red" ng-show="myForm.fname.$dirty && myForm.fname.$invalid">
    					<span ng-show="myForm.fname.$error.required">Firstname is required.</span>
    				</span>
    				
    				<br>

    				<label>Last Name:</label>
    				<input type="text" 
    				class="form-control" 
    				name="lname" 
    				ng-model="lname" 
    				required>
    				<span style="color:red" ng-show="myForm.lname.$dirty && myForm.lname.$invalid">
    					<span ng-show="myForm.lname.$error.required">Lastname is required.</span>
    				</span>

    				<br>

    				<label>Address:</label>

    				<input type="text" 
    				class="form-control" 
    				name="address" 
    				ng-model="address" 
    				required>
    				<span style="color:red" ng-show="myForm.address.$dirty && myForm.address.$invalid">
    					<span ng-show="myForm.address.$error.required">Address is required.</span>
    				</span>
    				
    				<br>

    				<label>Date of Birth:</label>

    				<input type="text" 
    				class="form-control" 
    				placeholder="yyyy-mm-dd" 
    				name="dob" 
    				ng-model="dob" 
    				ng-pattern='/^[0-9]{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])/' 
    				required>
    				<span style="color:red" ng-show="myForm.dob.$dirty && myForm.dob.$invalid">
    					<span ng-show="myForm.dob.$error.required">D.O.B is required.</span>
    					<span ng-show="myForm.dob.$error.">Invalid date format.</span>
    				</span>

    				<br>
    				
    				<label>E-mail:</label>

    				<input type="email" 
    				class="form-control" 
    				name="email" 
    				ng-model="email" 
    				required>
    				<span style="color:red" ng-show="myForm.email.$dirty && myForm.email.$invalid">
    					<span ng-show="myForm.email.$error.required">Email is required.</span>
    					<span ng-show="myForm.email.$error.email">Invalid email address.</span>
    				</span>

    				<br>

    				<label>Password:</label>
    				<input type="password" 
    				class="form-control" 
    				name="pw1" 
    				ng-model="pw1" 
    				required>
    				<span style="color:red" ng-show="myForm.pw1.$dirty && myForm.pw1.$invalid">
    					<span ng-show="myForm.pw1.$error.required">Password is required.</span>
    				</span>

    				<br>

    				<label>Confirm Password:</label>
    				<input type="password" 
    				class="form-control" 
    				name="pw2" 
    				ng-model="pw2" 
    				required>
    				<span style="color:red" ng-show="myForm.pw2.$dirty && myForm.pw2.$invalid">
    					<span ng-show="myForm.pw2.$error.required">Password Confimation is required.</span>
    				</span>

    				<br>

    				<input type="submit" value="Register" class="btn btn-success" ng-disabled="myForm.fname.$dirty && myForm.fname.$invalid || 				myForm.lname.$dirty && myForm.lname.$invalid || myForm.address.$dirty && myForm.address.$invalid || myForm.email.$dirty && 				myForm.email.$invalid || myForm.dob.$dirty && myForm.dob.$invalid || myForm.pw1.$dirty && myForm.pw1.$invalid
    				|| myForm.pw2.$dirty && myForm.pw2.$invalid" >              
    			</form>		   

    			<!-- DIV to display data after ajax function -->
    			<div  class="result">
    				<!-- Form submission results displayed here-->
    			</div>
    		</div>
    	</div>
    </div>

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
		    $scope.fname = '';
		    $scope.lname = '';
		    $scope.address = '';
		    $scope.dob= null;
		    $scope.email = '';
		    $scope.pw1 = '';
		    $scope.pw2 = '';

		});
	</script>

</body>
</html>
