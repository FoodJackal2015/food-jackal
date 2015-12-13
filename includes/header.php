<?php
/*
 * @category  Header
 * @data      01/10/15
 * @author    Graham Murray, Conor Thompson
 * @copyright Copyright (c) 2015
*/

if(isset($_SESSION['vendorId']) || isset($_SESSION['customerId']))
{
    if(isset($_SESSION['vendorId']))
    {
          include ('vendor_logged_header.php');//Vendor Header
    }elseif(isset($_SESSION['customerId'])){
        include ('customer_logged_header.php');
    }else{
           include ('standard-header.php');//Customer Header
         }
    
}
else{
    include ('standard-header.php');//Standard Header for user not logged in.
}
?>