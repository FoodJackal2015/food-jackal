<?php
/*
 * @category  Search
 * @file      search.php
 * @date      12/11/15
 * @author    Conor Thompson
 * @copyright Copyright (c) 2015
*/

session_start();
//Ensure the search key param is set
if(!isset($_REQUEST['key']))
{
	header("Location: ../index.php");
}

include('../classes/database/database-connect.php');
$conn = new Database;

/* Retrive vendors from Database */
function getVendorBySearchKey($conn, $key)
{
    $conn->connectToDatabase();
    $sql = 'SELECT * FROM `Vendor` WHERE `vendorName` LIKE "%'.$key.'%" ';
    $dataset = $conn->selectData($sql);
    $conn->closeConnection();

    return $dataset;
}
function trimText($inputText)
{
    //Code to stem description
    return strlen($inputText) > 100 ? substr($inputText,0,100)."..." : $inputText;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Conor Thompson">
    <link type="text/css" rel="stylesheet" href="../css/custom.css"/>
    <title>Food Jackal - Stores</title>
    <!-- Hotlinks for scripts-->
    <?php include('../includes/links.php'); ?>

</head>

<body>
    <!-- Navigation -->
    <?php include_once('../includes/header.php');?>

    <!-- Page Content -->
    <div class="container top-margin-content">
        <div class="row">
        
			<div class="col-md-12 text-center">
			     <h1>Search Results for <i class"lead"><?php echo $_REQUEST['key'];?></i> </h1>
			</div>
	            <?php
	            if(isset($_REQUEST['key']) && !(empty($_REQUEST['key'])))
	            {
	                /* Load vendors */ 
	                $dataset = getVendorBySearchKey($conn, $_REQUEST['key']);
	                echo '<div class="row">';
		                echo '<div class="col-lg-12 text-center">';
		                	echo '<h3><i>'.$dataset->num_rows.'</i> results found</h3';
		                echo '</div>';
	                echo '</div>';
	                /* Out put vendors for the search key */    
	                if($dataset->num_rows > 0)
	                {	
	                	echo '<div class="col-lg-12 col-md-12">';
	                    while($row = $dataset->fetch_assoc())
	                    {
	                        
	                        //Code to get vendor logo if there's no logo it'll display a default image
	                        if($row['vendorLogoImageName'] == null)
	                        {
	                            $image = '../images/misc/noimage.png';//Default Image
	                        }else{
	                            $image = '../images/Vendor/'.$row['vendorFolderName'].'/'.$row['vendorLogoImageName'];
	                            }

	                        echo '<a class="vendor-link" href="../cart/view-products.php?vid='.$row['vendorId'].'">';
	                        echo    '<div class="col-xs-6  col-sm-6 col-md-3 col-lg-3">';
	                        echo        '<div class="thumbnail vendor-thumbnail">';
	                        echo            '<img class="img-responsive" style="height:150px;" src="'.$image.'" alt="'.$row['vendorName'].' Logo">';
	                        echo            '<div class="caption-full">';
	                        echo                '<h4 class="text-center"><a  href="../cart/view-products.php?vid='.$row['vendorId'].'">'.$row['vendorName'].'</a></h4>';
	                        echo                '<p class="text-center">'.trimText(base64_decode($row['vendorDescription'])).'</p>';
	                        echo            '</div>';
	                        echo        '</div>';
	                        echo    '</div>';
	                        echo '</a>';;
	                    }
	                    echo '</div>';
                	}else{
	                        echo '<p>No results match your query</p>';
	                    }
	            }else{
	                echo '<script type="text/javascript"> window.location = "../index.php"</script>';
	                }
	            ?>
        </div>
	</div>
    <!-- /.container -->

    <div class="container">
        <hr>
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Food Jackal 2015</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>

