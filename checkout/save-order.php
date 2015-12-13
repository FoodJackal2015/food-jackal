<?php
/*
 * @category  Save order message
 * @package   checkout
 * @usage     Order Payment checkout/index.php called on by AJAX request
 * @file      save-order.php
 * @data      29/11/15
 * @author    Niall Curran, Seamus Fanning, Graham Murray <x13504987@student@ncirl.ie>
 * @copyright Copyright (c) 2015
*/

session_start();
if($_POST)
{
    $counter = 0;
    //For every order in the cart set the orderMessage from the textfield = to that in the session array
    foreach ($_POST['order-summary'] AS $key => $message) { 
        $_SESSION['cart'][$counter]['orderMessage'] = $message;
       $counter++;
    }
    echo '<script> reloadResult("save-result")</script>';
    echo '<p class="success">Order Message Saved</p>';
    echo '<script> reload5sDelay("save-result")</script>';
}
?>
