<?php
/*
 * @category  About/Services Page
 * @file      customer-post.php
 * @date      11/11/15
 * @author    Conor Thompson
 * @copyright Copyright (c) 2015
*/

session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Conor Thompson">
    <link rel="stylesheet" type="text/css" href="../css/custom.css"/>
    <title>Food Jackal - Stores</title>
    <!-- Hotlinks for scripts-->
    <?php include('../includes/links.php'); ?>

</head>

<body>

    <!-- Navigation -->
    <?php include_once('../includes/header.php');?>
    
    <!-- Page Content -->
    <div class="container top-margin-content">

        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome to FoodJackal
                </h1>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-check"></i> Order food online</h4>
                    </div>
                    <div class="panel-body">
                        <p>Order and receive your food at any time within the IFSC district, perfect for any hungry NCI Student!</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-gift"></i> Free &amp; Secure</h4>
                    </div>
                    <div class="panel-body">
                        <p>Absolute security on your personal details, and no added tax or costs on all of your orders.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-compass"></i> Easy to Use</h4>
                    </div>
                    <div class="panel-body">
                        <p>Standard user interface allows for smooth browsing and interaction.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        
        <!-- Features Section -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Based in the IFSC District</h2>
            </div>
            <div class="col-md-6">
                <p>Serves all people of the district, students and employees, and passer-bys:</p>
                <ul>
                    <li>Subway</li>
                    <li>Centra</li>
                    <li>Munchies</li>
                    <li>Marks &amp; Spencer</li>
                    <li>Mace</li>
                    <li>7 Wonders</li>
                </ul>
                <p>We also provide a signup service for any new, or surrounding shops that would like to be included to help their business run faster!</p>
            </div>
            <div class="col-md-6">
                <iframe class="img-responsive" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"width="700" height="450" src="https://maps.google.com/maps?hl=en&q=Mayor Square, IFSC&ie=UTF8&t=roadmap&z=14&iwloc=B&output=embed"><div><small><a href="http://embedgooglemaps.com">embedgooglemaps.com</a></small></div><div><small><a href="http://premiumlinkgenerator.com/keep2share-cc">keep2share premium link generator</a></small></div></iframe>
            </div>
        </div>
        <!-- /.row -->
        <hr>
        <!-- Call to Action Section -->
        <div class="well">
            <div class="row">
                <div class="col-md-8">
                    <p>You can simply sign up now as a customer or vendor and begin using FoodJackal at your own leisure!</p>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-lg btn-primary btn-block" href="../signup/customer/">Signup now</a>
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
                    <p>Copyright &copy; Food Jackal 2015</p>
                </div>
            </div>
        </footer>
    </div>
</body>