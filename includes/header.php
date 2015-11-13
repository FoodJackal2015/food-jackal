<?php

    if(isset($_SESSION['vendorId']) || isset($_SESSION['customerId']))
    {
        if(isset($_SESSION['vendorId']))
        {
              include ('vendor_logged_header.php');//Vendor Header
        }else{
            include ('customer_logged_header.php');//Customer Header
             }
        
    }
    else
    {
        include ('standard-header.php');//Standard Header for user not logged in.
    }
    ?>