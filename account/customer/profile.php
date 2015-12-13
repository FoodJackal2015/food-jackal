<?php
/*
 * @category  Custome Profile Page
 * @package   customer
 * @file      profile.php
 * @data      05/11/15
 * @author    Conor Thompson
 * @copyright Copyright (c) 2015
*/

session_start();

//Ensure custome is logged in
if(!isset($_SESSION['customerId']))
{
    header("Location: http://".$_SERVER['SERVER_NAME']."/FoodJackal/login/index.php");
}

//Check url parameter and decided what section to pull in with an include down below
if(isset( $_REQUEST['profile']))
{
    $g = $_REQUEST['profile'];
    if($g == "My-Details")
    {
        $url = "profile/mydetails";
    }
    else if($g == "My-Orders")
    {
        $url = "profile/myorders";
    }
    else if($g == "Favourites")
    {
        $url = "profile/favourites";
    }
    else{
        $url = "profile/mydetails";
        }
}else{
    $url = "profile/mydetails";
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
    <link rel="stylesheet" type="text/css" href="../../css/custom.css"/>
    <title>Food Jackal - Profile</title>

    <!-- Core Files -->
    <?php require_once('../../includes/links.php');?>

</head>

<body>

    <!-- Navigation -->
    <?php include_once('../../includes/header.php');?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <br>
            <br>
        </div>
        <br>
        <br>
        <?php include('../customer/'.$url.'.php');?><!-- File to be Included -->
    </div><!-- /.container -->
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
    </div><!-- /.container -->
</body>

</html>
