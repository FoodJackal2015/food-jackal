<?php
/*
 * @category  Image upload for vendor logo
 * @file      logo-image-upload.php
 * @data      05/11/15
 * @author    Graham Murray <x13504987@student.ncirl.ie>
 * @copyright Copyright (c) 2015
 * @reference I learned how to use $_FILES[] on W3 Schools http://www.w3schools.com/php/php_file_upload.asp
*/
session_start();

/* Check Vendor is logged in*/
if(!isset($_SESSION['vendorId']) || empty($_SESSION['vendorId']))
{	
	header("Location: ../../../login/index.php");
}

require_once('../../../classes/database/database-connect.php');
$conn = new Database;

/* Set logo name on the database */
function setLogoPointer($conn, $filename)
{
	$vendorId = $_SESSION['vendorId'];
	$conn->connectToDatabase();
	$sql = 'UPDATE Vendor SET vendorLogoImageName = "logo.png" WHERE vendorId = '.$vendorId.' ';
	if(!($conn->insertData($sql)))
	{
		return false;
	}else
		{
		return true;
		}
}

if (isset($_FILES["file"]["type"])) {
    $validextensions = array("png");
    $temporary = explode(".", $_FILES["file"]["name"]);
    $file_extension = end($temporary);
    $storage_path = "../../../images/Vendor/".$_SESSION['vendorFolderName'];//Path to where vendors folders are
    
    if ((($_FILES["file"]["type"] == "image/png")) && ($_FILES["file"]["size"] < 500000) && in_array($file_extension, $validextensions)) {
        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";//Return Errors
        }
        if(!file_exists($storage_path)){//Checks to ensure image storage location exist
			die("<p>Error: Ref Path Ref 404. Contact Customer Support</p>");
        }else {


        		$_FILES['file']['name'] = "logo.png";//Rename the image
        		

        		if(!(setLogoPointer($conn,$_FILES['file']['name'])))//Update pointer to image on db, die if fails
        		{
        			die("<p id='invalid'>Error: Ref db pointer</p>");
        		}else{
        			$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
	                $targetPath = $storage_path."/" . $_FILES['file']['name']; // Target path where file is to be stored
	                move_uploaded_file($sourcePath, $targetPath); // Moving Uploaded file
                    $_SESSION["vendorLogoImageName"] = $_FILES['file']['name'];
	                echo "<span id='success'>Image Uploaded Successfully</span><br/>";
	                echo '<script type="text/javascript">location.reload()</script>';
        			}
            }
        
    }else{
        echo "<span id='invalid'>Error: File must be png, max size 500Kb<span>";
    	 }
}//Close test to ensure file is set
?>
