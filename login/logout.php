<?php
/*
 * @category  Logout
 * @file      logout.php
 * @date      12/11/15
 * @author    Conor Thompson
 * @copyright Copyright (c) 2015
*/

session_start();
session_unset();
header("Location: index.php");
?>