<?php
/*
 * @category  Push data to database
 * @package   update account
 * @file      update-details.php
 * @data      02/11/15
 * @author    Graham Murray <x13504987@student.ncirl.ie>
 * @copyright Copyright (c) 2015
*/
//Includes
require_once('../../../classes/security/validation.php');
require_once('../../../classes/database/database-connect.php');

session_start();
$conn = new Database;
$validate = new Validation;

function updateVendor($vendorArr, $conn)
{
	if(is_array($vendorArr) && !is_null($vendorArr))
	{
		$sql = "UPDATE Vendor SET vendorName = '$vendorArr[companyName]',
								  vendorAddressLine1 = '$vendorArr[addressLine1]',
							      vendorAddressLine2 = '$vendorArr[addressLine2]',
							      vendorAddressLine1 = '$vendorArr[addressLine1]',
							      vendorCity = '$vendorArr[city]',
							      vendorTelephone = '$vendorArr[phone]',
							      vendorDescription = '$vendorArr[description]'
							  WHERE vendorId = ".$_SESSION['vendorId'];

		$conn->connectToDatabase();
		return $result = $conn->insertData($sql);//Return true or false for success
		$conn->closeConnection();


	}else{
		return false;
		}
}

if(isset($_POST['companyName'])  && isset($_POST['addressLine1']) && isset($_POST['addressLine2']) && isset($_POST['city']) && isset($_POST['phone']) && isset($_POST['description']) && isset($_POST['category']) && isset($_SESSION['vendorId'])) {
	$vendor = array();//Array to hold vendor details from form to be passed into updateVendor
	$vendor['companyName'] = $_POST['companyName'];
	$vendor['addressLine1']  = $_POST['addressLine1'];
	$vendor['addressLine2']  = $_POST['addressLine2'];
	$vendor['city']  = $_POST['city'];
	$vendor['phone']  = $_POST['phone'];
	$vendor['description'] = base64_encode($_POST['description']);
	$vendor['category']  = $_POST['category'];

	$errors = array();//Array to hold error messages
	




	/* Server Side Validation performed here */	
		
		/*Check category*/
		if(empty($vendor['category'])){
			array_push($errors, "Category Error.");
		}
		/* */
		if(empty($vendor['description'])){
			array_push($errors, "Description can't be empty.");
		}
		
		
		//Check if phone number is valid
		if(!$validate->checkIrishLandline($vendor['phone']) || empty($vendor['phone'])){	
			array_push($errors, "Invalid Phone Number format. Use (00)0000000");
		}
		
		//Check if company name is null
		if(empty($vendor['companyName'])){
			array_push($errors, "Company Name can't be empty.");
		}		
		
		//Check if addressline 1 or 2 is empty
		if(empty($vendor['addressLine1']) || empty($vendor['addressLine2'])){
			array_push($errors, "Address can't be empty");
		}

		//Check if city is empty and is alpha
		if(!$validate->checkAlphaCharacter($vendor['city']) || empty($vendor['city'])){
			array_push($errors, "City must be only alpha characters");
		}			
	

		
	if(count($errors) < 1){	
	/* Call updateVendor() and return status to client */
	if(updateVendor($vendor, $conn))
	{
		echo '<span class="success center-text" style="margin-top:20px;">Account Successfully Updated</span>';
		echo '<script type="text/javascript">location.reload()</script>';
	}else{//Update Failed
		echo '<span class="error center-text" style="margin-top:20px;">Update Failed, please again</span>';
		}

	}else{//Print All the errors instead of the account summary
			echo '<div style="margin-top:20px;">';		
				for($i=0; $i < count($errors); $i++)//Loop through errors
				{		
					echo '<center>';
						echo '<span class="error">'.$errors[$i].'</span>';
						echo '<br/>';
					echo '</center>';
				}
			echo '</div>';

	     }

}else{
	header("Location:../options.php");//Bounce to control panel if file is requested direclty.
	exit();
	}
?>
