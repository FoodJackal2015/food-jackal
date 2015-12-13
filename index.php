<?php
/*
 * @category  Homepage
 * @data      21/10/15
 * @author    Graham Murray <x13504987@student.ncirl.ie>
 * @copyright Copyright (c) 2015
 * @reference JScrollpane http://jscrollpane.kelvinluck.com/
*/

session_start();
include('./classes/database/database-connect.php');
$conn = new Database;
/* Connect to database and retrieve all vendors*/
$conn->connectToDatabase();
$sql = "SELECT v. *, p.productId
		FROM Vendor v
		LEFT JOIN Product p ON p.vendorId = v.vendorId
		WHERE p.productId IS NOT NULL
		GROUP BY p.vendorId";
$dataset = $conn->selectData($sql);

/* Function to load categories */
function loadCategories($conn)
{
    $conn->connectToDatabase();
    $sql = "SELECT c.*, COUNT(v.categoryId) AS catCount
			FROM Category c
			LEFT JOIN Vendor v ON c.categoryId=v.categoryId
			GROUP BY c.categoryId
			ORDER BY c.categoryName ASC";
    
    $temp = array();//Temp Array to prep data before pushing into $categories
    $categories = array();

    if($dataset = $conn->selectData($sql))
    {
        
        while($row = $dataset->fetch_assoc())
        {
            
            $temp['categoryId'] = $row['categoryId'];
            $temp['categoryName'] = $row['categoryName'];
            $temp['categoryCount'] = $row['catCount'];
            
            array_push($categories, $temp);
        }
    }
    return $categories;
}

//Load vendors by category
function loadVendorByCategory($conn,$catId)
{
	$conn->connectToDatabase();
    $sql = "SELECT v. *, p.productId
			FROM Vendor v
			LEFT JOIN Product p ON p.vendorId = v.vendorId
			WHERE p.productId IS NOT NULL AND v.categoryId = ".$catId."
			GROUP BY p.vendorId";
    $dataset = $conn->selectData($sql);
    
    outputVendor($dataset);
}
//Output each vendor
function outputVendor($dataset)
{
	if($dataset->num_rows > 0)
	{
        while($row = $dataset->fetch_assoc())
        {
            //Code to stem description
            $longDescription = base64_decode($row['vendorDescription']);
            $shortDescription = strlen($longDescription) > 100 ? substr($longDescription,0,100)."..." : $longDescription;
            
            //Code to get vendor logo if there's no logo it'll display a default image
            if($row['vendorLogoImageName'] == null)
            {
                $image = './images/misc/noimage.png';//Default Image
            }else{
                $image = './images/Vendor/'.$row['vendorFolderName'].'/logo.png ';
                }
            echo '<a class="vendor-link" href="./cart/view-products.php?vid='.$row['vendorId'].'">';
            echo    '<div class="col-xs-6  col-sm-6 col-md-3 col-lg-3">';
            echo        '<div class="thumbnail vendor-thumbnail">';
            echo            '<img class="img-responsive" style="height:150px;" src="'.$image.'" alt="'.$row['vendorName'].' Logo">';
            echo            '<div class="caption-full">';
            echo                '<h4 class="text-center"><a  href="./cart/view-products.php?vid='.$row['vendorId'].'">'.$row['vendorName'].'</a></h4>';
            echo                '<p class="text-center description">'.$shortDescription.'</p>';
            echo            '</div>';
            echo        '</div>';
            echo    '</div>';
            echo '</a>';
        }
	}else{

		echo '<br><br><h3 class="text-center">No stores have been found. Please choose a different option</h3>';
		}
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
    <link type="text/css" rel="stylesheet" href="./css/custom.css"/>
    <title>Food Jackal - Stores</title>


    <!-- Hotlinks for scripts-->
    <?php include('./includes/links.php'); ?>

    <link rel="stylesheet" type="text/css" href="./css/vendors.css" />
    

	
</head>

<body>

    <!-- Navigation -->
	<?php include ('./includes/header.php');?>
 
    <!-- Page Content -->
    <div class="container top-margin-content">

        <div class="row">

        <!-- Category Section -->
            <div class="col-md-3">
                <?php 
                    $categoryList = loadCategories($conn); 
                    
                    //Output categories and badges
                    if(count($categoryList) > 0)
                    {
                        echo '<h3>Categories</h3>';
                        echo '<div class="list-group scroll-pane">';
                        foreach ($categoryList as $key => $value) {
                            echo '<a class="list-group-item" href="'.$_SERVER['PHP_SELF'].'?cid='.$value['categoryId'].'&cname='.$value['categoryName'].'">';
                            	echo '<span class="p">'.$value['categoryName'].'</span>';
                           		echo '<span class="badge">'.$value['categoryCount'].'</span>';
                            echo '</a>';
                         	   
                        }
                        echo '</div>';
                    }
                ?>
            </div>
            <div class="col-md-9 text-center">
                <h1>Stores</h1>
            </div>
            
            <?php
            if( (isset($_REQUEST['cid']) && isset($_REQUEST['cname'])) && ( !empty($_REQUEST['cid']) && !empty($_REQUEST['cname'])) )
            {
            	loadVendorByCategory($conn,$_REQUEST['cid']);
            	
            }else{
            	outputVendor($dataset);
            	}
            ?>
        </div>
    </div>
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