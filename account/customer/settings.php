<?php
/*
 * @category  Settings template where includes are pulled in
 * @package   customer/settings
 * @file      settings.php
 * @data      01/11/15
 * @author    Conor Thompson
 * @copyright Copyright (c) 2015
*/

session_start();

//Get URL parameter to decide which include to pull in down below
if(isset($_REQUEST['setting']))
{
    $g = $_REQUEST['setting'];
    if($g == "My-Settings"){
        $url = "settings/mysettings";
    }
    else if($g == "General"){
        $url = "settings/general";
    }
    else{
        $url="settings/mysettings";
    }
}else
    {
        $url="settings/mysettings";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Food Jackal - Settings</title>

    <?php require_once("../../includes/links.php");?>
</head>

<body>

    <!-- Navigation -->
   <?php require_once("../../includes/header.php");?>
    

    <?php
    
    //Message to display if credit is setup or not
     if(isset($success)){
     echo '<br><br><div class="alert alert-success alert-dismissible" id="poll" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      '.$success.' 
    </div>';}
    else if(isset($error)){
        echo '<br><br><div class="alert alert-danger alert-dismissible" id="poll" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        '.$error.' 
    </div>';}
    ?>
    <!-- Page Content -->
    <?php include($url.'.php');?> <!-- Page to be included based on URL Parameter-->
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
