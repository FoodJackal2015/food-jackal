<?php
session_start();
unset($_COOKIE['user']);
session_destroy();
header("Location: ../");


?>
