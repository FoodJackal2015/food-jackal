<?php
    session_start();
    include('./classes/database/database-connect.php');
    $conn = new Database;

    /* Connect to database and retrieve all vendors*/
    $conn->connectToDatabase();
    $sql = "SELECT * FROM Vendor";
    $dataset = $conn->selectData($sql);



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



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
	<?php include ('./includes/header.php');?>
 
    
    
    <!-- Page Content -->
    <div class="container top-margin-content">

        <div class="row">

        <!-- Category Section -->
            <div class="col-md-3">
                <h3>Categories</h3>
                <div class="list-group">
                    <a href="#" class="list-group-item">Category 1</a>
                    <a href="#" class="list-group-item">Category 2</a>
                    <a href="#" class="list-group-item">Category 3</a>
                    <a href="#" class="list-group-item">Category 4</a>
                    <a href="#" class="list-group-item">Category 5</a>
                    <a href="#" class="list-group-item">Category 6</a>
                    <a href="#" class="list-group-item">Category 7</a>
                    <a href="#" class="list-group-item">Category 8</a>
                    <a href="#" class="list-group-item">Category 9</a>
                    <a href="#" class="list-group-item">Category 9</a>
                </div>
            </div>
            <div class="col-md-9 text-center">
                <h1>Stores</h1>
            </div>
            
            <?php
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

                    //echo '<a class="vendor-link" href="../product/view.php?vid='.$row['vendorId'].'">';
                    echo    '<div class="col-xs-4  col-sm-3 col-md-3 col-lg-3">';
                    echo        '<div class="thumbnail vendor-thumbnail">';
                    echo            '<img class="img-responsive" src="'.$image.'" alt="'.$row['vendorName'].' Logo">';
                    echo            '<div class="caption-full">';
                    echo                '<h4 class="text-center"><a  href="../product/view.php?vid='.$row['vendorId'].'">'.$row['vendorName'].'</a></h4>';
                    echo                '<p class="text-center">'.$shortDescription.'</p>';
                    echo            '</div>';
                    echo        '</div>';
                    echo    '</div>';
                    //echo '</a>';
                }
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
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
