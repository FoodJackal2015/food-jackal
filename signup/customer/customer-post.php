<?php
/*
 * @category  Customer Registration
 * @date      02/10/15
 * @author    Graham Murray <x13504987@student.ncirl.ie>
 * @copyright Copyright (c) 2015
*/

//Includes
include('../../classes/security/validation.php');
include('../../classes/database/database-connect.php');

$connection = new Database;
$validate = new Validation;

if($_POST){
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$address = $_POST['address'];
	$dob = $_POST['dob'];
	$email = $_POST['email'];
	$pass1 = $_POST['pw1'];
	$pass2 = $_POST['pw2'];


	$errors = array();//Array to hold error messages
?>	
	<?php 
		/* Server Side Validation performed here */
		
	
		/* Check if email already exists in database*/
		$emailExist= false;		
		
		$statement = 'SELECT customerEmail FROM Customer';
		//Select Query
		$connection->connectToDatabase();//Connect to database
		$dataset = $connection->selectData($statement);
	
		


		if ($dataset->num_rows > 0) {
	    	 
		// output data of each row
			while($row = $dataset->fetch_assoc()) {
		 		if($row["customerEmail"] == $email){
					$emailExist = true;
				}
			}	    	 	
		}
		
		if($emailExist){
			array_push($errors, "User ".$email." already exists.");
		}

		
		//Check if dob is valid format
		if(!$validate->validMySQLDate($dob) || empty($dob)){	
			array_push($errors, "Invalid Date Format. Please use yyyy-mm-dd");
		}
		
		//Check if firstname if alpha
		if(!($validate->checkAlphaCharacter($fname)) || empty($fname)){
			array_push($errors, "Firstname must only contain alpha characters");
		}		
		
		//Check if lastname if alpha
		if(!($validate->checkAlphaCharacter($lname)) || empty($lname)){
			array_push($errors, "Lastname must only contain alpha characters");
		}		
	
		//Check if passwords match or a greater than 6 character
		if($pass1 != $pass2 || empty($pass1)){
			array_push($errors, "Passwords do not match.");
		}else{
			$passhash = hash('sha256', $pass1);
		}
		//Check password size >= 6 
		if(strlen($pass1) < 6){
			array_push($errors, "Password must at least 6 character in length.");
		}

		
	if(count($errors) < 1){	
	?>
	<!-- Display the account summary after submission after server side validation -->
    	<table style="width:100%;"> 
		<tr>
			<center><th colspan="2">Welcome to Food Jackal <?php echo $fname;?></th></center>
		</tr>
		
		<tr>
			<center><th colspan="2">Account Summary</th></center>
		</tr>
		
		<tr>
			<td>First Name:</td>
			<td><?php echo $fname;?></td>	
		</tr>
		<tr>
			<td>Last Name:</td>
			<td><?php echo $lname;?></td>	
		</tr>
		<tr>
			<td>Date of Birth:</td>
			<td><?php echo $dob;?></td>	
		</tr>
		<tr>
			<td>Email Address:</td>
			<td><?php echo $email;?></td>	
		</tr>

		<tr>
			<td>Password:</td>
			<td>Securely Stored and Encrypted</td>	
		</tr>
	</table>
	<center>
		<h3> To setup your payment preferences go the the settings once logged in. </h3>
	</center>
   	
	<?php
	//Push data to the database 
	$insert = "INSERT INTO Customer( customerFname, customerLname, customerEmail, customerAddress, customerDOB, customerAccountCreation, customerPassword )VALUES ('$fname', '$lname', '$email', '$address','$dob', NOW( ) , '$passhash')";
	$connection-> insertData($insert);
	$connection->closeConnection();
	?>
	
	
	
	<?php
	}else{//Print All the errors instead of the account summary
		
		echo '<div style="margin-top:20px; border:1px solid white;">';		
		for($i=0; $i < count($errors); $i++){
			
			echo '<center><span class="error">'.$errors[$i].'</span></center><br>';
		}//Close for loop
		echo '<script type="text/javascript">resetForm()</script>';
		echo '</div>';
	     }


	?>
<?php	
}
?>
