<?php
    session_start();
    include('../classes/database/database-connect.php');
    $conn = new Database;

    if(!isset($_GET['vid']) || empty($_GET['vid'])){
            header("Location: ../index.php");
        }
    /* Connect to database and retrieve all vendors*/
    $vendorId = $_GET['vid'];
    $conn->connectToDatabase();
    $sql = "SELECT Vendor.*, Product.*
            FROM Vendor
            INNER JOIN Product
            ON Vendor.vendorId=Product.vendorId
            WHERE Vendor.vendorId='$vendorId' ";

    $dataset = $conn->selectData($sql);
    $conn->closeConnection();
    
    if($dataset->num_rows > 0)
            {
                while($row = $dataset->fetch_assoc())
                {
                    //Vendor Details stored in varialbes
                    $description = base64_decode($row['vendorDescription']);
                    $vendorName = $row['vendorName'];
                    $vendorAddress = $row['vendorAddressLine1'].', '.$row['vendorAddressLine2'].', '.$row['vendorCity'];
                    $vendorTelephone = $row['vendorTelephone'];
                    $vendorEmail = $row['vendorEmail'];
                

                    $data = array();
    

                    //Code to get vendor logo if there's no logo it'll display a default image
                    if($row['vendorLogoImageName'] == null)
                    {
                        $image = '../images/misc/noimage.png';//Default Image
                    }else{
                        $image = '../images/Vendor/'.$row['vendorFolderName'].'/logo.png ';
                        }


                }
                
            }else{
                echo '<script>window.location = "../index.php";</script>';
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
    <link type="text/css" rel="stylesheet" href="../css/custom.css"/>
    <title>Food Jackal - Order</title>


    <!-- Hotlinks for scripts-->
    <?php include('../includes/links.php'); ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        .vendorLogo{max-height:250px; max-width:300px;margin-top:10px;float:left;}
        .vendorDetails{float:left; margin-top:0px; margin-left:15px;}
        .glyphicon-text{font-size:0.8em; margin-right:10px;}
        .menu{bottom:0;}
        .description{width:500px;}
    </style>
</head>

<body>

    <!-- Navigation -->
    <?php include('../includes/header.php');?>
 
    
    
    <!-- Page Content -->
    <div class="container top-margin-content">
        <div class="row">
            <div class="col-md-9" >
                <div style="background-color:purple">
                    <img class="img-responsive vendorLogo"src="<?php echo $image;?>">
                    <div class="vendorDetails">
                        <h4><span class="glyphicon glyphicon-text glyphicon-cutlery"></span><?php echo $vendorName;?></h4>
                        <h4><span class="glyphicon glyphicon-text glyphicon-map-marker"></span><?php echo $vendorAddress;?></h4>
                        <h4><span class="glyphicon glyphicon-text glyphicon-phone"></span><?php echo $vendorTelephone;?></h4>
                        <h4><span class="glyphicon glyphicon-text glyphicon-envelope"></span><?php echo $vendorEmail;?></h4>
                        <div class="description"><h4><?php echo $description;?></h4></div>
                    </div>
                </div>

                <!-- Vendor Menu-->
                <div class="menu">

                    <h2 class="text-center" style="margin-top:20px; text-decoration:underline;">Menu</h2>
                    <br>
                    <table class="table table-striped table-hover table-responsive">
                        <thead>
                            <tr>
                                <th class="col-md-3 align-center">Product Title</th>
                                <th class="col-md-5 col-lg-6 align-center">Description</th>
                                <th class="col-md-1 col-lg-1 align-center">Price &euro;</th>
                                <th>Add to Cart</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if (count($data) > 0) {
                                    // output data of each row
                                    
                                        echo json_encode($data);
                                    
                                } else {
                                    echo "<p>There's no products in you listing</p>";
                                    }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="thumbnail">
                    <h3 class="text-center">Your Order</h3>
                    <hr>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <center><input type="submit" value="Proceed" class="btn btn-success"/></center>
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
                    <p>Copyright &copy; Food Jackal 2015</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

</body>

</html>
