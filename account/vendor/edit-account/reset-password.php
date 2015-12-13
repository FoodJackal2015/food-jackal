<?php
/*
 * @category  Change Vendor Password
 * @package   edit account
 * @file      reset-password.php
 * @date      05/11/15
 * @author    Graham Murray <x13504987@student.ncirl.ie>
 * @copyright Copyright (c) 2015
*/

//Check existing password
function checkExistingPass($oldPass, $conn)
{
	$oldPass = hash('sha256', $oldPass);//Hash input to compare with encrypted password stored in the database
	$sql = "SELECT vendorPassword FROM Vendor WHERE vendorId=".$_SESSION['vendorId'];
	$conn->connectToDatabase();
	$dataset = $conn->selectData($sql);
	$conn->closeConnection();

	if($dataset->num_rows == 1)
	{
		while($row = $dataset->fetch_assoc())
		{
        	 	if($row['vendorPassword'] == $oldPass)
        	 	{
        	 		return true;
        	 	}
     	}
	}
	return false;
}

//Update Password
function updatePass($Pass, $conn)
{
	$Pass = hash('sha256', $Pass);
	$sql = "UPDATE Vendor SET vendorPassword='$Pass' WHERE vendorId=".$_SESSION['vendorId'];
	$conn->connectToDatabase();
	return $result = $conn->insertData($sql);//Return true or false for success
	$conn->closeConnection();

}

if($_POST && isset($_POST['oldPw']) && $_POST['pw1'] && $_POST['pw2']){
	
	session_start();
	include('../../../classes/database/database-connect.php');

	$conn = new Database;

	$oldPass = $_POST['oldPw'];
	$Pass = $_POST['pw1'];
	$PassConfirm = $_POST['pw2'];

	$errors = array();//Array to hold error messages
	

	/* Server Side Validation performed here */

	//Check no fields are null
	if(empty($oldPass) || empty($Pass) || empty($PassConfirm)){
		array_push($errors, "Please Complete all fields.");
	}
	
	/*Check if old password existing password matches*/
	if(!(checkExistingPass($oldPass, $conn))){
		array_push($errors, "Existing password incorrect.");//Add Error
	}

	/* Check passwords match */
	if($Pass != $PassConfirm){
		array_push($errors, "Passwords don't match.");
	}
	
	
	/* Confirm size is >= 6 */
	if(strlen($Pass) < 6){	
		array_push($errors, "Password should be at least 6 characters.");
	}

		
	if(count($errors) < 1){

		if(updatePass($Pass, $conn))//Check if turn and set message
		{
			$message = "Password Successfully Updated";
		}else
			{
				$message = "Password Update Failed. Please try again.";
			}

		echo '<div style="margin-top:20px;">';		
				echo '<center>';
					echo '<span class="success center-text">'.$message.'</span>';
					echo '<script type="text/javascript">document.getElementById("pass-update-form").reset();</script>';
				echo '</center>';
		echo '</div>';
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
	}
?>
