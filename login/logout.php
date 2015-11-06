<?php
session_start();
unset($_COOKIE['user']);
setcookie('user', $cookie_value, time() - (86400 * 30), "/");

session_destroy();

header("Location: ../Login/Login.php");


?>
